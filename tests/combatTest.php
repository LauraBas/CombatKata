<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Character;

class CombatKataTest extends TestCase {

	public function test_return_Character_Initial_Health(
	) {
		$character = new Character();
		$character->getHealth();

		$this->assertEquals($character->getHealth(), 1000);
	  }
	public function test_return_Character_Initial_Level(
		) {
			$character = new Character();
			$character->getLevel();
	
			$this->assertEquals($character->getLevel(), 1);
		}
	public function test_return_Character_Initial_Alive_True(
		) {
			$character = new Character();
			$character->isAlive();
	
			$this->assertEquals($character->isAlive(), true);
		}
	public function test_return_Character_Health_After_Damage(
		) {
			$character = new Character();
			$opponent = new Character();

			$character->attack($opponent, 100);
	
			$this->assertEquals(900, $opponent->getHealth());
		}
	public function test_return_Character_Alive_False_After_Damage(
		) {
			$character = new Character();
			$opponent = new Character();
			$character->attack($opponent, 1001);
	
			$this->assertEquals($opponent->isAlive(), false);
		}
	
		public function test_return_Character_Can_Heal_Character(
			) {
				$character = new Character();
				$opponent = new Character();
				$character->attack($opponent ,100);
				$opponent->heal(50);
				$this->assertEquals($opponent->getHealth(), 950);
			}	
		public function test_return_Character_State_if_is_dead(
			) {			
				$character = new Character();
				$opponent = new Character();
				$character->attack($opponent, 1000);			
				$opponent->heal(100);
				
				$this->assertEquals($opponent->isAlive(), false);
				$this->assertEquals($opponent->getHealth(), 0);
			}
		public function test_return_Character_Healing_cannot_raise_health_1000(
			) {	
				//given		
				$character = new Character();
				$opponent = new Character();
				//when			
				$character->attack($opponent, 100);
				$opponent->heal(150);			
				//then
				$this->assertEquals($opponent->getHealth(), 1000);
			}
		public function test_return_Character_cannot_damage_itself(
			) {	
				//given		
				$character1 = new Character();
				//when			
				$character1->attack($character1, 100);				
				//then
				$this->assertEquals(1000, $character1->getHealth());
			}
		


}


?>