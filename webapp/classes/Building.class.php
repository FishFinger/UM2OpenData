<?php

class Building {

    private $id;  // String
    private $label; // String
    private $comment; // String
    private $geolocation; // String (Way URL)

    public function __construct($id = NULL, $label = NULL, $comment = NULL, $locatedin = NULL) {
        $this->setId($id);
        $this->setLabel($label);
        $this->setComment($comment);
        $this->setLocatedin($locatedin);
    }

    public function getId() {
        return $this->id;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getComment() {
        return $this->comment;
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

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setLocatedin($locatedin) {
        $this->geolocation = $locatedin;
    }

    public function __toString() {
        return $this->getId();
    }

}
