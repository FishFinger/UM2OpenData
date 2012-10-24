<?php

class Instant {

    public $inXSDDateTime; // String (xsd:datetime)

    public function __construct($inXSDDateTime = NULL) {
        $this->setInXSDDateTime($inXSDDateTime);
    }

    public function getInXSDDateTime() {
        return $this->inXSDDateTime;
    }

    public function setInXSDDateTime($inXSDDateTime) {
        // TODO verif format date
        $this->inXSDDateTime = $inXSDDateTime;
    }

    public function __toString() {
        return $this->getInXSDDateTime();
    }

}
