<?php

require_once "vendor/autoload.php";

use App\Controllers\FightController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pokemon1Name = $_POST['pokemon1'] ?? '';
    $pokemon2Name = $_POST['pokemon2'] ?? '';

    $fightController = new FightController();
    $fightController->startFight($pokemon1Name, $pokemon2Name);
}
?>