<?php

require_once dirname(__FILE__) . '/Building.class.php';

class Room {

    private $id;  // String
    private $label; // String
    private $locatedin; // Building

    public function __construct($id = NULL, $label = NULL, Building $locatedin = NULL) {
        $this->setId($id);
        $this->setLabel($label);
        $this->setLocatedIn($locatedin);
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getLocatedIn() {
        return $this->locatedin;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setLocatedIn($locatedin) {
        $this->locatedin = $locatedin;
    }

    public function __toString() {
        return $this->getId();
    }

}
