<?php

namespace App\Controllers;

use App\Models\CharacterModel;
use App\Models\MonsterModel;

use CodeIgniter\Database\Exceptions\DatabaseException;
class GameController extends BaseController
{
    protected $helpers = ['hero', 'monster'];
    private const MONSTER_ATTACK_INTERVAL = 1;
    private const ENCOUNTERS = ['Slime', 'Goblin', 'Skeleton'];

    public function index()
    {
        return view('game/home');
    }
     public function create()
    {
        return view('game/create');
    }
         public function battle()
    {
        $characterId = session()->get('character_id');
        if ($characterId === null) {
            return redirect()->to(site_url('game/create'))
                ->with('error', 'No character found. Please create a character first.');
        }

        $characterModel = new CharacterModel();
        $character = $characterModel->find($characterId);
        if ($character === null) {
            return redirect()->to(site_url('game/create'))
                ->with('error', 'Character not found.');
        }

        $monsterModel = new MonsterModel();
        $battle = session()->get('battle');
        $monster = $battle === null
            ? $monsterModel->where('monster-name', self::ENCOUNTERS[0])->orderBy('monster-id', 'ASC')->first()
            : $monsterModel->find($battle['monster_id']);

        if ($monster === null) {
            return 'No monsters found. Please add monsters to the database.';
        }

        // Start a battle only if this session doesn't already have one.
        if (session()->get('battle') === null) {
            session()->set('battle', [
                'monster_id' => $monster['monster-id'],
                'monster_hp' => $monster['monster-hp'],
                'hero_hp'    => $character['character-hp'],
                'rounds_until_attack' => self::MONSTER_ATTACK_INTERVAL,
                'encounter_index' => 0,
            ]);
        }

        // Get the current battle state to show it on the page.
        $battle = session()->get('battle');
        if (! isset($battle['encounter_index'])) {
            $index = array_search($monster['monster-name'], self::ENCOUNTERS, true);
            $battle['encounter_index'] = $index === false ? 0 : $index;
            session()->set('battle', $battle);
        }
        // Existing sessions created before hero HP was tracked need a starting value.
        if (! isset($battle['hero_hp'])) {
            $battle['hero_hp'] = $character['character-hp'];
            session()->set('battle', $battle);
        }
        if (! isset($battle['rounds_until_attack'])) {
            $battle['rounds_until_attack'] = self::MONSTER_ATTACK_INTERVAL;
            session()->set('battle', $battle);
        }

        return view('game/battle', [
            'character' => $character,
            'monster'   => $monster,
            'battle'    => $battle,
            'turn'      => session()->getFlashdata('battle_turn'),
            'final_encounter' => $battle['encounter_index'] >= count(self::ENCOUNTERS) - 1,
            'battle_error' => session()->getFlashdata('battle_error'),
        ]);
    }

    public function restartBattle()
    {
        $battle = session()->get('battle');
        if ($battle !== null && ($battle['monster_hp'] <= 0 || ($battle['hero_hp'] ?? 1) <= 0)) {
            if ($battle['monster_hp'] <= 0 && ($battle['hero_hp'] ?? 0) > 0) {
                $nextIndex = ($battle['encounter_index'] ?? 0) + 1;
                if (! isset(self::ENCOUNTERS[$nextIndex])) {
                    return redirect()->to(site_url('game/battle'));
                }
                $monster = (new MonsterModel())->where('monster-name', self::ENCOUNTERS[$nextIndex])
                    ->orderBy('monster-id', 'ASC')->first();
                if ($monster === null) {
                    return redirect()->to(site_url('game/battle'))
                        ->with('battle_error', 'The next monster is missing from the database.');
                }
                $battle['encounter_index'] = $nextIndex;
                $battle['monster_id'] = $monster['monster-id'];
                $battle['monster_hp'] = $monster['monster-hp'];
                $battle['rounds_until_attack'] = self::MONSTER_ATTACK_INTERVAL;
                session()->set('battle', $battle);
            } else {
                session()->remove('battle');
            }
        }

        return redirect()->to(site_url('game/battle'));
    }

    public function attack()
    {
        $characterId = session()->get('character_id');
        $battle = session()->get('battle');

        if ($characterId === null || $battle === null) {
            return redirect()->to(site_url('game/create'));
        }

        $characterModel = new CharacterModel();
        $character = $characterModel->find($characterId);

        if ($character === null) {
            return redirect()->to(site_url('game/create'))
                ->with('error', 'Character not found.');
        }

        $monster = (new MonsterModel())->find($battle['monster_id']);
        if ($monster === null) {
            return redirect()->to(site_url('game/battle'));
        }

        $battle['hero_hp'] = $battle['hero_hp'] ?? $character['character-hp'];
        if ($battle['monster_hp'] <= 0 || $battle['hero_hp'] <= 0) {
            return redirect()->to(site_url('game/battle'));
        }

        $turn = ['hero_before' => (int) $battle['hero_hp'], 'monster_before' => (int) $battle['monster_hp']];

        // Don't let HP go below zero.
        $battle['monster_hp'] = max(
            0,
            $battle['monster_hp'] - $character['character-atk']
        );

        // A defeated monster cannot attack back.
        $turn['monster_attacked'] = false;
        if ($battle['monster_hp'] > 0) {
            $battle['rounds_until_attack'] = ($battle['rounds_until_attack'] ?? self::MONSTER_ATTACK_INTERVAL) - 1;
            if ($battle['rounds_until_attack'] <= 0) {
                $battle['hero_hp'] = max(0, $battle['hero_hp'] - $monster['monster-atk']);
                $battle['rounds_until_attack'] = self::MONSTER_ATTACK_INTERVAL;
                $turn['monster_attacked'] = true;
            }
        }

        session()->set('battle', $battle);
        session()->setFlashdata('battle_turn', $turn);

        return redirect()->to(site_url('game/battle'));
    }
    
    public function start()
    {
        $name = trim((string) $this->request->getPost('character_name'));
        $class = (string) $this->request->getPost('character_class');
        $characterModel = new CharacterModel();

        $allowedClasses = ['Warrior', 'Mage', 'Rogue'];

        if ($name === '' || strlen($name) > 20) {
            return redirect()->to(site_url('game/create'))
                ->with('error', 'Enter a name between 1 and 20 characters.');
        }

        if (! in_array($class, $allowedClasses, true)) {
            return redirect()->to(site_url('game/create'))
                ->with('error', 'Please choose a valid character class.');
        }
            
        if ($class === 'Warrior') {
            $hp = 150;
            $atk = 15;
            $mp = 10;
        } elseif ($class === 'Mage') {
            $hp = 80;
            $atk = 8;
            $mp = 100;
        } elseif ($class === 'Rogue') {
            $hp = 100;
            $atk = 20;
            $mp = 30;
        }
        
        try {
            $characterId = $characterModel->insert([
            'character-name'  => $name,
            'character-class' => $class,
            'character-hp'    => $hp,
            'character-atk'   => $atk,
            'character-mp'    => $mp,
            'character-level' => 1,
            'character-xp'    => 0,
            ]);

            if ($characterId === false) {
                return redirect()->to(site_url('game/create'))
                    ->with('error', 'Could not save your character. Please try again.');
            }
            
            $character = $characterModel->find($characterId);
        } catch (DatabaseException $e) {
            log_message('error', 'Character creation failed: {message}', ['message' => $e->getMessage()]);

            return redirect()->to(site_url('game/create'))
                ->with('error', 'Could not save your character. Please try again.');
        }

        if ($character === null) {
            return redirect()->to(site_url('game/create'))
                ->with('error', 'Your character was saved, but could not be loaded.');
        }
        session()->remove('battle');
        session()->set('character_id', $characterId);
        return view('game/preview', [
        'character' => $character,
        ]);
    }
}
