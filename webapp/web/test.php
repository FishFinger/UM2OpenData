<?php

$timestart = microtime(true);
require_once dirname(__FILE__) . '/../repositories/ClasssRepository.class.php';

function print_data(array $array, $time) {

    $page_load_time = number_format($time, 3);


    print "<h1>Resource <i>" . $_GET['resource'] . "</i> methode <i>" . $_GET['method'] . "</i></h1>";
    print "<h3>" . count($array) . " results in " . $page_load_time . " sec</h3>";
    print "<hr>";
    foreach ($array as $a) {
        print nl2br(str_replace(' ', '&nbsp;', var_export($a, TRUE)));
        print "<hr>";
    }
}

if (isset($_GET['resource'])) {
    if (isset($_GET['method'])) {
        try {
            switch ($_GET['resource']) {
                case "Building" :
                    $array = BuildingRepository::{$_GET['method']}();
                    break;
                case "Classs" :
                    $array = ClasssRepository::{$_GET['method']}();
                    break;
                case "Course" :
                    $array = CourseRepository::{$_GET['method']}();
                    break;
                case "Person" :
                    $array = PersonRepository::{$_GET['method']}();
                    break;
                case "Room" :
                    $array = RoomRepository::{$_GET['method']}();
                    break;
                default :
                    echo 'Unknown resource...';
                    break;
            }
        } catch (Exception $e) {
            echo "Error while executing method " . $_GET['method'] . " : " . $e->getMessage();
        }
    } else
        echo 'method parameter must be specified !';
} else {
    echo 'resource parameter must be specified !';
}

$timeend = microtime(true);
$time = $timeend - $timestart;

print_data($array, $time);