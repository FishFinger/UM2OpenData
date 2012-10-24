<?php

class Instant {
  public $inXSDDateTime; // String (xsd:datetime)

  public function __construct($inXSDDateTime) {
    $this->inXSDDateTime = $inXSDDateTime;
  }

  public function getInXSDDateTime() {
    return $this->inXSDDateTime;
  }

  public function __toString() {
    return $this->getInXSDDateTime();
  }
}
