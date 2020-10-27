<?php

namespace App;

class Character {
    private int $health = 1000;
    private int $level = 1;
    private int $maxRange;
    private array $factions = [];
    const MAX_HEALTH = 1000;
    const MIN_HEALTH = 0;
    const RANGE_MELEE_FIGHT = 2;
    const RANGE_RANGED_FIGHT = 20;
    const TARGET_LEVEL = 5;

    public static function createMelee() 
    {
        return new Character(self::RANGE_MELEE_FIGHT);
    }

    public static function createRanged() 
    {
        return new Character(self::RANGE_RANGED_FIGHT);
    }

    private function __construct(int $maxRange) 
    {
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
        return $this->health > self::MIN_HEALTH;
    }
    
    public function attackCharacter(Character $other , int $damage, int $distance) 
    {             
        if($this->canAttack($other, $distance))
        {                                                          
            if ($this->isLevelTargetAbove($other))
            {
                $other->health -= $damage/2;
            }                          
            else if ($this->isLevelTargetBelow($other))
            {
                $other->health -= $damage*2;
            }  
            else
            {
                $other->health -= $damage;                    
            }                                                                                        
        }
        
    }

    public function canAttack($other, $distance)
    {
        return ($this !== $other && !$this->isAlly($other) 
                && $other->isAlive() 
                && $this->isInRangeToattackCharacter($distance));
    }

    public function isInRangeToattackCharacter($distance)
    {
       return $distance <= $this->getMaxRange();
    }

    public function isLevelTargetAbove($other)
    {
         return ($other->level - $this->level) >= self::TARGET_LEVEL;
    }

    public function isLevelTargetBelow($other)
    {
        return ($this->level - $other->level) >= self::TARGET_LEVEL;
    }
    
    public function heal(Character $other, int $heal)
    {   
        if ($other->isAlive())
        {
            if ($this->isAlly($other) || $this === $other)
            {
                $other->health += $heal;
                if ($other->health > self::MAX_HEALTH)   
                {
                    $other->health = self::MAX_HEALTH;
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
