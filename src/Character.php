<?php

namespace App;



class Character {
    public  int $health = 1000;
    public  int $level = 1;

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
}
