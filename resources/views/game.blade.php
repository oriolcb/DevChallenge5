<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Carta Más Alta</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="game">
        <h1>Juego de Carta Más Alta</h1>
        <div id="player1-cards">
            <h3>Jugador 1</h3>
            <ul id="cards1"></ul>
        </div>
        <div id="player2-cards">
            <h3>Jugador 2</h3>
            <ul id="cards2"></ul>
        </div>
        <button id="start-game">Empezar Juego</button>
    </div>

    <script src="{{ asset('js/game.js') }}"></script>
</body>
</html>
