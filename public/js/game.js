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
    const repeatButton = document.getElementById('repeat-game');

    player1Cards.innerHTML = '';
    player2Cards.innerHTML = '';

    // Mostrar las cartas del Jugador 1
    data.player1.forEach(card => {
        const li = document.createElement('li');
        li.textContent = card;
        li.classList.add('card'); // Agregar una clase a cada carta
        player1Cards.appendChild(li);
    });

    // Mostrar las cartas del Jugador 2
    data.player2.forEach(card => {
        const li = document.createElement('li');
        li.textContent = card;
        li.classList.add('card'); // Agregar una clase a cada carta
        player2Cards.appendChild(li);
    });

    // Deshabilitar la selección de cartas del Jugador 1 hasta que se reinicie el juego
    player1Cards.classList.add('disabled');
    player2Cards.classList.add('disabled');

    // Esconder el botón de "Repetir juego"
    repeatButton.style.display = 'none';

    // Habilitar la interacción de selección de cartas cuando se inicie el juego
    player1Cards.addEventListener('click', handleCardSelection);
    player2Cards.addEventListener('click', handleCardSelection);
}

function handleCardSelection(event) {
    const selectedCard = event.target.textContent;
    const player1Cards = document.getElementById('cards1');
    const player2Cards = document.getElementById('cards2');

    // Evitar que se seleccione otra carta después de la primera selección
    if (player1Cards.classList.contains('disabled')) {
        return; // No hacer nada si está deshabilitado
    }

    // Deshabilitar la selección de cartas después de la selección
    disableCards(player1Cards);
    disableCards(player2Cards);

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

// Función para deshabilitar todas las cartas de un jugador
function disableCards(playerCards) {
    const cards = playerCards.querySelectorAll('li');
    cards.forEach(card => {
        card.classList.add('disabled'); // Añadir la clase disabled
        card.style.pointerEvents = 'none'; // Deshabilitar clics en las cartas
        card.style.opacity = '0.5'; // Opcional: atenuar las cartas deshabilitadas
    });
}

// Función para habilitar las cartas del Jugador 1 cuando se reinicia el juego
document.getElementById('repeat-game').addEventListener('click', function () {
    const player1Cards = document.getElementById('cards1');
    const player2Cards = document.getElementById('cards2');

    // Eliminar la clase 'disabled' de los contenedores de cartas
    player1Cards.classList.remove('disabled');
    player2Cards.classList.remove('disabled');

    // Habilitar las cartas de nuevo
    enableCards(player1Cards);
    enableCards(player2Cards);

    // Esconder el botón de repetir juego
    this.style.display = 'none';
});

// Función para habilitar todas las cartas de un jugador
function enableCards(playerCards) {
    const cards = playerCards.querySelectorAll('li');
    cards.forEach(card => {
        card.classList.remove('disabled'); // Eliminar la clase disabled
        card.style.pointerEvents = 'auto'; // Habilitar clics en las cartas
        card.style.opacity = '1'; // Restaurar la opacidad
    });
}
