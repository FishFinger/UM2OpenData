<?php

require_once dirname(__FILE__) . '/../conf.php';
require_once dirname(__FILE__) . '/sparqlConnection.php';
require_once dirname(__FILE__) . '/../libraries/sparqllib.php';
require_once dirname(__FILE__) . '/../classes/Building.class.php';

class BuildingRepository {

    private static $fields = array(
        "http://ontology.um2opendata.thibautmarmin.fr#locatedin" => "setLocatedin",
        "http://www.w3.org/2000/01/rdf-schema#label" => "setLabel",
        "http://www.w3.org/2000/01/rdf-schema#comment" => "setComment");

    public static function retrieve($id) {
        $sparql = "
SELECT DISTINCT * WHERE {
  <$id> ?predicate ?object
}
ORDER BY ?predicate";

        $result = sparql_query(SPARQL_NS . $sparql);

        $building = new Building($id);

        while ($row = sparql_fetch_array($result)) {
//            var_dump($row);
            if (isset(BuildingRepository::$fields[$row["predicate"]]) && method_exists($building, BuildingRepository::$fields[$row["predicate"]]))
                $building->{BuildingRepository::$fields[$row["predicate"]]}($row["object"]);
        }

        return $building;
    }

    public static function listAll() {
        $sparql = "
SELECT DISTINCT * WHERE {
  ?id rdf:type mo:Building
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
        $ids = BuildingRepository::listAll();
        $list = array();
        foreach ($ids as $id) {
            array_push($list, BuildingRepository::retrieve($id));
        }

        return $list;
    }

}