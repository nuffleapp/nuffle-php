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
    $equations = array(20 => 20, '20' => 20, '20 + 10' => 30, '20 / 10' => 2, '20 - 10' => 10, '20 * 10' => 200, '1d20' => 12, '1d20 + 20' => 21, '1d20 + 2d6' => 27, '2d6' => 11, '(1d20 - 20) / 3d10' => 0, '((1d20 - 20) / 3d10) - 3d10' => -18.4375, '((1d20 - 20) / 3d10) - 3d10 * 15' => -195.55555555556, '1d20 * 1d6' => 72, '1d20 / 1d6' => 2.6666666666667, '1d20 - 1d6' => 8);

    mt_srand(1);

    foreach ( $equations as $equation => $result ) {
      $roll = Nuffle::roll($equation);

      $this->assertEquals($result, $roll->result);
    }
  }

  /**
   * Test invalid rolls
   */
  public function testMissingInput() {
    try {
      Nuffle::roll();
      $this->fail("Expected exception not thrown");
    } catch(\Exception $e) {
      $this->assertEquals("Input can't be blank.", $e->getMessage());
    }
  }

  public function testInvalidEquations() {
    $inputs = array(")", "(", "0d0", "0d1", "1d0", "d1", "1d", "1d20 +", "+ 1d20", "1d20 -", "- 1d20", "1d20 /", "/ 1d20", "1d20 *", "* 1d20", "nuffle");

    foreach ( $inputs as $input ) {
      try {
        Nuffle::roll($input);
        $this->fail("Expected exception not thrown");
      } catch(\Exception $e) {
        $this->assertEquals("Invalid equation.", $e->getMessage());
      }
    }
  }

  public function testUnbalancedEquations() {
    $inputs = array("((1d20)", "(1d20))");

    foreach ( $inputs as $input ) {
      try {
        Nuffle::roll($input);
        $this->fail("Expected exception not thrown");
      } catch(\Exception $e) {
        $this->assertEquals("Unbalanced parens.", $e->getMessage());
      }
    }
  }

  public function testInvalidObjectTypes() {
    $inputs = array(true, array(), new stdClass());

    foreach ( $inputs as $input ) {
      try {
        Nuffle::roll($input);
        $this->fail("Expected exception not thrown");
      } catch(\Exception $e) {
        $this->assertEquals("Input must be an equation or a number.", $e->getMessage());
      }
    }
  }
}
