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
			$result = $character->damage(100);
	
			$this->assertEquals($character->getHealth(), 900);
		}
	public function test_return_Character_Alive_False_After_Damage(
		) {
			$character = new Character();
			$character->damage(1001);
	
			$this->assertEquals($character->isAlive(), false);
		}
	
		public function test_return_Character_Can_Heal_Character(
			) {
				$character = new Character();
				$character->damage(100);
				$character->heal(50);
				$this->assertEquals($character->getHealth(), 950);
			}	
		public function test_return_Character_State_if_is_dead(
			) {			
				$character = new Character();
				$character->damage(1000);			
				$character->heal(100);
				
				$this->assertEquals($character->isAlive(), false);
				$this->assertEquals($character->getHealth(), 0);
			}
		public function test_return_Character_Healing_cannot_raise_health_1000(
			) {	
				//given		
				$character = new Character();
				$character->damage(100);
				//when			
				$character->heal(150);			
				//then
				$this->assertEquals($character->getHealth(), 1000);
			}


}


?>