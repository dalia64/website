<?php
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
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $conn->set_charset('utf8');
    
    $sql = "SELECT * FROM posts AS p JOIN register AS r on p.user = r.counter1";
    $result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="/css/postWall.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!--Google Maps API -->
    <script async 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9-vqBl32z1qN5xvxThciO8Nu4gAz28rk&callback=initMap"></script>
    <!--search bar for map API -->
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB9-vqBl32z1qN5xvxThciO8Nu4gAz28rk&callback=initAutocomplete&libraries=places&v=weekly"
    defer></script>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script  src="/js/maps.js"> </script>
    
    <title>קיר פוסטים</title>
</head>

<body class="color">

    <header>
        <div> <img src="/img/logo.png" width="100px" height="100px"> </div>
        <p><input class="but" type="button" value="הפרופיל שלי" onclick="location.href='/php/profile.php'"></p>
    </header></br>

    <main>
        <h1> קיר הפוסטים </h1> </br>

        <nav> 
            <a href="/php/addPostForm.php"> הוספת פוסט חדש </a> ||
            <a href="/postBounce.html"> הקפצת פוסט </a>

            <div class="container-fluid navbar bg-body-tertiary">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button id="search-btn" class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>  </br>
        
        <p id="info"> השתמשו בתיבת החיפוש על מנת למצוא את מיקום מפרסם הפוסט במפה </p>

        <input
        id="pac-input"
        class="controls"
        type="text"
        placeholder="Search Box"
        />

        <div id="map"></div> <br>

        <section>

<?php

    if (mysqli_num_rows($result) > 0) {
        
        while ($row = mysqli_fetch_assoc($result)) {

            $language = '';
            if($row['hebrew']=='1')
                $language .= 'עברית ';
            if($row['english']=='1')
                $language .= 'אנגלית ';
            if($row['russian']=='1')
                $language .= 'רוסית ';
            if($row['arabic']=='1')
                $language .= 'ערבית ';
            if($row['otherLang']=='1')
                $language .= $row['otherLangText'];
                
            
            $preferences = '';
            if($row['shomerShabbat']==1)
                $preferences .= 'שומר שבת ';
            if($row['shomerKashrut']==1)
                $preferences .= 'שומר כשרות ';
            if($row['hasPets']==1)
                $preferences .= 'מגורים עם בעח ';
            if($row['smoker']==1)
                $preferences .= 'מעשן ';
            
            $marital = $row['maritalStatus'];
            $living = $row['livingSituation'];

?>    
                <article class="bcg">
    
                    <div class="left-details">
                        <br> <p> <label> תאריכים לציוות: </label> <input class="form-control-sm" type="text" value=" <?php echo $row['startdate'] , " - " ,$row['enddate']; ?>" disabled> </p>
                             <p> <label> שפות: </label> <input class="form-control-sm" type="text" value=" <?php echo $language; ?>" disabled>&nbsp;&nbsp;
                                 <label> העדפות: </label> <input class="form-control-sm" type="text" value=" <?php echo $preferences; ?>" disabled> </p>
                             <p> <label> מצב משפחתי: </label> <input class="form-control-sm" type="text" value=" <?php echo $marital; ?>" disabled>&nbsp;&nbsp;
                                 <label>  סוג מגורים: </label> <input class="form-control-sm" type="text" value=" <?php echo $living; ?>" disabled>
                             
                        <br>  </p>
                        
                        <p> <textarea class="form-control-lg" aria-label="With textarea" disabled><?php echo $row['content']; ?></textarea> </p>
                        
                        <p id="mail-link"> <a href="mailto: <?php echo $row['email']; ?>"> ליצירת קשר עם מפרסם הפוסט לחץ כאן </a> </p>
                        
                        
                    </div>
    
                    <div class="right-details">
                        <form> 
                            <p>  <img src="<?php echo $row['avatar']; ?>"></p>
    
                            <p> <label>שם המפרסם: </label> <input class="form-control-sm" type="text" value="<?php echo $row['firstname'] , " " ,  $row['lastname']; ?>" disabled> </p>
                            <p> <label>תאריך לידה: </label> <input class="form-control-sm" type="text" value="<?php echo $row['birth']; ?>" disabled>  </p>    
                            <p> <label>כתובת: </label> <input class="form-control-sm" type="text" value="<?php echo $row['city'], ", ",  $row['street'], " ", $row['s_num'] ; ?>" disabled> </p>    
                            <p> <label>מגדר: </label> <input class="form-control-sm" type="text" value="<?php echo $row['gender']; ?>" disabled> </p>
                        </form>
                    </div>
    
                </article> </br></br>
<?php
        }
    }

?>

        </section>
    </main>
    
    <footer>
        <hr>
        <p> מעוניינים ליצור קשר? דברו איתנו: <a href="mailto:Support@StepForThirdAge.com"> Support@StepForThirdAge.com </a></p>
        <br />
    </footer>

    <script>

        $(document).ready(function(){

            $("#search-btn").click(function(){
                alert('לא ניתן לבצע חיפוש כרגע, עמכם.ן הסליחה');
            })
        })
        
        (g=>{var h,a,k,p="The Google Maps JavaScript API",c="google",l="importLibrary",q="__ib__",m=document,b=window;b=b[c]||(b[c]={});var d=b.maps||(b.maps={}),r=new Set,e=new URLSearchParams,u=()=>h||(h=new Promise(async(f,n)=>{await (a=m.createElement("script"));e.set("libraries",[...r]+"");for(k in g)e.set(k.replace(/[A-Z]/g,t=>"_"+t[0].toLowerCase()),g[k]);e.set("callback",c+".maps."+q);a.src=`https://maps.${c}apis.com/maps/api/js?`+e;d[q]=f;a.onerror=()=>h=n(Error(p+" could not load."));a.nonce=m.querySelector("script[nonce]")?.nonce||"";m.head.append(a)}));d[l]?console.warn(p+" only loads once. Ignoring:",g):d[l]=(f,...n)=>r.add(f)&&u().then(()=>d[l](f,...n))})
            ({key: "AIzaSyB9-vqBl32z1qN5xvxThciO8Nu4gAz28rk", v: "weekly"});
    </script>

</body>
</html>