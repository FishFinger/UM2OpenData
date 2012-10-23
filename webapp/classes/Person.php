<?php

class Person {
  private $id;		// String
  private $firstname;	// String
  private $lastname;	// String
  private $mbox;	// String
  private $phone;	// String
  private $office;	// String
  private $seeAlso;	// String (URL to description)

  public function __construct($id, $firstname, $lastname, $mbox, $phone, $office, $seeAlso){
    $this->id = $id;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->mbox = $mbox;
    $this->phone = $phone;
    $this->office = $office;
    $this->seeAlso = $seeAlso;
  }

  public function getId() {
    return $this->id;
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function getLastname() {
    return $this->lastname;
  }

  public function geMbox() {
    return $this->mbox;
  }

  public function getPhone() {
    return $this->phone;
  }

  public function getOffice() {
    return $this->office;
  }

  public function getSeeAlso() {
    return $this->seeAlso;
  }
}
