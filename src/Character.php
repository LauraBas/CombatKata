<?php

namespace App;



class Character {
    private  int $health = 1000;
    private  int $level = 1;

    public function getHealth() :int
    {
        return $this->health;
    }
    public function getLevel() :int
    {
        return $this->level;
    }
    public function isAlive() :bool
    {
        return $this->health > 0;
    }
    public function damage($damage)
    {
        if($this->health > 0)
        {
            $this->health -= $damage;
        }
    }
    public function heal($heal)
    {   if ($this->isAlive())
        {
            $this->health += $heal;
            if ($this->health > 1000)   
            {
                $this->health = 1000;
            }                                                       
        }
    }
}
