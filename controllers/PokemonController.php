<?php

namespace App\Controllers;

use App\Models\PokemonFeu;
use App\Models\PokemonEau;

class PokemonController
{
    public function getPokemons(): array
    {
        return [
            new PokemonFeu("charizard", 100, 50, 30),
            new PokemonEau("blastoise", 120, 40, 40),
        ];
    }
}
