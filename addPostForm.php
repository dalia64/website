<?php
    session_start();
    
    if (!isset($_SESSION['email'])) {
        // User is not logged in, redirect to the login page
        header('Location: https://daliagu.mtacloud.co.il/index.html');
        exit();
    }
    
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $avatar = $_SESSION['avatar'];
    $birth = $_SESSION['birth'];
    $city = $_SESSION['city'];
    $street = $_SESSION['street'];
    $s_num = $_SESSION['s_num'];
    $gender = $_SESSION['gender'];

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/addPost.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>הוספת פוסט</title>
</head>

<body class="color">

    <header>
        <div> <img src="/img/logo.png" width="100px" height="100px"></div>
        <p><input class="but" type="button" value="הפרופיל שלי" onclick="location.href='/php/profile.php'"></p>
    </header></br>

    <main>
        <h1> הוספת פוסט חדש </h1> </br>
        
        <section class="details bcg col-sm-6">
            <h3> הפרטים שלי </h3>

            <div class="form-container">
            
                <form id="detailsForm"> 
                    <p> <label>שם:</label> <input type="text" value="<?php echo $firstname , " " ,  $lastname; ?>" disabled> </p>
                    <p> <label>תאריך לידה:</label><input type="text"value="<?php echo $birth; ?>" disabled>  </p>    
                    <p> <label>מגורים:</label> <input type="text" value="<?php echo $city , ", " ,  $street, " ",  $s_num; ?>"  disabled> </p>    
                    <p> <label>מגדר:</label> <input type="text" value="<?php echo $gender; ?>" disabled> </p>
                </form>
                
                <img src="<?php echo $avatar; ?>" alt="Profile Picture">
               
            </div>

        </section> <br>
        
        <form id="postForm" action="/php/addPost.php" method="post">
            
            <div class="container" >
                <section class="txt bcg"> 
                    <h3> תוכן הפוסט </h3>
                    <p> <textarea class="form-control" aria-label="With textarea" name="content" required></textarea> </p>
                </section>
    
                <section class="dates bcg"> 
                    <h3> תאריכים לציוות </h3>
                    <p> <label>תאריך התחלה: </label><input class="form-control-sm" type="date" name="startdate" required> </p>
                    <p> <label>תאריך סיום:  </label><input class="form-control-sm" type="date" name="enddate" required> </p>
                </section>
                </br></br>
            
            </div>
        
            <p id="btn-id"> <input class="but" type="submit" value="פרסום הפוסט" name="submit2" ></p>
        
        </form>
        
        <br>
        
    </main>
    
    <footer>
        <hr>
        <p> מעוניינים ליצור קשר? דברו איתנו: <a href="mailto:Support@StepForThirdAge.com"> Support@StepForThirdAge.com </a> </p>
        <br />
    </footer>


</body>
</html>

