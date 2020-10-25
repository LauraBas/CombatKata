<?php

namespace App;

class Character {
    private int $health = 1000;
    private  int $level = 1;
    private int $maxRange;

    public static function createMelee() {
        return new Character(2);
    }

    public static function createRanged() {
        return new Character(20);
    }

    private function __construct(int $maxRange) {
        $this->maxRange = $maxRange;
    }

    public function getHealth() :int
    {
        return $this->health;
    }

    public function setLevel(int $level)
    {
        $this->level = $level;
    }
    
    public function getLevel() :int
    {
        return $this->level;
    }

    public function isAlive() :bool
    {
        return $this->health > 0;
    }
    
    public function attack(Character $opponent, int $damage, int $distance)
    {     
        if ($this !== $opponent) 
        {  
            if ($this->isInRangeToAttack($distance)) 
            {    
                if ($opponent->isAlive())
                {   
                    if (($opponent->level - $this->level) >= 5)
                    {
                        $opponent->health -= $damage/2;
                    }  
                    
                    else if (($this->level - $opponent->level) >= 5)
                    {
                        $opponent->health -= $damage*2;
                    }  
                    else
                    {
                        $opponent->health -= $damage;                    
                    }                                
                    
                }
            }
        }
    }

    public function isInRangeToAttack($distance)
    {
       return $distance <= $this->getMaxRange();
    }
    
    public function heal(int $heal)
    {   
        if ($this->isAlive())
        {
            $this->health += $heal;
            if ($this->health > 1000)   
            {
                $this->health = 1000;
            }                                                       
        }
    }

    public function getMaxRange() :int
    {
        return $this->maxRange;
    }
}
