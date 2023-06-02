<?php
    session_start();
    
    if (!isset($_SESSION['email'])) {
        
        // User is not logged in, redirect to the login page
        header('Location: /index.html');
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

    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $avatar = $_SESSION['avatar'];
    $email = $_SESSION['email'];
    
    $sql = "SELECT * FROM register where email = '".$email."'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    

?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/cssForProfile.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>הפרופיל שלי</title>
</head>


<body class="color">
    
    <header>
        <div> <img src="/img/logo.png" width="100px" height="100px"></div>
    </header><br>

    <main>
        <h1> הפרופיל שלי </h1><br>
        
        <form>
            <img src="<?php echo $_SESSION['avatar']; ?>" alt="Profile Picture">  <br><br>
            <h3 id="userName"> <?php echo $firstname , " " ,  $lastname; ?> </h3><br>
        </form>

        <div class="stat">
            <h4> סטטוס ציוות:  </h4> 
            <a> <input class="form-control-lg" type="text" value="<?php echo $row['status']; ?>" disabled></a>
        </div>

        <br><br>
        
        <section class="bcg">
            <a class="btn-id" href="/php/postWallForm.php"> <input class="but" type="button" value="קיר פוסטים" onclick="location.href='/php/postWallForm.php'"></a>
            <a class="btn-id" href="/php/addPostForm.php"> <input class="but" type="button" value="הוספת פוסט חדש" onclick="location.href='/php/addPostForm.php'"></a>
            <a class="btn-id" href="/agreement.html"> <input class="but" type="button" value="חתימה על הסכם" onclick="location.href='/agreement.html'"></a>
        </section>

    </main> 

    
    <a class="btn-id" href="/php/logout.php"> <input class="but" type="button" value="התנתקות"></a> <br>

</a>
    <footer>
        <hr>
        <p> מעוניינים ליצור קשר? דברו איתנו: <a href="mailto:Support@StepForThirdAge.com"> Support@StepForThirdAge.com </a></p>
        <br />
    </footer>

</body>

</html>
