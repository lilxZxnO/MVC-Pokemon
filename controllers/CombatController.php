<?php

namespace App\Controllers;

require_once 'models/Combat.php';

use App\Models\Combat;
use App\Models\Pokemon;

class CombatController
{
    public function demarrerCombat(Pokemon $pokemon1, Pokemon $pokemon2): void
    {
        $combat = new Combat($pokemon1, $pokemon2);
        $combat->demarrerCombat();
    }
}
?>
