<?php

require_once dirname(__FILE__) . '/../conf.php';
require_once dirname(__FILE__) . '/sparqlConnection.php';
require_once dirname(__FILE__) . '/../libraries/sparqllib.php';
require_once dirname(__FILE__) . '/../classes/Classs.class.php';
require_once dirname(__FILE__) . '/../repositories/CourseRepository.class.php';
require_once dirname(__FILE__) . '/../repositories/RoomRepository.class.php';

class ClasssRepository {

    private static $fields = array(
        "http://purl.org/NET/c4dm/event.owl#time" => "setTime",
        "http://ontology.um2opendata.thibautmarmin.fr#takesplacein" => "addTakesplacein",
        "http://ontology.um2opendata.thibautmarmin.fr#relatedto" => "setRelatedto",
        "http://www.w3.org/2000/01/rdf-schema#label" => "setLabel",
        "http://www.w3.org/2000/01/rdf-schema#seeAlso" => "setSeeAlso",
        "http://www.w3.org/2000/01/rdf-schema#comment" => "setComment");

    public static function retrieve($id) {
        $sparql = "
SELECT DISTINCT ?predicate ?object ?tbeginning ?tend
WHERE {
  <$id> ?predicate ?object .
  <$id> ev:time ?time .
  ?time ev:hasBeginning ?beginning .
  ?time ev:hasEnd ?end .
  ?beginning time:inXSDDateTime ?tbeginning .
  ?end time:inXSDDateTime ?tend .
}";

        $result = sparql_query(SPARQL_NS . $sparql);

        $classs = new Classs($id);

        while ($row = sparql_fetch_array($result)) {
//            var_dump($row);
            if (isset(ClasssRepository::$fields[$row["predicate"]]) && method_exists($classs, ClasssRepository::$fields[$row["predicate"]]))
                if (ClasssRepository::$fields[$row["predicate"]] == "setTime") {
                    $classs->setTime(new Interval(new Instant($row["tbeginning"]), new Instant($row["tend"])));
                } elseif (ClasssRepository::$fields[$row["predicate"]] == "addTakesplacein") {
                    $classs->addTakesplacein(RoomRepository::retrieve($row['object']));
                } elseif (ClasssRepository::$fields[$row["predicate"]] == "setRelatedto") {
                    $classs->setRelatedto(CourseRepository::retrieve($row['object']));
                } else
                    $classs->{ClasssRepository::$fields[$row["predicate"]]}($row["object"]);
        }

        return $classs;
    }

    public static function listAll() {
        $sparql = "
SELECT DISTINCT * WHERE {
  ?id rdf:type mo:Classs
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
        $ids = ClasssRepository::listAll();
        $list = array();
        foreach ($ids as $id) {
            array_push($list, ClasssRepository::retrieve($id));
        }

        return $list;
    }

}