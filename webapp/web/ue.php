<?php
require_once( "../libraries/sparqllib.php" );
require_once "../conf.php";

require_once "../repositories/CourseRepository.class.php";


$ue = CourseRepository::retrieve($_REQUEST["ue"]);
$id = preg_replace("@^.*/@","", $ue->getId());
?>

<h1><?php echo $id." - ".$ue->getLabel(); ?></h1>

<dl>
  <dt>Responsable</dt>
  <dd><?php 
  if($ue->getManagedby())
    {
      echo $ue->getManagedby()->toHTMLString(); 
      
    }
  ?></dd>
  
  <dt>Commentaire</dt>
  <dd><?= $ue->getComment(); ?></dd>
 

 <dt>Crénaux</dt>
 <dd>
<?php
$classes = ClasssRepository::getAll($ue->getId());
foreach ($classes as $class)
  {
    echo $class->getTime()."<br />";
  }
?>
 </dd>
</dl>  


