<?php

namespace App;

class Prop {
    private int $health;

    public function __construct(int $health) 
    {
        $this->health = $health;
    }

    public function getHealth() :int
    {
        return $this->health;
    }

    public function damage(int $damage) :int
    {
         return $this->health -= $damage;
    }

    public function isDestroyed() :bool
    {
        return $this->health <= 0;
    }

}





?>