<?php
require_once( "../libraries/sparqllib.php" );
require_once "../conf.php";

require_once "../repositories/CourseRepository.class.php";


$courses = CourseRepository::listAll();


?>
<form name="input" action="ue.php" method="post">
  <select id="ue" name="ue">
  <?php
  foreach($courses as $course)
    {
      $id = preg_replace("@^.*/@","", $course);
      echo "<option value='$course'>$id</option>";
    }
  ?>
  </select>  
<input type="submit" value="Submit">
</form> 



<?php

/*$db = sparql_connect( "http://um2opendata.thibautmarmin.fr/sparql" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }


$sparql = "
SELECT DISTINCT * WHERE {
  <http://um2opendata.thibautmarmin.fr/resource/Building/1> ?predicate ?object
}
ORDER BY ?predicate
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
print "</table>";*/
 
 ?>