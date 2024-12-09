<?php

namespace App\Controllers;

require_once 'PokemonController.php';
require_once 'CombatController.php';

use App\Controllers\PokemonController;
use App\Controllers\CombatController;

class FightController
{
    public function startFight(string $pokemon1Name, string $pokemon2Name): void
    {
        $pokemonController = new PokemonController();
        $pokemons = $pokemonController->getPokemons();

        $pokemon1 = null;
        $pokemon2 = null;

        foreach ($pokemons as $pokemon) {
            if ($pokemon->getNom() === $pokemon1Name) {
                $pokemon1 = $pokemon;
            } elseif ($pokemon->getNom() === $pokemon2Name) {
                $pokemon2 = $pokemon;
            }
        }

        if ($pokemon1 && $pokemon2) {
            $combatController = new CombatController();
            $combatController->demarrerCombat($pokemon1, $pokemon2);
        } else {
            echo "One or both Pokémon not found.";
        }
    }
}
?>