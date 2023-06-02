<?php
   
   $servername = "localhost";
   $username = "daliagu_form";
   $password = "12345678";
   $dbname = "daliagu_project";

   $conn = mysqli_connect($servername, $username, $password, $dbname);
   
   if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
   }

    $conn->set_charset('utf8');

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $birth = $_POST['birth'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $s_num = $_POST['s_num'];
    $zip = $_POST['zip'];
    $password = $_POST['password'];
    $avatar = '../uploads/'.$email.'.'.$_FILES['avatar']['name'];
    $school = $_POST['school'];
    $stud_year = $_POST['stud_year'];
    $payment = $_POST['payment'];
    
    if ($_FILES['cert']['name'] != ''){
        $cert = '../certificates/'.$email.'.'.$_FILES['cert']['name'];
        move_uploaded_file($_FILES["cert"]["tmp_name"], $cert);
    }
    else{
        $cert = '';
    }
    
    // Get preferences data
    $shomerShabbat = $_POST["shomerShabbat"];
    $shomerKashrut = $_POST["shomerKashrut"];
    $smoker = $_POST["smoker"];
    $hasPets = $_POST["hasPets"];
    
    // Get language data
    $hebrew = $_POST["hebrew"];
    $english = $_POST["english"];
    $russian = $_POST["russian"];
    $arabic = $_POST["arabic"];
    $otherLang = $_POST["otherLang"];
    $otherLangText = $_POST["otherLangText"];
    
    // Get marital status data
    $maritalStatus = $_POST["maritalStatus"];
    
    // Get living situation data
    $livingSituation = $_POST["livingSituation"];
    
    // Set user status 
    $status = "מחפש ציוות";
    
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $avatar);
    

   $sql = "INSERT INTO register (firstname, lastname, email, phone, birth, gender, city, street, s_num, zip, password, avatar, school, stud_year, payment, cert, shomerShabbat, shomerKashrut, smoker, hasPets, hebrew, english, russian, arabic, otherLang, otherLangText, maritalStatus, livingSituation, status) VALUES 
   ('".$firstname."', '".$lastname."', '".$email."', '".$phone."', '".$birth."', '".$gender."', '".$city."', '".$street."', '".$s_num."', '".$zip."', '".$password."', '".$avatar."', '".$school."', '".$stud_year."', '".$payment."', '".$cert."', '".$shomerShabbat."', '".$shomerKashrut."', '".$smoker."', '".$hasPets."', '".$hebrew."', '".$english."', '".$russian."', '".$arabic."', '".$otherLang."', '".$otherLangText."', '".$maritalStatus."', '".$livingSituation."','".$status."')";


    if ($conn->query($sql)==FALSE){
        echo "Can not add new user.  Error is: ".
		    $conn->error;
        exit();
    }
    
    // mysqli_close($conn);
    ?>
    
    <script>
        window.location.href='https://daliagu.mtacloud.co.il/index.html';
    </script>
