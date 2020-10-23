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
}
