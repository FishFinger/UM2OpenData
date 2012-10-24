<?php

require_once( "../libraries/sparqllib.php" );
require_once "../conf.php";

$db = sparql_connect( "http://um2opendata.thibautmarmin.fr/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }


$sparql = "
SELECT DISTINCT ?property ?value ?tbeginning ?tend
WHERE {
  <http://um2opendata.thibautmarmin.fr/resource/Classs/test-test-012345> ?property ?value .
  <http://um2opendata.thibautmarmin.fr/resource/Classs/test-test-012345> ev:time ?time .
  ?time ev:hasBeginning ?beginning .
  ?time ev:hasEnd ?end .
  ?beginning time:inXSDDateTime ?tbeginning .
  ?end time:inXSDDateTime ?tend .
}
";
$result = sparql_query( SPARQL_NS.$sparql );
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