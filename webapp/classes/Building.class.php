<?php

class Building {

    private $id;  // String
    private $label; // String
    private $geolocation; // String (Way URL)

    public function __construct($id = NULL, $label = NULL, $locatedin = NULL) {
        $this->setId($id);
        $this->setLabel($label);
        $this->setLocatedin($locatedin);
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getLocatedin() {
        return $this->geolocation;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setLocatedin($locatedin) {
        $this->geolocation = $locatedin;
    }

    public function __toString() {
        return $this->getId();
    }

}
