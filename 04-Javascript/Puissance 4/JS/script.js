document.addEventListener('DOMContentLoaded', () => {
    const board = document.getElementById('game-board');
    const rows = 6;
    const cols = 7;
    const boardArray = Array(rows).fill().map(() => Array(cols).fill(null));
    let currentPlayer = 'red';

    function createBoard() {
        for (let row = 0; row < rows; row++) {
            for (let col = 0; col < cols; col++) {
                const cell = document.createElement('div');
                cell.classList.add('cell');
                cell.dataset.row = row;
                cell.dataset.col = col;
                board.appendChild(cell);
            }
        }
    }

    function checkWin() {
        // Logique pour vérifier les conditions de victoire
    }

    function handleClick(event) {
        const col = event.target.dataset.col;
        for (let row = rows - 1; row >= 0; row--) {
            if (!boardArray[row][col]) {
                boardArray[row][col] = currentPlayer;
                event.target.style.backgroundColor = currentPlayer;
                currentPlayer = currentPlayer === 'red' ? 'yellow' : 'red';
                break;
            }
        }
        checkWin();
    }

    board.addEventListener('click', handleClick);
    createBoard();
});