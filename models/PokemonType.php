<?php

namespace App\Models;
class PokemonType
{
    public const NORMAL = "Normal";
    public const FEU = "Feu";
    public const EAU = "Eau";
    public const PLANTE = "Plante";
    public const ELECTRIQUE = "Electrique";
    public const GLACE = "Glace";
    public const COMBAT = "Combat";
    public const POISON = "Poison";
    public const SOL = "Sol";
    public const VOL = "Vol";
    public const PSY = "Psy";
    public const INSECTE = "Insecte";
    public const ROCHE = "Roche";
    public const SPECTRE = "Spectre";
    public const DRAGON = "Dragon";
    public const TENEBRE = "Ténèbre";
    public const ACIER = "Acier";
    public const FEE = "Fée";

    public static array $faiblesses = [
        self::FEU => [self::EAU, self::ROCHE, self::SOL],
        self::EAU => [self::ELECTRIQUE, self::PLANTE],
        self::PLANTE => [self::FEU, self::INSECTE, self::VOL],
        self::ELECTRIQUE => [self::SOL],
        self::GLACE => [self::FEU, self::COMBAT, self::ROCHE],
    ];

    public static array $resistances = [
        self::FEU => [self::FEU, self::PLANTE, self::GLACE, self::ACIER],
        self::EAU => [self::FEU, self::EAU, self::GLACE, self::ACIER],
        self::PLANTE => [self::EAU, self::PLANTE, self::SOL],
        self::ELECTRIQUE => [self::ELECTRIQUE, self::VOL],
        self::GLACE => [self::GLACE],
        
    ];

   
    public static array $immunites = [
        self::NORMAL => [self::SPECTRE],
        self::SOL => [self::ELECTRIQUE],
        self::VOL => [self::SOL],
        
    ];
}
?>