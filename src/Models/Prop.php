<?php

namespace App\Models;

class Prop {
    private int $health;
    const MIN_HEALTH = 0;

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
        return $this->health <= self::MIN_HEALTH;
    }

}

?>