
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My RPG | Battle</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/game.css') ?>">
</head>
<body>
    <main class="home-screen">
        <section class="battle-panel" id="battle-panel" data-turn="<?= esc(json_encode($turn), 'attr') ?>">
            <p class="welcome-text">BATTLE ARENA</p>
            <?php
            $heroImage = hero_image_url($character['character-class']);
            $monsterImage = monster_image_url($monster['monster-name']);
            // The attacker's style determines the effect shown on its target.
            $heroEffects = ['Warrior' => 'slash', 'Rogue' => 'slash', 'Mage' => 'explosion'];
            $monsterEffects = ['Slime' => 'hitting', 'Skeleton' => 'slash', 'Goblin' => 'blunt'];
            $heroAttackEffect = $heroEffects[$character['character-class']] ?? 'hitting';
            $monsterAttackEffect = $monsterEffects[$monster['monster-name']] ?? 'hitting';
            ?>
            <div class="battle-field">
            <div class="combatant">
            <div class="combatant-header" aria-hidden="true"></div>
            <div class="combatant-figure" id="hero-figure">
                <?php if ($heroImage): ?>
                    <img src="<?= esc($heroImage, 'attr') ?>" alt="<?= esc($character['character-class'], 'attr') ?>">
                <?php else: ?>
                    <span>Hero artwork coming soon</span>
                <?php endif; ?>
                <span class="hit-effect <?= esc($monsterAttackEffect, 'attr') ?>-effect" id="hero-hit-effect" aria-hidden="true"></span>
            </div>
            <div class="combatant-stats">
            <h2><?= esc($character['character-name']) ?></h2>
            <p>Level: <?= esc($character['character-level']) ?></p>
            <label for="hero-hp" id="hero-hp-label">HP: <?= esc($battle['hero_hp']) ?> / <?= esc($character['character-hp']) ?></label>
                <progress
                    id="hero-hp"
                    value="<?= esc($battle['hero_hp'], 'attr') ?>"
                    max="<?= esc($character['character-hp'], 'attr') ?>"
                ></progress>

                <label for="hero-mp">MP: <?= esc($character['character-mp']) ?></label>
                <progress
                    id="hero-mp"
                    value="<?= esc($character['character-mp'], 'attr') ?>"
                    max="<?= esc($character['character-mp'], 'attr') ?>"
                ></progress>
            </div>
            </div>
            <div class="combatant">
            <div class="combatant-header"><p class="attack-countdown">Monster attacks in <?= esc($battle['rounds_until_attack']) ?> round(s)</p></div>
            <div class="combatant-figure" id="monster-figure">
                <?php if ($monsterImage): ?>
                    <img src="<?= esc($monsterImage, 'attr') ?>" alt="<?= esc($monster['monster-name'], 'attr') ?>">
                <?php else: ?>
                    <span>Monster artwork coming soon</span>
                <?php endif; ?>
                <span class="hit-effect <?= esc($heroAttackEffect, 'attr') ?>-effect" id="monster-hit-effect" aria-hidden="true"></span>
            </div>
            <div class="combatant-stats">
            <h2><?= esc($monster['monster-name']) ?></h2>
            <p>Level: <?= esc($monster['monster-level']) ?></p>
            <label for="monster-hp" id="monster-hp-label">HP: <?= esc($battle['monster_hp']) ?> / <?= esc($monster['monster-hp']) ?></label>
                <progress
                    id="monster-hp"
                    value="<?= esc($battle['monster_hp'], 'attr') ?>"
                    max="<?= esc($monster['monster-hp'], 'attr') ?>"
                ></progress>
            </div>
            </div>
            </div>

            <p id="turn-message" role="status" aria-live="polite"></p>
            <div id="battle-result">
            <?php if ($battle_error): ?>
                <p class="form-error" role="alert"><?= esc($battle_error) ?></p>
            <?php endif; ?>
            <?php if ($battle['monster_hp'] <= 0): ?>
                <div class="victory-panel" role="status">
                    <h2><?= $final_encounter ? 'Adventure Complete!' : 'Victory!' ?></h2>
                    <p>You defeated <?= esc($monster['monster-name']) ?>!</p>
                    <?php if ($final_encounter): ?>
                        <p>You defeated every monster in this adventure.</p>
                    <?php else: ?>
                    <form action="<?= site_url('game/battle/restart') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="primary-button">Next Battle</button>
                    </form>
                    <?php endif; ?>
                </div>
            <?php elseif ($battle['hero_hp'] <= 0): ?>
                <div class="victory-panel" role="status">
                    <h2>Defeat</h2>
                    <p>Your hero has fallen.</p>
                    <form action="<?= site_url('game/battle/restart') ?>" method="post">
                        <?= csrf_field() ?>
                        <button type="submit" class="primary-button">Try Again</button>
                    </form>
                </div>
            <?php else: ?>
                <details class="action-menu">
                    <summary class="primary-button action-toggle">Actions</summary>
                    <div class="action-grid" aria-label="Battle actions">
                        <form action="<?= site_url('game/attack') ?>" method="post">
                            <?= csrf_field() ?>
                            <button type="submit" class="primary-button">Attack</button>
                        </form>
                        <button type="button" class="secondary-button" disabled>Item <small>Coming soon</small></button>
                        <button type="button" class="secondary-button" disabled>Skill <small>Coming soon</small></button>
                        <button type="button" class="secondary-button" disabled>Run <small>Coming soon</small></button>
                    </div>
                </details>
            <?php endif; ?>
            </div>
            
            <div class="battle-actions">
                <a href="<?= site_url('game') ?>" class="secondary-button">
                    Main Menu
                </a>
            </div>

        </section>
    </main>
    <script src="<?= base_url('assets/js/game.js') ?>" defer></script>
</body>
</html>
