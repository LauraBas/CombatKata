<?php

namespace App;



class Character {
    public  int $health = 1000;
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
    public function attack(Character $opponent, int $damage)
    {
        
        if ($this !== $opponent) 
        {           
            if ($opponent->isAlive())
            {                
                $opponent->health -= $damage;
            }

        }
    }
    public function heal(int $heal)
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
