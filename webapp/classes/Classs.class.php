<?php

require_once dirname(__FILE__) . '/Room.class.php';
require_once dirname(__FILE__) . '/Interval.class.php';
require_once dirname(__FILE__) . '/Course.class.php';

class Classs {

    private $uid;   // String
    private $label;  // String
    private $comment;  // String
    private $seeAlso;  // String (planning UM2 URL)
    private $takesplacein; // Room List
    private $time;  // Interval
    private $relatedto;  // Course 

    public function __construct($uid = NULL, $label = NULL, $comment = NULL, $seeAlso = NULL, array $takesplacein = NULL, Interval $time = NULL, Course $relatedto = NULL) {
        $this->uid = $uid;
        $this->label = $label;
        $this->comment = $comment;
        $this->seeAlso = $seeAlso;
        $this->takesplacein = $takesplacein;
        $this->time = $time;
        $this->relatedto = $relatedto;
    }

    public function getUid() {
        return $this->uid;
    }

    public function getLabel() {
        return $this->label;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getSeeAlso() {
        return $this->seeAlso;
    }

    public function getTakesplacein() {
        return $this->takesplacein;
    }

    public function getTime() {
        return $this->time;
    }

    public function getRelatedto() {
        return $this->relatedto;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setSeeAlso($seeAlso) {
        $this->seeAlso = $seeAlso;
    }

    public function setTakesplacein(array $takesplacein) {
        // TODO verifier le type des éléments de takesplacein (Room)
        $this->takesplacein = $takesplacein;
    }

    public function setTime(Interval $time) {
        $this->time = $time;
    }

    public function setRelatedto(Course $relatedto) {
        $this->relatedto = $relatedto;
    }

    public function toFullString() {
        $tostring = "Course uid          '" . $this->getUid() . "'\n";
        $tostring .= "       label        '" . $this->getLabel() . "'\n";
        $tostring .= "       comment      '" . $this->getComment() . "'\n";
        $tostring .= "       seeAlso      '" . $this->getSeeAlso() . "'\n";
        for ($i = 0; $i < count($this->getTakesplacein()); ++$i) {
            $tostring .= "       takesplacein '" . $this->getTakesplacein()[$i] . "'\n";
        }
        $tostring .= "       time         '" . $this->getTime() . "'\n";
        $tostring .= "       relatedto    '" . $this->getRelatedto() . "'\n";

        return $tostring;
    }

    public function __toString() {
        return $this->getUid();
    }

}
