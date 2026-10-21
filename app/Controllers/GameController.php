<?php

namespace App\Controllers;

use App\Models\CharacterModel;
class GameController extends BaseController
{
    public function index()
    {
        return view('game/home');
    }
     public function create()
    {
        return view('game/create');
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

        $characterModel->insert([
            'character-name'  => $name,
            'character-class' => $class,
            'character-hp'    => $hp,
            'character-atk'   => $atk,
            'character-mp'    => $mp,
            'character-level' => 1,
            'character-xp'    => 0,
        ]);

        $characterId = $characterModel->getInsertID();

        $character = $characterModel->find($characterId);
       return view('game/preview', [
        'character' => $character,
        ]);
    }
}