<html>
    <head>
        <?php require '../dbconnect.php'; 
              require '../logic/functions.php';
        ?>

    <link rel="stylesheet" href="../styling/basic-style.css">   

    </head>
    <body>
        <form action="register.php" method="post">
            <label>first name</label>
            <input type="text" id="Fname" name="name" required>
            </br>
            <label>prefix</label>
            <input type="text" id="prefix" name="prefix">
            </br>
            <label>last name</label>
            <input type="text" id="Lname" name="Lname" required>
            </br>
            <label>email</label>
            <input type="text" id="email" name="mail" required>
            </br>
            <label>password</label>
            <input type="tetxt" id="password" name="pass" required>
            </br>
            <label>street</label>
            <input type="text" id="street" name="street" required>
            </br>#
            <label>home number</label>
            <input type="text" id="Number" name="HNM" required>
            </br>
            <label>postcode</label>
            <input type="text" id="Pcode" name="Pcode" required>
            </br>
            <label>city</label>
            <input type="text" id="city" name="city" required>
            </br>
            <input type="submit" class="apply" name="apply"> 
        </form>
    </body>

    <?php
    if(isset($_POST["apply"])) {    
        $Fname = $_POST["name"];
        $prefix = $_POST["prefix"];
        $Lname = $_POST["Lname"];
        $mail = $_POST["mail"];
        $pass = $_POST["pass"];
        $street = $_POST["street"];
        $HNM = $_POST["HNM"];
        $Pcode = $_POST["Pcode"];
        $city = $_POST["city"];

        $check = "SELECT email FROM user WHERE email = '.$mail.'";
        $result = mysqli_query($conn, $check);
        

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
          } elseif (PostcodeCheck($Pcode) === false) {
            echo "Invalid postalcode format";
        } elseif($result == true) {
            echo"email is already in use";
        } else {
            createuser($conn, $Fname, $prefix, $Lname, $mail, $pass, $street, $HNM, $Pcode, $city);
        } 
    }
    
    
    ?>
</html>