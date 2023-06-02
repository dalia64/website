<?php

   error_reporting (E_ALL ^ E_NOTICE); 

    session_start();
    
    if (!isset($_SESSION['email'])) {
        // User is not logged in, redirect to the login page
        header('Location: https://daliagu.mtacloud.co.il/index.html');
        exit();
    }
    
   $servername = "localhost";
   $username = "daliagu_form";
   $password = "12345678";
   $dbname = "daliagu_project";

   $conn = new mysqli($servername, $username, $password, $dbname);

   
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

    $conn->set_charset('utf8');

    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $content = $_POST['content'];
    $user = $_SESSION['user'];
   
   $sql = "INSERT INTO posts (user, startdate, enddate, content) VALUES 
   ('".$user."', '".$startdate."', '".$enddate."', '".$content."')";
   
    
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . 
        $conn->error;
        exit();
    } 
    
    //header('Location: /php/postWallForm.php');
    //mysqli_close($conn);

?>

 <script>
        
    window.alert('פוסט חדש עודכן במערכת בהצלחה');
    window.location.href="/php/postWallForm.php";
        
</script>