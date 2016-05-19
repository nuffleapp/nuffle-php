<?php namespace Nuffle;

/**
 * Singleton-style wrapper around Nuffle\Calculator
 */
class Nuffle {

  /**
   * Parse and calculate user submitted dice-roll equations
   * 
   * @param  string $equation User input
   * @return object           Nuffle\Calculator object
   */
  static function roll($equation = "") {
    $calculator = new Calculator($equation);
    return $calculator->calculate();
  }
}

/**
 * Nuffle calculator class
 */
class Calculator {
  /**
   * User input
   * 
   * @var string
   */
  public $input = "";

  /**
   * Parsed equation
   * 
   * @var string
   */
  public $equation = "";

  /**
   * Roll results
   * 
   * @var array
   */
  public $rolls = array();

  /**
   * Equation result
   * 
   * @var integer
   */
  public $result = 0;

  /**
   * Constructor
   * 
   * @param string $input User input
   */
  public function __construct($input) {
    // validate and save input
    $this->_validate($input);
  }

  /**
   * Calculate the results based on the user input
   * 
   * @return object
   */
  public function calculate() {
    // reset the rolls array
    $this->rolls = array();

    // throw rolls and replace 'xdy' dice notation with results
    $this->equation = preg_replace_callback("/(?P<count>\d+)d(?P<sides>\d+)/", "self::_expand_equation", $this->input);

    // calculate result
    $this->result = @eval("return $this->equation;");

    return $this;
  }

  /**
   * Validate user input
   * 
   * @param  string $input User input
   * @return void
   */
  private function _validate($input) {
    // need an input
    if ( !isset($input) ) {
      throw new \Exception("Input is required.");
    }

    // has to be something we can calculate
    if ( !is_string($input) && !is_numeric($input) ) {
      throw new \Exception("Input must be an equation or a number.");
    }

    // no empty inputs
    if ( empty($input) ) {
      throw new \Exception("Input can't be blank.");
    }

    // validate the input format
    if ( !preg_match("/^[\(\s]*(([1-9][0-9]*d[1-9][0-9]*)|\d+)[\s\)]*(\s*([\-\+\*\/])[\s\(]*(([1-9][0-9]*d[1-9][0-9]*)|\d+)\)*)*$/i", $input) ) {
      throw new \Exception("Invalid equation.");
    }

    // make sure the parens are balanced
    if ( !$this->_is_balanced($input) ) {
      throw new \Exception("Unbalanced parens.");
    }

    $this->input = $input;
  }

  /**
   * Check if equation has balanced parens
   * 
   * @param  string  $input User input
   * @return boolean        Whether or not the parens are balanced
   */
  private function _is_balanced($input) {
    $balance = 0;

    foreach ( str_split($input) as $char ) {
      if ( $char == '(' ) {
        $balance++;
      } else if ( $char == ')' ) {
        $balance--;
      }

      // found a close paren without a matching open paren,
      // no need to continue further
      if ( $balance < 0 ) {
        break;
      }
    }

    return $balance === 0;
  }

  /**
   * Roll dice and expand the input into a matching equation
   * 
   * @param  string $matches Regex match
   * @return string          Replaced match
   */
  private function _expand_equation($matches) {
    $rolls = array();

    for ( $i = 0; $i < $matches['count']; $i++ ) {
      $rolls[] = mt_rand(1, $matches['sides']);
    }

    // save individual roll results
    $this->rolls[] = array(
        'notation' => $matches[0],
        'rolls' => $rolls
      );

    return "(" . implode(" + ", $rolls) . ")";
  }
}