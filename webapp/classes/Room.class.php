<?php

require_once dirname(__FILE__) . '/Building.class.php';

class Room {

    private $id;  // String
    private $label; // String
    private $locatedin; // Building

    public function __construct($id, $label, Building $locatedin) {
        $this->id = $id;
        $this->label = $label;
        $this->locatedin = $locatedin;
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

    public function __toString() {
        return $this->getId();
    }

}
