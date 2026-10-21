
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My RPG | Home</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/game.css') ?>">
</head>
<body>
    <main class="home-screen">
        <section class="menu">
            <p class="welcome-text">YOUR ADVENTURE BEGINS HERE</p>

            <h1 class="game-title">YOUR GAME TITLE</h1>

            <p class="subtitle">A world of adventure awaits.</p>

            <nav class="menu-buttons" aria-label="Main menu">
                <button
                    type="button"
                    onclick="window.location.href='<?= site_url('game/create') ?>'"
                >
                    New Game
                </button>

                <button type="button" onclick="alert('Continue Game is coming soon!')">
                    Continue Game
                </button>

                <button type="button" onclick="alert('Settings are coming soon!')">
                    Settings
                </button>
            </nav>

            <p class="footer-text">Choose your path</p>
        </section>
    </main>
</body>
</html>
