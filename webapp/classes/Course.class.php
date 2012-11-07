<?php

require_once dirname(__FILE__) . '/Person.class.php';

class Course {

    private $id;  // String
    private $label; // String
    private $comment; // String
    private $managedby; // Person

    public function __construct($id = NULL, $label = NULL, $comment = NULL, Person $managedby = NULL)     {
        $this->setId($id);
        $this->setLabel($label);
        $this->setComment($comment);
        $this->setManagedby($managedby);
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

    public function setId($id) {
        $this->id = $id;
    }

    public function setLabel($label) {
        $this->label = $label;
    }

    public function setComment($comment) {
        $this->comment = $comment;
    }

    public function setManagedby($manegedby) {
        $this->managedby = $manegedby;
    }
    
    public function toHTMLString(){
       $string = "";
        $string .= "id: ".$this->getId()."<br />";
        $string .= "label: ".$this->getLabel()."<br />";
        $string .= "comment: ".$this->getComment()."<br />";
        $string .= "Manager: <br />".$this->getManagedby()->toHTMLString(); 
        return $string;
    }

    public function __toString() {
       return $this->getId();
    }

}
