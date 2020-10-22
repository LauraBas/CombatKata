<?php

namespace App;



class Character {
    public  Int $health = 1000;
    public  Int $level = 1;
    public  $alive = true;

	public function getCharacterHealth(){
        return $this->health;
    }
    public function getCharacterLevel(){
        return $this->level;
    }
    public function getAliveState(){
        return $this->alive;
    }
}
