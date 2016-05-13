<?php namespace Nuffle;

class Nuffle {

  /**
   * Roll an $x-sided dice
   * 
   * @return Integer A number between 1 and $x (inclusive)
   */
  static function roll($x = 0) {
    // validate
    if ( $x < 2 || gettype($x) !== "integer" ) {
      throw new \Exception("Invalid number of sides.");
    }

    // roll
    return mt_rand(1, $x);
  }
}
