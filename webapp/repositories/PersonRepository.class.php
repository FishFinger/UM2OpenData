<?php

require_once dirname(__FILE__) . '/../conf.php';
require_once dirname(__FILE__) . '/sparqlConnection.php';
require_once dirname(__FILE__) . '/../libraries/sparqllib.php';
require_once dirname(__FILE__) . '/../classes/Person.class.php';

class PersonRepository {

    private static $fields = array(
        "http://www.w3.org/2000/01/rdf-schema#seeAlso" => "setSeeAlso",
        "http://xmlns.com/foaf/0.1/firstName" => "setFirstname",
        "http://xmlns.com/foaf/0.1/lastname" => "setLastname",
        "http://xmlns.com/foaf/0.1/mbox" => "setMbox",
        "http://xmlns.com/foaf/0.1/office" => "setOffice",
        "http://xmlns.com/foaf/0.1/phone" => "setPhone");

    public static function retrieve($id) {
        $sparql = "
SELECT DISTINCT * WHERE {
  <$id> ?predicate ?object
}
ORDER BY ?predicate";

        $result = sparql_query(SPARQL_NS . $sparql);

        $person = new Person($id);

        while ($row = sparql_fetch_array($result)) {
//            var_dump($row);
            if (isset(PersonRepository::$fields[$row["predicate"]]) && method_exists($person, PersonRepository::$fields[$row["predicate"]]))
                $person->{PersonRepository::$fields[$row["predicate"]]}($row["object"]);
        }

        return $person;
    }

    public static function listAll() {
        $sparql = "
SELECT DISTINCT * WHERE {
  ?id rdf:type mo:Person
}
ORDER BY ?id";

        $result = sparql_query(SPARQL_NS . $sparql);

        $list = array();

        while ($row = sparql_fetch_array($result)) {
            array_push($list, $row["id"]);
        }

        return $list;
    }

    public static function getAll() {
        $ids = PersonRepository::listAll();
        $list = array();
        foreach ($ids as $id) {
            array_push($list, PersonRepository::retrieve($id));
        }

        return $list;
    }

}