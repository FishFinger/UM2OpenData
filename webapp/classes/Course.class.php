<?php
require_once dirname(__FILE__).'/Person.class.php';

class Course {
  private $id;		// String
  private $label;	// String
  private $comment;	// String
  private $managedby;	// Person

  public function __construct($id, $label, $comment, Person $managedby) {
    $this->id = $id;
    $this->label = $label;
    $this->comment = $comment;
    $this->managedby = $managedby;
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

  public function getManagedby() {
    return $this->managedby;
  }

  public function __toString() {
    return $this->getId();
  }
}
