<?php
require_once dirname(__FILE__).'/Room.php';
require_once dirname(__FILE__).'/Interval.php';
require_once dirname(__FILE__).'/Course.php';

class Class {
  private $uid;			// String
  private $label;		// String
  private $comment;		// String
  private $seeAlso;		// String (planning UM2 URL)
  private $takesplacein;	// Room List
  private $time;		// Interval
  private $relatedto;		// Course 

  public function __construct($uid, $label, $comment, $seeAlso, $takesplacein, Interval $time, Course $relatedto) {
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
}
