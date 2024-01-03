<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    require '../dbconnect.php';

    session_start();

    $query2 = 'SELECT * FROM producten WHERE productid = "' . $_GET['product'] . '"';
    $result2 = mysqli_query($conn, $query2);
    $pro = mysqli_fetch_assoc($result2);
    $id = $_GET['product'];
    ?>

    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Product</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/product.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link rel="stylesheet" href="../styling/carts.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<<body onload="changeImage('https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177670?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720')">>
    <header>
        <div class="logo">
            <a href="../index.php">
                <img src="../images/NerdyGadgets_logo 5.png" alt="Logo" width="250" height="90">
            </a>
        </div>


        <div id="search">
            <form action="../pages/search.php" method="POST">
                <input class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">
                <button class="btn btn-primary searchSubmit" type="submit"> <img src="../images/zoeken_icon.png" alt="Winkelwagen" width="15.5" height="15.5">
            </form>
        </div>

        <nav>
            <ul>
                <li><a href="../index.php" class="paginas">Home</a></li>
                <li><a href="../pages/over-ons.php" class="paginas">Over ons</a></li>
                <li><a href="../pages/productoverzicht.php" class="paginas">Producten</a></li>
            </ul>
        </nav>

        <div class="icons">

            <?php
            if (isset($_COOKIE['email'])) {
            ?>
                <nav>
                    <div class="account">
                        <a class="paginas" title="ga naar uw account" href="../pages/logout.php">log uit</a>
                    </div>
                </nav>
            <?php
            } else {
            ?>
                <div class="account">
                    <a class="btnlogin-popup"><img class="user" src="../images/account_icon.png" alt="Account" width="40" height="40">
                        <img class="user_neon" src="../images/account_icon_neon.png" alt="Account" width="40" height="40"> </a>
                    </a>
                </div>

            <?php
            }
            ?>
            <div class="icon-cart">
                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
                    </svg>
                    <span>0</span>
                </div>
        </div>

    </header>

    <div class="cartTab">
        <h1>Shopping Cart</h1>
        <div class="listCart"></div>
        <div class="btn">
            <button class="close">CLOSE</button>
            <button class="checkOut">Check Out</button>
        </div>
    </div>

    <section id="block">
        <div class="wrapper">
            <span class="close-icon">
                <i class='bx bx-x'></i>
            </span>

            <div class="form-box login">
            <a href="pages/pong_easter_egg.php" style="opacity: 0;" class="knopNaarPong">Ontzichtbare knop naar Pong easter egg</a>
                <form action="../logic/loginB.php" method="post">
                    <h1> Login </h1>
                    <div class="input-box">
                        <input type="text" placeholder="username" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" name="remember"> remember me</label>
                        <a href="#"> Forgot password</a>
                    </div>

                    <button type="submit" class="btn">login</button>
                    <div class="register-login">
                        <p>Dont't have a account?<a href="#" class="register-link"> Register</a></p>
                    </div>


                </form>
            </div>
            <div class="form-box register">

                <form action="../logic/loginB.php" method="post">
                    <h1> Register </h1>
                    <div class="input-box">
                        <input type="text" placeholder="username" required name="usernamelogin">
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="E-mail" required name="Email">
                        <i class='bx bx-envelope'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" required name="passwordlogin">
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="agree">
                        <label><input type="checkbox"> Agree to the terms and services</label>

                        <button type="submit" class="btn">Make account</button>
                        <div class="register-login">
                            <p>Already have a account?<a href="#" class="login-link"> Log in</a></p>
                        </div>
                </form>
            </div>
        </div>
    </section>

    <script src="../logic/script.js"></script>

    <?php
                $sql = 'SELECT * FROM producten WHERE productid="'.$id.'" ';
                if ($result = mysqli_query($conn, $sql)) {
                    // Fetch one and one row
                    $row = mysqli_fetch_row($result)
            ?>

                    

    <div class="product-container" >
        <div class="product-images">
        <a href="product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/", $row[5]; ?>" alt="Product"></a>
        </div>

        <section id="productinformatie" class="productinformatie">

            <div class="bottom">

                <div class="product-details">
                    <div class="product-name"><?php echo $row[1]; ?></div>
                    <div class="product-description"><?php echo $row[8]; ?></div>
                    <div class="product-price"><?php echo "€", $row[3]; ?></div>
                    <button class="add-to-cart" name="toevoegen" value=" <?php echo $row[0]; ?>">Voeg toe aan winkelwagen</button>
                    <div class="availability">Beschikbaarheid: Op voorraad</div>
                </div>
        </section>
    </div>

    <div class="productbeschrijving">
        <h2>Productinformatie</h2>
        <div><?php echo $row[2]; ?></div>

        <!-- Voeg hier technische gegevens en beschikbare varianten toe -->
    </div>
    

    <div class="productreviews">
        <h2>Klantbeoordelingen</h2>
        <!-- Voeg hier klantbeoordelingen en feedbacksectie toe -->
    </div>
    <div class="aanraders">
    <?php
    $sql = 'SELECT * FROM producten WHERE NOT productnaam LIKE "%' . $row[1] . '%" OR categorie LIKE "%' . $row[4] . '%" or merk LIKE "%' . $row[7] . '%"';
    if ($result = mysqli_query($conn, $sql)) {
        $counter = 0; // Initialize counter
        while ($row2 = mysqli_fetch_row($result)) {
            if ($row2 != null && $counter < 3) { // Limit to 3 recommendations
                $counter++;
    ?>
                <div class="product2">
                    <a href="../pages/product.php?product=<?php echo $row2[0]; ?>"><img height="200px" src="<?php echo "../images/", $row2[5]; ?>" alt="Product"></a>
                    <h3><?php echo $row2[1]; ?></h3>
                    <p><?php echo "€", $row2[3]; ?></p>
                    <p><?php echo $row2[8]; ?></p>
                    <form method="get" action="../pages/product.php"></form>
                    <form method="post">
                        <input type="hidden" name="proid" value="<?php echo $row2[0]; ?>">
                        <button class="add-to-cart" name="add" value=" <?php echo $row2[0]; ?>"> Voeg toe aan winkelwagen</button>
                    </form>
                </div>
    <?php
            } else {
                break; // Exit the loop after 3 recommendations
            }
        }
    }
    ?>
</div>
<?php } ?>
    </div>

           

    <footer>

        <div class="inhoudFooter">
            <div class="contactfooter">
                <h3 style="color: #fff" ;>Contactgegevens</h3>
                <p style="color: #fff" ;>
                    Adres: Hospitaaldreef 5, Almere
                    <br>
                    Email: administratie@nerdygadgets.nl
                    <br>
                    Telefoonnummer: +31 06 12345678
                </p>
            </div>

            <div class="betaalmiddelen">
                <h6>
                    <p>Bij NerdyGadgets bieden wij diverse betalingsmogelijkheden aan om uw betalingservaring veilig en vertrouwd te maken:</p>
                    <ul id="list">
                        <a>
                            <img src="images/icon-mastercard.png" width="64.2" height="40">
                            <img src="images/IDEAL_Logo.png" width="46" height="40">
                            <img src="images/icon-visa.png" width="64.2" height="40">
                        </a>
                    </ul>
                    We nemen ook strenge beveiligingsmaatregelen om ervoor te zorgen dat uw betalingen veilig worden verwerkt.
                    <br>
                    Copyright © 2023 NerdyGadgets Inc. Alle rechten voorbehouden.
                </h6>
            </div>

            <div class="links">
                <h3>Links</h3>
                <a style="color: #fff" ; href="../index.php">Home</a>
                <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
                <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
                <a style="color: #fff" ; href="../pages/account.php">Account</a>
                <a style="color: #fff" ; href="../pages/legal.php">Legaal</a>
            </div>
    </footer>

    </body>
    <script src="../logic/app.js"></script>
</html>