<?php

use Nuffle\Nuffle;

class NuffleTest extends PHPUnit_Framework_TestCase {

  /**
   * Test valid rolls
   *
   * Testing a random number generator is weird. To accomplish this, we
   * pre-generate a list of expected results based on pre-defined seed values
   * and test the roll() method against each element in the set.
   */
  public function testValidRolls() {
    $seeds = array(9,12,12,10,1,16,3,19,3,20,5,17,18,5,10,4,16,15,7,18);

    foreach ( $seeds as $seed => $result ) {
      mt_srand($seed);

      $roll = Nuffle::roll(20);

      $this->assertEquals($result, $roll);
      $this->assertGreaterThanOrEqual(1, $roll);
      $this->assertLessThanOrEqual(20, $roll);
    }
  }

  /**
   * Test invalid rolls
   */
  public function testInvalidRolls() {
    $sides = array(-1, 0, 1, "troll", 20.5, null, true, false, "20", array(), new stdClass());

    foreach ( $sides as $side ) {
      try {
        Nuffle::roll($side);
        $this->fail("Expected exception not thrown");
      } catch(\Exception $e) { //Not catching a generic Exception or the fail function is also catched
        $this->assertEquals("Invalid number of sides.", $e->getMessage());
      }
    }
  }
}
