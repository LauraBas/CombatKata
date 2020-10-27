<?php

namespace App;

class Character {
    private int $health = 1000;
    private int $level = 1;
    private int $maxRange;
    private array $factions = [];

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
    
    public function attackCharacter(Character $other , int $damage, int $distance)
    {     
        if ($this !== $other) 
        {  
            if ($this->isAlly($other) == false)
            {                
                if ($this->isInRangeToattackCharacter($distance)) 
                {    
                    if ($other->isAlive())
                    {   
                        if (($other->level - $this->level) >= 5)
                        {
                            $other->health -= $damage/2;
                        }  
                        
                        else if (($this->level - $other->level) >= 5)
                        {
                            $other->health -= $damage*2;
                        }  
                        else
                        {
                            $other->health -= $damage;                    
                        }                                
                        
                    }
                }
            }
        }
    }

    public function isInRangeToattackCharacter($distance)
    {
       return $distance <= $this->getMaxRange();
    }
    
    public function heal(Character $other, int $heal)
    {   
        if ($other->isAlive())
        {
            if ($this->isAlly($other) || $this === $other)
            {
                $other->health += $heal;
                if ($other->health > 1000)   
                {
                    $other->health = 1000;
                }     
            }
                                                              
        }
    }

    public function getMaxRange() :int
    {
        return $this->maxRange;
    }

    public function joinFaction(string $factionName)
    {
        array_push($this->factions, $factionName); 
       
    }
    public function leaveFaction(string $factionName)
    {
        for($i = 0; $i < count($this->factions); $i++)
        {
            if ($factionName === $this->factions[$i])
            {
                array_splice($this->factions, $i, 1);
            }
        }
       
    }    
    public function getFaction() :array
    {
        return $this->factions;
    }

    public function isAlly($other) :bool
    {
        return count(array_intersect($this->getFaction(), $other->getFaction())) > 0;
        
    }

    public function attackProp(Prop $prop, int $damage) 
    {
        $prop->damage($damage);
    }
}
