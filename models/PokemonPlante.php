<?php

namespace App\Models;

require_once 'Pokemon.php';
require_once 'PokemonType.php';

class PokemonPlante extends Pokemon
{
    public function __construct(string $nom, int $pointsDeVie, int $puissanceAttaque, int $defense)
    {
        parent::__construct($nom, PokemonType::PLANTE, $pointsDeVie, $puissanceAttaque, $defense);
    }

    public function capaciteSpeciale(Pokemon $adversaire): void
    {
        if ($adversaire->type === PokemonType::EAU) {
            $bonusDegats = $this->puissanceAttaque * 1.5;
            $adversaire->recevoirDegats((int)$bonusDegats);
            echo "{$this->nom} utilise Fouet-Lianes et inflige $bonusDegats dégâts à {$adversaire->nom} !<br>";
        } else {
            echo "{$this->nom} utilise Fouet-Lianes, mais ce n'est pas très efficace.<br>";
        }
    }
}
?>