<?php

require_once dirname(__FILE__) . '/../repositories/ClasssRepository.class.php';

if (isset($_GET['resource'])) {
    if (isset($_GET['method'])) {
        try {
            switch ($_GET['resource']) {
                case "Building" :
                    var_dump(BuildingRepository::{$_GET['method']}());
                    break;
                case "Classs" :
                    var_dump(ClasssRepository::{$_GET['method']}());
                    break;
                case "Course" :
                    var_dump(CourseRepository::{$_GET['method']}());
                    break;
                case "Person" :
                    var_dump(PersonRepository::{$_GET['method']}());
                    break;
                case "Room" :
                    var_dump(RoomRepository::{$_GET['method']}());
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