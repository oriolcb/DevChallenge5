<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Juego de Carta Más Alta</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        .disabled-card {
            pointer-events: none;
            /* No se puede hacer clic */
        }

        .hidden-card button {
            pointer-events: none;
            /* Evita interacción en las cartas del jugador 2 */
        }
    </style>
</head>

<body>
    <div class="game">
        <h1>Juego de Carta Más Alta</h1>

        @if(session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        <!-- Cartas del Jugador 1 -->
        <div id="player1-cards">
            <h3>Jugador 1</h3>
            <ul>
                @foreach($cards['player1'] as $index => $card)
                    <li>
                        <form action="{{ route('game.compare') }}" method="POST">
                            @csrf
                            <input type="hidden" name="player1_card" value="{{ $card }}">
                            <input type="hidden" name="player2_card" value="{{ $cards['player2'][$index] }}">
                            <button type="submit" class="{{ session('player1_used_card') ? 'disabled-card' : '' }}">
                                {{ $card }}
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Cartas del Jugador 2 (Máquina) -->
        <div id="player2-cards">
            <h3>Jugador 2 (Máquina)</h3>
            <ul>
                @foreach($cards['player2'] as $index => $card)
                    <li class="hidden-card">
                        <button>?</button> <!-- Carta oculta -->
                    </li>
                @endforeach
            </ul>
        </div>

        @if(isset($result))
            <h3>Resultado: {{ $result }}</h3>

            <!-- Botón para reiniciar el juego -->
            <div id="repeat-game">
                <form action="{{ route('game.start') }}" method="GET">
                    <button type="submit">Reiniciar Juego</button>
                </form>
            </div>
        @endif
    </div>
</body>

</html>