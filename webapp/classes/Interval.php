<?php
require_once './Instant.php';

class Interval {
  private $hasBeginning;	// Instant
  private $hasEnd;		// Instant

  public function __construct(Instant $hasBeginning, Instant $hasEnd){
    $this->hasBeginning = $hasBeginning;
    $this->hasEnd = $hasEnd;
  }

  public function getHasBeginning() {
    return $this->hasBeginning;
  }

  public function getHasEnd() {
    return $this->hasEnd;
  }
}
