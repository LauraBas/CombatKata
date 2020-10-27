<?php

namespace App;

class Prop {
    public int $health;

    public function setHealth(int $health)
    {
        $this->health = $health;
    }

    public function getHealth() :int
    {
        return $this->health;
    }

    public function isDestroyed() :bool
    {
        return $this->health <= 0;
    }

}





?>