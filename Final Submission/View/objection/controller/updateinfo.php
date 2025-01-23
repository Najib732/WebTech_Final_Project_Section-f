<?php
session_start();
require_once('../model/sql.php');
$id = $_SESSION['userid'];

 
if (!empty($_REQUEST['newname'])) {
    $newname = $_REQUEST['newname'];
    $result = updatename($newname, $id);

    if ($result) {
        header('location: ../view/userprofile.php');
    } else {
        header('location: ../view/username.html');
    }
} else if (!empty($_FILES['image']['name'])) {
    $targetDir = "../upload/";
    $targetFile = $targetDir . basename($_FILES['image']['name']);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
        if (updateProfile($targetFile, $id)) {
            echo "Profile updated successfully.";
            header('Location: ../view/userprofile.php');
        } else {
            echo "Failed to update profile in database.";
        }
    } else {
        echo "Error uploading file. Please try again.";
    }

    exit; 
} 

else if (empty($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "new") {
       
        echo "ADD action triggered";
    } elseif ($_REQUEST['action'] == "update") {
       
        echo "Update action triggered";
    }
}




else if ($_REQUEST['action'] == "update") {
    $result = userdata($id);
    $livein = !empty($_REQUEST['livein']) ? $_REQUEST['livein'] : $result['livein'];
    $university = !empty($_REQUEST['university']) ? $_REQUEST['university'] : $result['university'];
    $college = !empty($_REQUEST['college']) ? $_REQUEST['college'] : $result['college'];
    $hometown = !empty($_REQUEST['hometown']) ? $_REQUEST['hometown'] : $result['hometown'];

    $updateSuccess = updateUserData($id, $livein, $university, $college, $hometown);

    if ($updateSuccess) {
        header("Location: ../view/userprofile.php?id=$id");
    } else {
        echo "Error updating data.";
    }
    
}



else if ($_REQUEST['action'] == "password"){

    
    $old_password = $_REQUEST['old_password'];
    $new_password = $_REQUEST['new_password'];

  
    $result = updatepassword($old_password, $new_password);

    if ($result) {
        
        header("Location: ../view/userprofile.php");
        exit;
    } else {
        
        header("Location: updateinfo.php");
        exit;
    }
}

else if ($_REQUEST['action'] == "delete"){
    var_dump($_REQUEST);
    
  $result=deleteAccount();
  if($result){
    header('location:../view/signup.html');
    exit;
  }
  else {
        
    header("Location: updateinfo.php");
    exit;
}
}
