document.getElementById('start-game').addEventListener('click', startGame);

function startGame() {
    fetch('/game/start')
        .then(response => response.json())
        .then(data => {
            console.log('Cartas repartidas:', data);
            displayCards(data);
        })
        .catch(error => console.error('Error:', error));
}

function displayCards(data) {
    const player1Cards = document.getElementById('cards1');
    const player2Cards = document.getElementById('cards2');
    
    player1Cards.innerHTML = '';
    player2Cards.innerHTML = '';

    data.player1.forEach(card => {
        const li = document.createElement('li');
        li.textContent = card;
        player1Cards.appendChild(li);
    });

    data.player2.forEach(card => {
        const li = document.createElement('li');
        li.textContent = card;
        player2Cards.appendChild(li);
    });

    // Habilitar la interacción de selección de cartas
    player1Cards.addEventListener('click', handleCardSelection);
    player2Cards.addEventListener('click', handleCardSelection);
}

function handleCardSelection(event) {
    const selectedCard = event.target.textContent;

    // Aquí, podrías agregar lógica para enviar la carta seleccionada al servidor
    console.log('Carta seleccionada:', selectedCard);
    // Por ejemplo:
    fetch('/game/compare', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            player1_card: selectedCard, // Enviar la carta seleccionada por el Jugador 1
            player2_card: selectedCard // Enviar la carta seleccionada por el Jugador 2
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.result); // Mostrar el resultado del juego
    })
    .catch(error => console.error('Error:', error));
}