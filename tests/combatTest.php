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

}


?>