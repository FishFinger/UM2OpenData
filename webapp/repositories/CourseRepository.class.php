<?php

require_once dirname(__FILE__) . '/../conf.php';
require_once dirname(__FILE__) . '/sparqlConnection.php';
require_once dirname(__FILE__) . '/../libraries/sparqllib.php';
require_once dirname(__FILE__) . '/../classes/Course.class.php';

class CourseRepository {

    private static $fields = array(
        "http://www.w3.org/2000/01/rdf-schema#comment" => "setComment",
        "http://www.w3.org/2000/01/rdf-schema#label" => "setLabel",
        "http://ontology.um2opendata.thibautmarmin.fr#managedby" => "setManagedby");

    public static function retrieve($id) {
        $sparql = "
SELECT DISTINCT * WHERE {
  <$id> ?predicate ?object
}
ORDER BY ?predicate";

        $result = sparql_query(SPARQL_NS . $sparql);

        $course = new Course($id);

        while ($row = sparql_fetch_array($result)) {
//            var_dump($row);
            if (isset(CourseRepository::$fields[$row["predicate"]]) && method_exists($course, CourseRepository::$fields[$row["predicate"]]))
                if (CourseRepository::$fields[$row["predicate"]] == "setManagedby") {
                    $course->{CourseRepository::$fields[$row["predicate"]]}(PersonRepository::retrieve($row["object"]));
                } else
                    $course->{CourseRepository::$fields[$row["predicate"]]}($row["object"]);
        }

        return $course;
    }

    public static function listAll() {
        $sparql = "
SELECT DISTINCT * WHERE {
  ?id rdf:type mo:Course
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
        $ids = CourseRepository::listAll();
        $list = array();
        foreach ($ids as $id) {
            array_push($list, CourseRepository::retrieve($id));
        }

        return $list;
    }

}