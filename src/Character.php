<?php

namespace App;



class Character {
    private  Int $health = 1000;
    private  Int $level = 1;
    private  $alive = true;

	public function getCharacterHealth(){
        return $this->health;
    }
    public function getCharacterLevel(){
        return $this->level;
    }
    public function getAliveState(){
        return $this->alive;
    }
    public function characterDamage($damage){
        $this->health -= $damage;
        if ($this->health < 1){
            return $this->alive = false;
        }
        return $this->health;
    }
}
