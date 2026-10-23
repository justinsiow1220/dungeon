// The server resolves the turn; replay its result so each action is visible.
const panel = document.getElementById('battle-panel');
if (panel) {
    const turn = JSON.parse(panel.dataset.turn || 'null');
    if (turn && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        const heroHp = document.getElementById('hero-hp');
        const monsterHp = document.getElementById('monster-hp');
        const heroLabel = document.getElementById('hero-hp-label');
        const monsterLabel = document.getElementById('monster-hp-label');
        const message = document.getElementById('turn-message');
        const result = document.getElementById('battle-result');
        const heroFinal = heroHp.value;
        const monsterFinal = monsterHp.value;
        const showHp = (bar, label, value) => {
            bar.value = value;
            label.textContent = `HP: ${value} / ${bar.max}`;
        };
        const playEffect = (id) => {
            const effect = document.getElementById(id);
            effect.classList.remove('is-playing');
            void effect.offsetWidth; // Restart the animation if the same effect plays again.
            effect.classList.add('is-playing');
        };
        document.querySelectorAll('.hit-effect').forEach((effect) => {
            effect.addEventListener('animationend', () => effect.classList.remove('is-playing'));
        });

        result.hidden = true;
        showHp(heroHp, heroLabel, turn.hero_before);
        showHp(monsterHp, monsterLabel, turn.monster_before);
        message.textContent = 'Hero attacks!';
        document.getElementById('hero-figure').classList.add('hero-attacking');

        setTimeout(() => {
            showHp(monsterHp, monsterLabel, monsterFinal);
            playEffect('monster-hit-effect');
            document.getElementById('hero-figure').classList.remove('hero-attacking');
            message.textContent = turn.monster_attacked ? 'Monster’s turn!' : 'Monster takes damage!';
            if (turn.monster_attacked) document.getElementById('monster-figure').classList.add('monster-attacking');
        }, 700);

        setTimeout(() => {
            showHp(heroHp, heroLabel, heroFinal);
            if (turn.monster_attacked) playEffect('hero-hit-effect');
            document.getElementById('monster-figure').classList.remove('monster-attacking');
            message.textContent = turn.monster_attacked ? 'The monster attacks!' : 'Your turn is complete.';
            result.hidden = false;
        }, 1500);
    }
}
