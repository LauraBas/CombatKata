<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Models\Character;
use App\Models\Prop;

class CombatKataTest extends TestCase {

	public function test_return_Character_Initial_Health(
		) {
			$character = Character::createMelee();
			$character->getHealth();

			$this->assertEquals($character->getHealth(), 1000);
		}
	public function test_return_Character_Initial_Level(
		) {
			$character = Character::createMelee();
			$character->getLevel();

			$this->assertEquals($character->getLevel(), 1);
		}
	public function test_return_Character_Initial_Alive_True(
		) {
			$character = Character::createMelee();
			$character->isAlive();
	
			$this->assertEquals($character->isAlive(), true);
		}
	public function test_return_Character_Health_After_Damage(
		) {
			$character = Character::createMelee();
			$character->joinFaction('blue');
			$opponent = Character::createMelee();
			$opponent->joinFaction('red');			
			$character->attackCharacter($opponent, 100, 1);
			

			$this->assertEquals(900, $opponent->getHealth());			
		}

	public function test_return_Character_Alive_False_After_Damage(
		) {
			$character = Character::createMelee();				
			$opponent = Character::createMelee();
			$character->attackCharacter($opponent, 1001, 1);
			
	
			$this->assertEquals(false, $opponent->isAlive());
		}

	public function test_return_Character_Can_Heal_Character(
		) {
			$character = Character::createMelee();
			$character->joinFaction('red');
			$opponent = Character::createMelee();
			$opponent->joinFaction('blue');
			$other = Character::createRanged();
			$other->joinFaction('blue');

			$character->attackCharacter($opponent ,100, 1);
			$other->heal($opponent, 50);

			$this->assertEquals($opponent->getHealth(), 950);
		}	
	public function test_return_Character_State_if_is_dead(
		) {			
			$character = Character::createMelee();
			$opponent = Character::createMelee();
			$other = Character::createRanged();
			$opponent->joinFaction('blue');
			$other->joinFaction('blue');

			$character->attackCharacter($opponent, 1000, 1);
						
			$other->heal($opponent, 150);
			
			$this->assertEquals($opponent->isAlive(), false);
			$this->assertEquals($opponent->getHealth(), 0);
		}
	public function test_return_Character_Healing_cannot_raise_health_1000(
		) {	
					
			$character = Character::createMelee();
			$opponent = Character::createMelee();
			$other = Character::createRanged();
			$opponent->joinFaction('blue');
			$other->joinFaction('blue');
						
			$character->attackCharacter($opponent, 100, 1);
			$other->heal($opponent, 150);			
			
			$this->assertEquals($opponent->getHealth(), 1000);
		}
	public function test_return_Character_cannot_damage_itself(
		) {	
					
			$character1 = Character::createMelee();
						
			$character1->attackCharacter($character1, 100, 1);				
			
			$this->assertEquals(1000, $character1->getHealth());
		}
	public function test_return_Character_can_only_heal_itself(
		) {	
					
			$character = Character::createMelee();
			$opponent = Character::createMelee();
						
			$character->attackCharacter($opponent, 100, 1);
			$opponent->heal($opponent, 50);				
			
			$this->assertEquals(950, $opponent->getHealth());
		}
	public function test_return_damage_is_half_if_opponent_level_is_5_above(
		) {	
					
			$character = Character::createMelee();
			$opponent = Character::createMelee();
			$opponent->setLevel(6);
						
			$character->attackCharacter($opponent, 200, 1);							
			
			$this->assertEquals(900, $opponent->getHealth());
		}
	public function test_return_damage_is_double_if_opponent_level_is_5_below(
		) {	
					
			$character = Character::createMelee();
			$opponent = Character::createMelee();
			$character->setLevel(6);
						
			$character->attackCharacter($opponent, 100, 1);							
			
			$this->assertEquals(800, $opponent->getHealth());
		}
	public function test_return_character_Melee_have_attackCharacter_Max_Range_2(
		) {	
					
			$character = Character::createMelee();
						
			$character->getMaxRange();											
			
			$this->assertEquals(2, $character->getMaxRange());
		}
	public function test_return_character_Ranged_have_attackCharacter_Max_Range_20(
		) {	
					
			$character = Character::createRanged();
						
			$character->getMaxRange();											
			
			$this->assertEquals(20, $character->getMaxRange());
		}
	public function test_return_character_Must_Be_in_Range_to_dammage(
		) {	
					
			$character = Character::createRanged();
			$opponent = Character::createMelee();
						
			$character->attackCharacter($opponent, 100, 30);											
			
			$this->assertEquals(1000, $opponent->getHealth());
		}
	public function test_return_character_faction(
		) {	
					
			$character = Character::createRanged();
						
			$character->joinFaction('red');													
			
			$this->assertEquals(['red'], $character->getFaction());
		}
	public function test_return_character_leave_faction(
		) {	
					
			$character = Character::createRanged();
			$character->joinFaction('red');
			$character->joinFaction('blue');													
				
			$character->leaveFaction('blue');		
			
			$this->assertEquals(['red'], $character->getFaction());
		}
	public function test_return_characters_is_allies_when_same_faction(
		) {	
					
			$character = Character::createRanged();
			$character->joinFaction('red');							
			$character2 = Character::createMelee();	
			$character2->joinFaction('red');																	
				
			$character->isAlly($character2);		
			
			$this->assertEquals(true, $character->isAlly($character2));
		}
	public function test_return_characters_allies_cannot_attackCharacter(
		) {	
					
			$character = Character::createRanged();
			$character->joinFaction('red');							
			$opponent = Character::createMelee();	
			$opponent->joinFaction('red');																	
				
			$character->attackCharacter($opponent, 100, 1);								
			
			$this->assertEquals(1000, $opponent->getHealth());
		}
	public function test_return_allies_can_heal_another(
		) {	
			
			$opponent = Character::createRanged();
			$opponent->joinFaction('blue');
			$character = Character::createRanged();
			$character->joinFaction('red');							
			$other = Character::createMelee();	
			$other->joinFaction('red');																	
				
			$opponent->attackCharacter($character, 100, 1);
			$other->heal($character, 50);				
			
			$this->assertEquals(950, $character->getHealth());
		}

		public function test_return_health_after_attackCharacter_a_prop(
		) {
			
			$character = Character::createRanged();
			$tree =  new Prop(100);
						
			$character->attackProp($tree, 50);
			
			$this->assertEquals(50, $tree->getHealth());
		}
		public function test_return_destroyed_prop_after_health_0(
		) {
			
			$character = Character::createRanged();
			$tree =  new Prop(100);
						
			$character->attackProp($tree, 100);
			
			$this->assertEquals(true, $tree->isDestroyed());
		}
}

?>