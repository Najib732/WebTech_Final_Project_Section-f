<?php
include("../../Model/complainlistModel.php");


if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];

   
    
    $result=reportde($id);
    if($result){
     return true;
    }
else{
    echo "ERROR : Could not catch id";
}
}

?>