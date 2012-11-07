<?php
require_once( "../libraries/sparqllib.php" );
require_once "../conf.php";

require_once "../repositories/CourseRepository.class.php";
require_once "../repositories/ClasssRepository.class.php";


$courses = CourseRepository::listAll();

include "header.php";

?>
<form name="input" action="index.php" method="post">
  <select id="ue" name="ue">
  <?php
  foreach($courses as $course)
    {
      $id = preg_replace("@^.*/@","", $course);
      echo "<option value='$course'";
      if(isset($_REQUEST["ue"]) && $_REQUEST["ue"] == $course)
        echo " selected='selected' ";
      echo ">$id</option>";
    }
  ?>
  </select>  
<input type="submit" value="Submit">
</form> 

<?php
if(isset($_REQUEST["ue"]))
  include("ue.php");
?>

  <?php
include "footer.php";
?>