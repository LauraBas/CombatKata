<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Character;

class CombatKataTest extends TestCase {

	public function test_return_Character_Initial_Health(
	) {
		$character = new Character();
		$result = $character->getCharacterHealth();

		$this->assertEquals($health = 1000, $result);
	}
	public function test_return_Character_Initial_Level(
		) {
			$character = new Character();
			$result = $character->getCharacterLevel();
	
			$this->assertEquals($level = 1, $result);
		}
	public function test_return_Character_Initial_Alive_True(
		) {
			$character = new Character();
			$result = $character->getAliveState();
	
			$this->assertEquals($alive = true, $result);
		}
	public function test_return_Character_Health_After_Damage(
		) {
			$character = new Character();
			$result = $character->characterDamage(100);
	
			$this->assertEquals($alive = true, $health = 900, $result);
		}
	public function test_return_Character_Alive_False_After_Damage(
		) {
			$character = new Character();
			$result = $character->characterDamage(1000);
	
			$this->assertEquals($alive = false, $result);
		}

}


?>