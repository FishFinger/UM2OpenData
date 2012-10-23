<?php

require_once( "../res/sparqllib.php" );

$db = sparql_connect( "http://um2opendata.thibautmarmin.fr/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "foaf","http://xmlns.com/foaf/0.1/" );
sparql_ns( "db","http://um2opendata.thibautmarmin.fr/resource/" );
sparql_ns( "ev","http://purl.org/NET/c4dm/event.owl#" );
sparql_ns( "mo","http://localhost/UM2opendata/ontologies/my-ontology.owl#" );
sparql_ns( "nimp","http://nimp.com/" );
sparql_ns( "meta","http://www4.wiwiss.fu-berlin.de/bizer/d2r-server/metadata#" );
sparql_ns( "rdfs","http://www.w3.org/2000/01/rdf-schema#" );
sparql_ns( "time","http://um2opendata.thibautmarmin.fr/resource/neuneu.com#" );
sparql_ns( "d2r","http://sites.wiwiss.fu-berlin.de/suhl/bizer/d2r-server/config.rdf#" );
sparql_ns( "owl","http://www.w3.org/2002/07/owl#" );
sparql_ns( "map","http://um2opendata.thibautmarmin.fr/resource/#" );
sparql_ns( "xsd","http://www.w3.org/2001/XMLSchema#" );
sparql_ns( "rdf","http://www.w3.org/1999/02/22-rdf-syntax-ns#" );
sparql_ns( "vocab","http://um2opendata.thibautmarmin.fr/resource/vocab/" );


$sparql = "SELECT * WHERE { ?s ?p ?o } ";
$result = sparql_query( $sparql );
//var_dump($result);

if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

$fields = sparql_field_array( $result );

print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
print "<tr>";
foreach( $fields as $field )
{
	print "<th>$field</th>";
}
print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{
	print "<tr>";
	foreach( $fields as $field )
	{
		print "<td>$row[$field]</td>";
	}
	print "</tr>";
}
print "</table>";
 
 ?>