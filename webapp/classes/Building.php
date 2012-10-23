<?php

class Building {
  private $id;		// String
  private $label;	// String
  private $geolocation	// String (Way URL)
  
  public function __construct($id, $label, $geolocation) {
    $this->id = $id;
    $this->label = $label;
    $this->geolocation = $geolocation;
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
}
