<?php

require_once dirname(__FILE__) . '/../conf.php';
require_once dirname(__FILE__) . '/sparqlConnection.php';
require_once dirname(__FILE__) . '/../libraries/sparqllib.php';
require_once dirname(__FILE__) . '/../classes/Room.class.php';
require_once dirname(__FILE__) . '/../repositories/BuildingRepository.class.php';

class RoomRepository {

    private static $fields = array(
        "http://ontology.um2opendata.thibautmarmin.fr#locatedin" => "setLocatedin",
        "http://www.w3.org/2000/01/rdf-schema#label" => "setLabel");

    public static function retrieve($id) {
        $sparql = "
SELECT DISTINCT * WHERE {
  <$id> ?predicate ?object
}
ORDER BY ?predicate";

        $result = sparql_query(SPARQL_NS . $sparql);

        $room = new Room($id);

        while ($row = sparql_fetch_array($result)) {
//            var_dump($row);
            if (isset(RoomRepository::$fields[$row["predicate"]]) && method_exists($room, RoomRepository::$fields[$row["predicate"]])) {
                if (RoomRepository::$fields[$row["predicate"]] == "setLocatedin") {
                    $room->{RoomRepository::$fields[$row["predicate"]]}(BuildingRepository::retrieve($row["object"]));
                } else
                    $room->{RoomRepository::$fields[$row["predicate"]]}($row["object"]);
            }
        }

        return $room;
    }

    public static function listAll() {
        $sparql = "
SELECT DISTINCT * WHERE {
  ?id rdf:type mo:Room
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
        $ids = RoomRepository::listAll();
        $list = array();
        foreach ($ids as $id) {
            array_push($list, RoomRepository::retrieve($id));
        }

        return $list;
    }

}