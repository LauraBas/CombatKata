<?php

namespace Tests;

use  PHPUnit\Framework\TestCase;
use App\CombatKata;


class CombatKataTest extends TestCase {

	public function test_return_Combat_if_value_multiple_3(
	) {
		$combat = new CombatKata();
		$result = $combat->changeValue(3);

		$this->assertEquals('Combat', $result);
	}

}


