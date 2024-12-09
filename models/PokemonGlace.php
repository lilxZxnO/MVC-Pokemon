<?php

namespace App\Models;

require_once 'Pokemon.php';
require_once 'PokemonType.php';

class PokemonGlace extends Pokemon
{
    public function __construct(string $nom, int $pointsDeVie, int $puissanceAttaque, int $defense)
    {
        parent::__construct($nom, PokemonType::GLACE, $pointsDeVie, $puissanceAttaque, $defense);
    }

    public function capaciteSpeciale(Pokemon $adversaire): void
    {
        if ($adversaire->type === PokemonType::PLANTE) {
            $bonusDegats = $this->puissanceAttaque * 1.5;
            $adversaire->recevoirDegats((int)$bonusDegats);
            echo "{$this->nom} utilise Blizzard et inflige $bonusDegats dégâts à {$adversaire->nom} !<br>";
        } else {
            echo "{$this->nom} utilise Blizzard, mais ce n'est pas très efficace.<br>";
        }
    }
}
?>