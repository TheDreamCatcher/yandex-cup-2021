// Не забудьте перед отправкой изменить в module.exports = function main(game, start) {
// Не деструктурируйте game, ваше решение не будет проходить тесты.
module.exports = function main(game, start) {
    return async() => {
        const check = [
            start,
        ];
        const visited = new Set();

        let finish = null;

        while (null === finish) {
            const current = check.shift();
            const state = await game.state(current.x, current.y);
            visited.add(current.x + ' ' + current.y);

            if (state.finish === true) {
                finish = current;
            } else {
                if (state.top && !visited.has(current.x + ' ' + (current.y - 1))) {
                    check.push({
                        x: current.x,
                        y: current.y - 1,
                    });

                    await game.up(current.x, current.y);
                }

                if (state.bottom && !visited.has(current.x + ' ' + (current.y + 1))) {
                    check.push({
                        x: current.x,
                        y: current.y + 1,
                    });
                    await game.down(current.x, current.y);
                }

                if (state.left && !visited.has((current.x - 1) + ' ' + current.y)) {
                    check.push({
                        x: current.x - 1,
                        y: current.y,
                    });
                    await game.left(current.x, current.y);
                }

                if (state.right && !visited.has((current.x + 1) + ' ' + current.y)) {
                    check.push({
                        x: current.x + 1,
                        y: current.y,
                    });
                    await game.right(current.x, current.y);
                }

            }
        }

        return finish;
    };
}
