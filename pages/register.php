<html>
    <head>
        <?php require '../dbconnect.php'; ?>

    </head>
    <body>
        <form action="signup.php" method="post">
            <label>first name</label>
            <input type="text" id="Fname" value="">
            </br>
            <label>prefix</label>
            <input type="text" id="prefix" value="">
            </br>
            <label>last name</label>
            <input type="text" id="Lname" value="">
            </br>
            <label>email</label>
            <input type="text" id="email" value="">
            </br>
            <label>password</label>
            <input type="tetxt" id="password" value="">
            </br>
            <label>street</label>
            <input type="text" id="street" value="">
            </br>
            <label>home number</label>
            <input type="text" id="Number" value="">
            </br>
            <label>postcode</label>
            <input type="text" id="Pcode" value="">
            </br>
            <label>city</label>
            <input type="text" id="city" value="">
            </br>
            <input type="submit" class="apply" value="apply"> 
        </form>
    </body>
</html>