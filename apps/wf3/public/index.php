<?php

use App\DevTools;
use App\LibsLoader;
use App\Models\Player;
use App\Models\Stats;

$loader = require '../vendor/autoload.php';

$libsLoader = new LibsLoader();
$libsLoader->loadLibraries();
$tools = new DevTools();


/*
 * classe de personnage
 *
 * Choisi par le joueur
 * name, classe, race, alignement
 * stats : force, endurance, agilité, intelligence, charisme, chance
 *
 * Calculé en fonction des choix du joueur
 * PV : chiffre random entre 10 et 20 + 1,2 x endurance
 * mana : chiffre random entre 10 et 30 + 1,3 x intelligence
 * points d'armure : Classe d'Armure de l'armure portée + endure x 1,1
 * calcul des dégats : force * 0,5 + rand(0 et 3)
 */
/* Player 1 */
$player = new Player();
$player->name = 'Player 1';
$player->classe = 'Fire';
$player->race = 'Warriors';
$player->alignement = 'good';
$player->armor = 3.7;
$p1stats = new Stats();
$p1stats->force = 3.4;
$p1stats->endurance = 2;
$p1stats->agilite = 3;
$p1stats->intelligence = 4;
$p1stats->charisme = 7;
$p1stats->chance = 8;
$player->stats = $p1stats;
$player->hp();
$player->mana();
$player->armor();
$player->damage();
/* Player 1 */

/* Player 2 */
$player2 = new Player();
$player2->name = 'Player 2';
$player2->classe = 'Fire';
$player2->race = 'Warriors';
$player2->alignement = 'good';
$player2->armor = 3.3;
$p2stats = new Stats();
$p2stats->force = 3.6;
$p2stats->endurance = 4;
$p2stats->agilite = 4;
$p2stats->intelligence = 5;
$p2stats->charisme = 4;
$p2stats->chance = 6;
$player2->stats = $p2stats;
$player2->hp();
$player2->mana();
$player2->armor();
$player2->damage();
/* Player 2 */

$tools->prettyVarDump($player);
$tools->prettyVarDump($player2);
// faire un algo simuler un combat entre le joueur et l'orc dés qu'un des joueur a 0 pvp, il a perdu.
$registerHits =[];

echo '<br>HP before fight: Player 1 = '.$player->hp.' || Player 2 = '.$player2->hp;

for($i=0; $player->hp > 0 && $player2->hp > 0; $i++){
    $player->blood($player2->damage);
    $registerHits['player1'][] = $player->damage;
    $registerHits['player1Damage'] += $player->damage;
    $player2->blood($player->damage);
    $registerHits['player2'][] = $player2->damage;
    $registerHits['player2Damage'] += $player2->damage;
}

if($player->hp < 0){$player->hp = 0;};
if($player2->hp < 0){ $player2->hp = 0;};

echo '<br>HP after .. fight: Player 1 = '.$player->hp.' || Player 2 = '.$player2->hp;

if($player2->hp == 0 && $player->hp == 0){
    echo '<br><br>Player 1 and Player 2 are = after '.$i.' hits. P1 damage:'.$registerHits['player1Damage'].' P2 damage:'
        .$registerHits['player1Damage'].' <br><br>';
}else if($player2->hp > 0 ){
    echo '<br><br>Player 2 is a WINNER after '.$i.' hits with damage: '.$registerHits['player2Damage'].'<br><br>';
}else{
    echo '<br><br>Player 1 is a WINNER after '.$i.' hits with damage: '.$registerHits['player1Damage'].'<br><br>';
}

$tools->prettyVarDump($registerHits);

