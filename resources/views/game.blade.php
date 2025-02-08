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

        @if(isset($result))
            <h3>Resultado: {{ $result }}</h3>
        @endif

        <!-- Contenedor de cartas del jugador 1 -->
        <div id="player1-cards">
            <h3>Jugador 1</h3>
            <ul>
                @foreach($cards['player1'] as $index => $card)
                    <li>
                        <form action="{{ route('game.compare') }}" method="POST">
                            @csrf
                            <input type="hidden" name="player1_card" value="{{ $card }}">
                            <input type="hidden" name="player2_card" value="{{ $cards['player2'][$index] }}">
                            <button type="submit">{{ $card }}</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Contenedor de cartas del jugador 2 -->
        <div id="player2-cards">
            <h3>Jugador 2</h3>
            <ul>
                @foreach($cards['player2'] as $index => $card)
                    <li>
                        <button>{{ $card }}</button>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</body>
</html>
