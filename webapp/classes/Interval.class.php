<?php

require_once dirname(__FILE__) . '/Instant.class.php';

class Interval {

    private $hasBeginning; // Instant
    private $hasEnd;  // Instant

    public function __construct(Instant $hasBeginning = NULL, Instant $hasEnd = NULL) {
        $this->setHasBeginning($hasBeginning);
        $this->setHasEnd($hasEnd);
    }

    public function getHasBeginning() {
        return $this->hasBeginning;
    }

    public function getHasEnd() {
        return $this->hasEnd;
    }

    public function setHasBeginning($hasBeginning) {
        $this->hasBeginning = $hasBeginning;
    }

    public function setHasEnd($hasEnd) {
        $this->hasEnd = $hasEnd;
    }

    public function __toString() {
        return '[' . $this->getHasBeginning() . ',' . $this->getHasEnd() . ']';
    }

}
