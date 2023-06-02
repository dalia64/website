<?php
    session_start();
    
    $user = $_SESSION['user'];
    $email = $_SESSION['email'];
        
    if (!isset($_SESSION['email'])) {
        // User is not logged in, redirect to the login page
        header('Location: https://daliagu.mtacloud.co.il/index.html');
        exit();
    }
    
    $servername = "localhost";
    $username = "daliagu_form";
    $password = "12345678";
    $dbname = "daliagu_project";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset('utf8');
    
    
    if (isset($_POST['submit3'])) {
        
        $partner = $_POST['partner'];
        $agreement = '../agreements/'.$email.'.'.$_FILES["agreement"]['name'];
        move_uploaded_file($_FILES["agreement"]["tmp_name"], $agreement);
        
        $sqlStatus = "UPDATE register SET status = 'מצוות' WHERE email = '".$email."'";
        if ($conn->query($sqlStatus) === FALSE) {
            echo "Error: " . $conn->error;
            exit();
        }

        $sql = "INSERT INTO agreements (user, partner, agreement) VALUES ('".$user."','".$partner."','".$agreement."')";
    
        if ($conn->query($sql) === FALSE) {
            echo "Error: " . $conn->error;
            exit();
        }
    
    }
?>

<script>
        window.alert('הסכם חדש עודכן במערכת בהצלחה');
        window.location.href="/php/profile.php";

</script>