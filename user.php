<?php

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    

        
    $servername = "localhost";
    $username = "daliagu_form";
    $password = "12345678";
    $dbname = "daliagu_project";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset('utf8');
    
    // בדיקה אם המשתמש לחץ על כפתור ההתחברות
    if (isset($_POST['submit1'])) {
        
      // נתוני הטופס התקבלו על ידי לחיצה על כפתור ההתחבר
      $email = $_POST['email'];
      $password = $_POST['password'];
      
      // בדיקה אם האימייל והסיסמה תקינים
      $sql = "SELECT * FROM register WHERE email='$email' AND password='$password'";
      $result = mysqli_query($conn, $sql);
    
      // אם נמצא משתמש עם אימייל וסיסמה תקינים
      if (mysqli_num_rows($result) > 0) {
        
            // התחברות מוצלחת - נשמור את פרטי המשתמש בסשן
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
        
            $row = mysqli_fetch_assoc($result);
            $_SESSION['firstname'] = $row['firstname']; 
            $_SESSION['lastname'] = $row['lastname']; 
            $_SESSION['avatar'] = $row['avatar'];
            $_SESSION['birth'] = $row['birth'];
            $_SESSION['city'] = $row['city']; 
            $_SESSION['street'] = $row['street'];
            $_SESSION['s_num'] = $row['s_num'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['cert'] = $row['cert'];
            $_SESSION['user'] = $row['counter1'];
    
    
        // העברת המשתמש לדף הפרופיל
        header('Location: https://daliagu.mtacloud.co.il/php/profile.php');
        exit();
      } 
        
      else {
        //  התחברות נכשלה - נדפיס הודעת 
        echo "Invalid email or password. Please try again.";
      }
    }
    
    //mysqli_close($conn);


?>
    