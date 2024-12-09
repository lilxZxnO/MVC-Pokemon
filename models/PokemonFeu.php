<?php

namespace App\Models;

require_once 'Pokemon.php';
require_once 'PokemonType.php';

class PokemonFeu extends Pokemon
{
    public function __construct(string $nom, int $pointsDeVie, int $puissanceAttaque, int $defense)
    {
        parent::__construct($nom, PokemonType::FEU, $pointsDeVie, $puissanceAttaque, $defense);
    }

    public function capaciteSpeciale(Pokemon $adversaire): void
    {
        if ($adversaire->type === PokemonType::PLANTE) {
            $bonusDegats = $this->puissanceAttaque * 1.5;
            $adversaire->recevoirDegats((int)$bonusDegats);
            echo "{$this->nom} utilise Lance-Flammes et inflige $bonusDegats dégâts à {$adversaire->nom} !<br>";
        } else {
            echo "{$this->nom} utilise Lance-Flammes, mais ce n'est pas très efficace.<br>";
        }
    }
}
