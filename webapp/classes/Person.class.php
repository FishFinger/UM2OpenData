<?php

class Person {

    private $id;  // String
    private $firstname; // String
    private $lastname; // String
    private $mbox; // String
    private $phone; // String
    private $office; // String
    private $seeAlso; // String (URL to description)

    public function __construct($id = NULL, $firstname = NULL, $lastname = NULL, $mbox = NULL, $phone = NULL, $office = NULL, $seeAlso = NULL) {
        $this->setId($id);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);
        $this->setMbox($mbox);
        $this->setPhone($phone);
        $this->setOffice($office);
        $this->setSeeAlso($seeAlso);
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

    public function getMbox() {
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }

    public function setMbox($mbox) {
        $this->mbox = $mbox;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setOffice($office) {
        $this->office = $office;
    }

    public function setSeeAlso($seeAlso) {
        $this->seeAlso = $seeAlso;
    }

    public function toFullString() {
        $tostring = "Person id        '" . $this->getId() . "'\n";
        $tostring .= "       firstname '" . $this->getFirstname() . "'\n";
        $tostring .= "       lastname  '" . $this->getLastname() . "'\n";
        $tostring .= "       mbox      '" . $this->getMbox() . "'\n";
        $tostring .= "       office    '" . $this->getOffice() . "'\n";
        $tostring .= "       phone     '" . $this->getPhone() . "'\n";
        $tostring .= "       seeAlso   '" . $this->getSeeAlso() . "'\n";
        
        return $tostring;
    }

    public function __toString() {
        return $this->getId();
    }

}
