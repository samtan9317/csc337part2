<?php
// This controller acts as the go between the view and the model. 
//
// Author Xuesen Tan
//
include 'model.php';  // for $theDBA, an instance of DataBaseAdaptor

if(isset($_REQUEST['id'])){
	$arr = $theDBA->getMovies($_REQUEST['id']);
}
else if(isset($_REQUEST['actor'])){
	$arr = $theDBA->getActors ($_REQUEST['actor']);
}
echo  json_encode($arr);
//print_r($arr);
?>
