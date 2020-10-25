<?php

namespace App;



class Character {
    public  int $health = 1000;
    public  int $level = 1;

    function __construct(string $typeOfFighter) {
        $this->typeOfFighter = $typeOfFighter;
      }

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
    public function isRanged() :bool
    {
       $this->typeOfFighter == 'Ranged';
    }
    public function isMelee() :bool
    {
       $this->typeOfFighter == 'Melee';
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
        if($this->typeOfFighter == 'Melee')
        {
            $this->attackMaxRange = 2;
        }
        else 
        {
            $this->attackMaxRange = 20;
        }
        return $this->attackMaxRange;

    }
}
