
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Ready</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/game.css') ?>">
</head>
<body>
    <main class="home-screen">
        <section class="creation-panel" style="text-align: center;">
            <p class="welcome-text">HERO CREATED</p>

            <h2><?= esc($character['character-name']) ?></h2>
            <p>Class: <?= esc($character['character-class']) ?></p>
            <p>HP: <?= esc($character['character-hp']) ?></p>
            <p>ATK: <?= esc($character['character-atk']) ?></p>
            <p>MP: <?= esc($character['character-mp']) ?></p>
            <p>Level: <?= esc($character['character-level']) ?></p>
            <p>XP: <?= esc($character['character-xp']) ?></p>

            <p>Your adventure is ready to begin.</p>

            <div class="creation-actions preview-actions">
                <a href="<?= site_url('game/create') ?>" class="secondary-button">
                    Back
                </a>

                <a href="<?= site_url('game/battle') ?>" class="primary-button">
                    Begin Adventure
                </a>
            
                <a href="<?= site_url('game') ?>" class="secondary-button">
                    Main Menu
                </a>
            </div>

            <p class="class-description">
                Your character has been saved.
            </p>
        </section>
    </main>
</body>
</html>
