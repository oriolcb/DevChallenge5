<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function startGame()
    {
        // Repartimos las cartas a los dos jugadores
        $cards = [
            'player1' => $this->getRandomCards(),
            'player2' => $this->getRandomCards()
        ];

        return view('game', compact('cards'));
    }

    public function compareCards(Request $request)
    {
        $player1Card = $request->input('player1_card');
        $player2Card = $request->input('player2_card');

        $values = ['2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];

        $player1Value = $this->getCardValue($player1Card, $values);
        $player2Value = $this->getCardValue($player2Card, $values);

        if ($player1Value > $player2Value) {
            return response()->json(['result' => 'Jugador 1 gana!']);
        } elseif ($player1Value < $player2Value) {
            return response()->json(['result' => 'Jugador 2 gana!']);
        } else {
            return response()->json(['result' => 'Empate!']);
        }
    }

    private function getRandomCards()
    {
        $deck = $this->generateDeck();
        shuffle($deck);
        return array_slice($deck, 0, 5); // Devolver las primeras 5 cartas
    }

    private function generateDeck()
    {
        $suits = ['corazones', 'diamantes', 'tréboles', 'picas'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];
        
        $deck = [];
        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = $value . ' de ' . $suit;
            }
        }
        return $deck;
    }

    private function getCardValue($card, $values)
    {
        $cardValue = explode(' ', $card)[0]; // Obtener la parte de la carta (ej. 'As', '10', 'K')
        return $values[$cardValue] ?? 0;
    }
}
