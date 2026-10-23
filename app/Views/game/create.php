
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Game | Character Creation</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/game.css') ?>">
</head>
<body>
    <main class="home-screen">
        <section class="creation-panel">
            <p class="welcome-text">A NEW ADVENTURE AWAITS</p>
            <h1 class="creation-title">Create Your Hero</h1>
            <p class="creation-subtitle">
                Choose your identity before entering the world.
            </p>

            <?php if (session()->getFlashdata('error')): ?>
                <p class="form-error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </p>
            <?php endif; ?>

            <form action="<?= site_url('game/start') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="character_name">Character Name</label>
                    <input
                        type="text"
                        id="character_name"
                        name="character_name"
                        maxlength="20"
                        placeholder="Enter your hero's name"
                        required
                    >
                </div>

                <fieldset class="class-selection">
                    <legend>Choose Your Class</legend>

                    <label class="class-option">
                        <input
                            type="radio"
                            name="character_class"
                            value="Warrior"
                            required
                        >
                        <img class="class-portrait" src="<?= esc(hero_image_url('Warrior'), 'attr') ?>" alt="">
                        <span class="class-icon">⚔</span>
                        <span class="class-name">Warrior</span>
                        <span class="class-description">
                            Strong and durable, skilled in close combat.
                        </span>
                    </label>

                    <label class="class-option">
                        <input
                            type="radio"
                            name="character_class"
                            value="Mage"
                        >
                        <img class="class-portrait" src="<?= esc(hero_image_url('Mage'), 'attr') ?>" alt="">
                        <span class="class-icon">✦</span>
                        <span class="class-name">Mage</span>
                        <span class="class-description">
                            Wields powerful magic to defeat enemies.
                        </span>
                    </label>

                    <label class="class-option">
                        <input
                            type="radio"
                            name="character_class"
                            value="Rogue"
                        >
                        <img class="class-portrait" src="<?= esc(hero_image_url('Rogue'), 'attr') ?>" alt="">
                        <span class="class-icon">🗡</span>
                        <span class="class-name">Rogue</span>
                        <span class="class-description">
                            Swift and cunning, striking with precision.
                        </span>
                    </label>
                </fieldset>

                <div class="creation-actions">
                    <a href="<?= site_url('game') ?>" class="secondary-button">
                        Back
                    </a>

                    <button type="submit" class="primary-button">
                        Start Adventure
                    </button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
