<!-- resources/views/game.blade.php -->

<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joc de Carta més Alta</title>
    @vite(['resources/js/game.js'])
</head>

<body>
    <div id="game">
        <h1>Joc de Carta més Alta</h1>
        <button onclick="startGame()">Iniciar Joc</button>

        <div id="player1-cards">
            <h2>Jugador 1 - Escull una carta:</h2>
            <!-- Aquí es mostrarien les cartes del jugador 1 -->
        </div>

        <div id="player2-cards">
            <h2>Jugador 2 - Escull una carta:</h2>
            <!-- Aquí es mostrarien les cartes del jugador 2 -->
        </div>

        <div id="result"></div>
    </div>
</body>

</html>