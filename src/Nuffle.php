<?php namespace Nuffle;

class Nuffle {

  /**
   * Roll an $x-sided dice
   * 
   * @return Integer A number between 1 and $x (inclusive)
   */
  static function roll($x = 0) {
    // validate
    if ( $x < 2 || !is_int($x) ) {
      throw new \Exception("Invalid number of sides.");
    }

    // roll
    return rand(1, $x);
  }
}
