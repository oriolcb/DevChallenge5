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
                            <button 
                                type="submit" 
                                @if(Request::is('compare')) disabled @endif>
                                {{ $card }}
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Contenedor de cartas del jugador 2 (Máquina) -->
        <div id="player2-cards">
            <h3>Jugador 2 (Máquina)</h3>
            <ul>
                @foreach($cards['player2'] as $index => $card)
                    <li class="hidden-card">
                        <button>?</button> <!-- El botón será solo un "?" para ocultar la carta -->
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Mostrar el resultado solo cuando haya terminado el juego -->
        @if(isset($result))
            <h3>Resultado: {{ $result }}</h3>

            <!-- Botón para repetir el juego, solo visible después del resultado -->
            <div id="repeat-game">
                <form action="{{ route('game.start') }}" method="GET">
                    <button type="submit">Repetir Juego</button>
                </form>
            </div>
        @endif
    </div>
</body>
</html>