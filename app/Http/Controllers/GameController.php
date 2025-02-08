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

        // Guardamos las cartas en la sesión
        session(['cards' => $cards]);

        // Devolvemos las cartas directamente a la vista
        return view('game', compact('cards'));
    }

    public function compareCards(Request $request)
    {
        // Recuperamos las cartas de la sesión
        $cards = session('cards');

        if (!$cards) {
            return redirect('/game/start'); // Si no hay cartas, redirigir al inicio
        }

        $player1Card = $request->input('player1_card');
        $player2Card = $request->input('player2_card');

        // Comparar las cartas
        if ($player1Card > $player2Card) {
            $result = 'Jugador 1 gana!';
        } elseif ($player1Card < $player2Card) {
            $result = 'Jugador 2 gana!';
        } else {
            $result = 'Empate!';
        }

        // Devolver la vista con el resultado
        return view('game', ['result' => $result, 'cards' => $cards]);
    }

    // Función para repartir cartas aleatorias
    private function getRandomCards()
    {
        $deck = [
            'As de corazones', '2 de corazones', '3 de corazones', '4 de corazones', '5 de corazones', 
            '6 de corazones', '7 de corazones', '8 de corazones', '9 de corazones', '10 de corazones',
            'J de corazones', 'Q de corazones', 'K de corazones', 
            'As de diamantes', '2 de diamantes', '3 de diamantes', '4 de diamantes', '5 de diamantes', 
            '6 de diamantes', '7 de diamantes', '8 de diamantes', '9 de diamantes', '10 de diamantes',
            'J de diamantes', 'Q de diamantes', 'K de diamantes',
            'As de tréboles', '2 de tréboles', '3 de tréboles', '4 de tréboles', '5 de tréboles',
            '6 de tréboles', '7 de tréboles', '8 de tréboles', '9 de tréboles', '10 de tréboles',
            'J de tréboles', 'Q de tréboles', 'K de tréboles',
            'As de picas', '2 de picas', '3 de picas', '4 de picas', '5 de picas', 
            '6 de picas', '7 de picas', '8 de picas', '9 de picas', '10 de picas',
            'J de picas', 'Q de picas', 'K de picas'
        ];

        shuffle($deck); // Barajamos las cartas
        return array_splice($deck, 0, 5); // Repartimos 5 cartas
    }
}
