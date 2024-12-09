<?php

namespace App\Models;

class Combat
{
    private Pokemon $pokemon1;
    private Pokemon $pokemon2;

    public function __construct(Pokemon $pokemon1, Pokemon $pokemon2)
    {
        $this->pokemon1 = $pokemon1;
        $this->pokemon2 = $pokemon2;
    }

    public function demarrerCombat(): void
    {
        echo "Le combat commence entre {$this->pokemon1->getNom()} et {$this->pokemon2->getNom()} !<br><br>";

        while (!$this->pokemon1->estKO() && !$this->pokemon2->estKO()) {
            $this->tourDeCombat($this->pokemon1, $this->pokemon2);

            if ($this->pokemon2->estKO()) {
                break;
            }

            $this->tourDeCombat($this->pokemon2, $this->pokemon1);
        }

        $this->determinerVainqueur();
    }

    private function tourDeCombat(Pokemon $attaquant, Pokemon $defenseur): void
    {
        echo "Tour de {$attaquant->getNom()} !<br>";
        $attaquant->attaquer($defenseur);

        if (!$defenseur->estKO() && rand(0, 1)) {
            $attaquant->capaciteSpeciale($defenseur);
        }

        echo "<br>";
    }

    private function determinerVainqueur(): void
    {
        if ($this->pokemon1->estKO()) {
            echo "{$this->pokemon2->getNom()} remporte le combat !<br>";
        } elseif ($this->pokemon2->estKO()) {
            echo "{$this->pokemon1->getNom()} remporte le combat !<br>";
        } else {
            echo "Le combat se termine par un match nul !<br>";
        }
    }
}
?>
