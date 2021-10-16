var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
// Не забудьте перед отправкой изменить в module.exports = function main(game, start) {
// Не деструктурируйте game, ваше решение не будет проходить тесты.
export default function main(game, start) {
    //module.exports = function main(game, start) {
    const maze = () => __awaiter(this, void 0, void 0, function* () {
        const check = [
            start,
        ];
        const visited = new Set();
        let finish = null;
        while (null === finish) {
            const current = check.shift();
            const state = yield game.state(current.x, current.y);
            visited.add(current.x + ' ' + current.y);
            if (state.finish === true) {
                finish = current;
            }
            else {
                if (state.top && !visited.has(current.x + ' ' + (current.y - 1))) {
                    check.push({
                        x: current.x,
                        y: current.y - 1,
                    });
                    yield game.up(current.x, current.y);
                }
                if (state.bottom && !visited.has(current.x + ' ' + (current.y + 1))) {
                    check.push({
                        x: current.x,
                        y: current.y + 1,
                    });
                    yield game.down(current.x, current.y);
                }
                if (state.left && !visited.has((current.x - 1) + ' ' + current.y)) {
                    check.push({
                        x: current.x - 1,
                        y: current.y,
                    });
                    yield game.left(current.x, current.y);
                }
                if (state.right && !visited.has((current.x + 1) + ' ' + current.y)) {
                    check.push({
                        x: current.x + 1,
                        y: current.y,
                    });
                    yield game.right(current.x, current.y);
                }
            }
        }
        return finish;
    });
    return new Promise((resolve) => {
        resolve(maze());
    });
}
;
