<?php

namespace App\Models;

abstract class Pokemon
{
    protected string $nom;
    protected string $type;
    protected int $pointsDeVie;
    protected int $puissanceAttaque;
    protected int $defense;

    public function __construct(string $nom, string $type, int $pointsDeVie, int $puissanceAttaque, int $defense)
    {
        $this->nom = $nom;
        $this->type = $type;
        $this->pointsDeVie = $pointsDeVie;
        $this->puissanceAttaque = $puissanceAttaque;
        $this->defense = $defense;
    }

    // Getter pour 'nom'
    public function getNom(): string
    {
        return $this->nom;
    }

    // Getter pour 'type' (au cas où vous en avez besoin ailleurs)
    public function getType(): string
    {
        return $this->type;
    }

    public function attaquer(Pokemon $adversaire): void
    {
        $degats = $this->calculerDegats($adversaire, $this->puissanceAttaque);
        $adversaire->recevoirDegats($degats);
        echo "{$this->getNom()} attaque {$adversaire->getNom()} et inflige {$degats} dégâts !<br>";
    }

    public function recevoirDegats(int $degats): void
    {
        $degats -= $this->defense;
        $degats = max(0, $degats); // Assure que les dégâts ne soient pas négatifs.
        $this->pointsDeVie -= $degats;
        $this->pointsDeVie = max(0, $this->pointsDeVie); // Les PV ne tombent pas sous zéro.
        echo "{$this->getNom()} a maintenant {$this->pointsDeVie} PV.<br>";
    }

    public function estKO(): bool
    {
        return $this->pointsDeVie <= 0;
    }

    protected function calculerDegats(Pokemon $adversaire, int $baseDegats): int
    {
        $degats = $baseDegats;

        if (in_array($this->type, PokemonType::$faiblesses[$adversaire->type] ?? [])) {
            $degats *= 2;
            echo "{$adversaire->getNom()} est faible contre {$this->type} !<br>";
        } elseif (in_array($this->type, PokemonType::$resistances[$adversaire->type] ?? [])) {
            $degats /= 2;
            echo "{$adversaire->getNom()} résiste à {$this->type}.<br>";
        } elseif (in_array($this->type, PokemonType::$immunites[$adversaire->type] ?? [])) {
            $degats = 0;
            echo "{$adversaire->getNom()} est immunisé contre {$this->type}.<br>";
        }

        return max(0, (int)$degats);
    }

    // Déclare la méthode spéciale comme abstraite
    abstract public function capaciteSpeciale(Pokemon $adversaire): void;
}
