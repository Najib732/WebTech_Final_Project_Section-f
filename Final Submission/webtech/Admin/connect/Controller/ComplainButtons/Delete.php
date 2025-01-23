<?php
require_once("../../Model/complainlistModel.php");


if(isset($_REQUEST['id'])){
    
    

    $id=$_REQUEST['id'];
    var_dump($id);
    $action=$_REQUEST['action'];
    
    header('location: ../../view/complainBox.php');
    
    $result=postdelete($id);
   if($result){
    echo "najib";
   }
   
   else{
    return false;
   }
    
    




}

?>