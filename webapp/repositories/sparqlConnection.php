<?php
require_once dirname(__FILE__).'/../conf.php';
require_once dirname(__FILE__).'/../libraries/sparqllib.php';

$db = sparql_connect( SPARQL_ENDPOINT );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
