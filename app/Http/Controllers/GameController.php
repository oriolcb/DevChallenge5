<?php

// app/Http/Controllers/GameController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function startGame()
    {
        // Aquí podries crear la lògica per repartir les cartes
        // Per exemple:
        $cards = [
            'player1' => ['As de cors', '8 de diamants', 'Rei de piques', 'Dama de trèvols', '3 de cors'],
            'player2' => ['As de trèvols', '10 de piques', '9 de cors', '7 de diamants', 'Dama de piques']
        ];

        return view('game', compact('cards'));
    }

    public function compareCards(Request $request)
    {
        // Lògica per comparar les cartes
        $player1Card = $request->input('player1_card');
        $player2Card = $request->input('player2_card');

        // Aquí compararies les cartes
        // Exemple:
        if ($player1Card > $player2Card) {
            return response()->json(['result' => 'Jugador 1 guanya!']);
        } elseif ($player1Card < $player2Card) {
            return response()->json(['result' => 'Jugador 2 guanya!']);
        } else {
            return response()->json(['result' => 'Empat!']);
        }
    }
}
