<?php

    require 'connection.php';
     //new connection();
    

    $fullname = $_POST['fullname'];
    $matric = $_POST['matric'];
    $dept = $_POST['dept'];
    $assfile = $_FILES['assfile'];
    $assDirFile = 'images/'.basename($assfile['name']);

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($conn){
            move_uploaded_file($assfile['tmp_name'],$assDirFile);
            $sql = 'INSERT INTO cmp311_assignment(FULLNAME, MATRIC, DEPARTMENT,ASSIGNMENTFILE) VALUES(?,?,?,?)';
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss',$fullname,$matric,$dept,$assDirFile);
            //$stmt->execute();
            mysqli_stmt_execute($stmt);
            echo "<H3>SUBMISSION SUCCESSFUL!</H3>";
        }
        if(!$conn){
            die('Error trying to connect '.mysqli_error());
        }
       
    }
    else{
        echo "invalid request!<br>";
    }
   

?>