<?php


namespace App\Models;


class Player
{
    public $name;
    public $classe;
    public $race;
    public $alignement;
    public $stats;
    public $armor;

    public $hp;
    public $mana;
    public $damage;

    public function hp(){
        $this->hp = rand ( 10 , 20 ) + (1.2 * $this->stats->endurance);
    }
    public function mana(){
        $this->mana = rand(10,30)+(1.3 * $this->stats->intelligence);
    }
    public function armor(){
        $this->armor = $this->armor + ($this->stats->endurance * 1.1);
    }
    public function damage(){
        $this->damage = $this->stats->force * 0.5 + (rand(0,3));
    }
    public function blood($force){
        if($this->armor >= $force){
            $this->armor = $this->armor - $force;
            $force = 0;
        }else{
            $force = $force - $this->armor;
        }
        $this->hp = $this->hp - $force;
    }
}