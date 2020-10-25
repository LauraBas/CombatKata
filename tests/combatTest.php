<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Character;

class CombatKataTest extends TestCase {

	public function test_return_Character_Initial_Health(
	) {
		$character = new Character('Melee');
		$character->getHealth();

		$this->assertEquals($character->getHealth(), 1000);
	  }
	public function test_return_Character_Initial_Level(
		) {
			$character = new Character('Melee');
			$character->getLevel();
	
			$this->assertEquals($character->getLevel(), 1);
		}
	public function test_return_Character_Initial_Alive_True(
		) {
			$character = new Character('Melee');
			$character->isAlive();
	
			$this->assertEquals($character->isAlive(), true);
		}
	public function test_return_Character_Health_After_Damage(
		) {
			$character = new Character('Melee');
			$opponent = new Character('Melee');

			$character->attack($opponent, 100, 2);
	
			$this->assertEquals(900, $opponent->getHealth());
		}
	public function test_return_Character_Alive_False_After_Damage(
		) {
			$character = new Character('Melee');
			$opponent = new Character('Melee');
			$character->attack($opponent, 1001, 1);
	
			$this->assertEquals($opponent->isAlive(), false);
		}
	
		public function test_return_Character_Can_Heal_Character(
			) {
				$character = new Character('Melee');
				$opponent = new Character('Melee');
				$character->attack($opponent ,100, 1);
				$opponent->heal(50);
				$this->assertEquals($opponent->getHealth(), 950);
			}	
		public function test_return_Character_State_if_is_dead(
			) {			
				$character = new Character('Melee');
				$opponent = new Character('Melee');
				$character->attack($opponent, 1000, 1);			
				$opponent->heal(100);
				
				$this->assertEquals($opponent->isAlive(), false);
				$this->assertEquals($opponent->getHealth(), 0);
			}
		public function test_return_Character_Healing_cannot_raise_health_1000(
			) {	
				//given		
				$character = new Character('Melee');
				$opponent = new Character('Melee');
				//when			
				$character->attack($opponent, 100, 1);
				$opponent->heal(150);			
				//then
				$this->assertEquals($opponent->getHealth(), 1000);
			}
		public function test_return_Character_cannot_damage_itself(
			) {	
				//given		
				$character1 = new Character('Melee');
				//when			
				$character1->attack($character1, 100, 1);				
				//then
				$this->assertEquals(1000, $character1->getHealth());
			}
		public function test_return_Character_can_only_heal_itself(
			) {	
				//given		
				$character = new Character('Melee');
				$opponent = new Character('Melee');
				//when			
				$character->attack($opponent, 100, 1);
				$opponent->heal(50);				
				//then
				$this->assertEquals(950, $opponent->getHealth());
			}
		public function test_return_damage_is_half_if_opponent_level_is_5_above(
			) {	
				//given		
				$character = new Character('Melee');
				$opponent = new Character('Melee');
				$opponent->level = 6;
				//when			
				$character->attack($opponent, 200, 1);							
				//then
				$this->assertEquals(900, $opponent->getHealth());
			}
		public function test_return_damage_is_double_if_opponent_level_is_5_below(
			) {	
				//given		
				$character = new Character('Melee');
				$opponent = new Character('Melee');
				$character->level = 6;
				//when			
				$character->attack($opponent, 100, 1);							
				//then
				$this->assertEquals(800, $opponent->getHealth());
			}
		public function test_return_character_Melee_have_attack_Max_Range_2(
			) {	
				//given		
				$character = new Character('Melee');
				//when			
				$character->getMaxRange();											
				//then
				$this->assertEquals(2, $character->getMaxRange());
			}
		public function test_return_character_Ranged_have_attack_Max_Range_20(
			) {	
				//given		
				$character = new Character('Ranged');
				//when			
				$character->getMaxRange();											
				//then
				$this->assertEquals(20, $character->getMaxRange());
			}
		public function test_return_character_Must_Be_in_Range_to_dammage(
			) {	
				//given		
				$character = new Character('Ranged');
				$opponent = new Character('Melee');
				//when			
				$character->attack($opponent, 100, 30);											
				//then
				$this->assertEquals(1000, $opponent->getHealth());
			}
		


}


?>