<?php

// app/Models/Card.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = ['suit', 'value'];

    public static function generateDeck()
    {
        $suits = ['Hearts', 'Diamonds', 'Clubs', 'Spades'];
        $values = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'Jack', 'Queen', 'King', 'Ace'];
        
        $deck = [];
        
        foreach ($suits as $suit) {
            foreach ($values as $value) {
                $deck[] = ['suit' => $suit, 'value' => $value];
            }
        }
        
        shuffle($deck);
        
        return $deck;
    }
}
