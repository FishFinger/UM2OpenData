<?php

class Building {

    private $id;  // String
    private $label; // String
    private $geolocation; // String (Way URL)

    public function __construct($id = NULL, $label = NULL, $geolocation = NULL) {
        $this->setId($id);
        $this->setLabel($label);
        $this->setGeolocation($geolocation);
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getGeolocation() {
        return $this->geolocation;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setGeolocation($geolocation) {
        $this->geolocation = $geolocation;
    }

    public function __toString() {
        return $this->getId();
    }

}
