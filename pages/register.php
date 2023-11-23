<html>
    <head>
        <?php require '../dbconnect.php'; 
              require '../logic/functions.php';
        ?>

    </head>
    <body>
        <form action="register.php" method="post">
            <label>first name</label>
            <input type="text" id="Fname" name="name">
            </br>
            <label>prefix</label>
            <input type="text" id="prefix" name="prefix">
            </br>
            <label>last name</label>
            <input type="text" id="Lname" name="Lname">
            </br>
            <label>email</label>
            <input type="text" id="email" name="mail">
            </br>
            <label>password</label>
            <input type="tetxt" id="password" name="pass">
            </br>
            <label>street</label>
            <input type="text" id="street" name="street">
            </br>#
            <label>home number</label>
            <input type="text" id="Number" name="HNM">
            </br>
            <label>postcode</label>
            <input type="text" id="Pcode" name="Pcode">
            </br>
            <label>city</label>
            <input type="text" id="city" name="city">
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

        createuser($conn, $Fname, $prefix, $Lname, $mail, $pass, $street, $HNM, $Pcode, $city);
    }
    
    
    ?>
</html>