// resources/js/game.js

// Funció per iniciar el joc
function startGame() {
    fetch('/start-game')
        .then(response => response.json())
        .then(data => {
            // Mostrar les cartes dels jugadors
            console.log('Jugador 1:', data.player1);
            console.log('Jugador 2:', data.player2);
        });
}

// Funció per comparar les cartes seleccionades
function compareCards(player1Card, player2Card) {
    fetch('/compare-cards', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            player1_card: player1Card,
            player2_card: player2Card
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log('Guanyador:', data.winner);
    });
}
