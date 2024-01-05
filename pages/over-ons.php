<!DOCTYPE html>
<html lang="nl">
<head>
    <?php
    require '../dbconnect.php';
    require '../logic/functions.php';

    session_start();
    $_SESSION['token'] = uniqid();
    $appel = "";

    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Ons | NerdyGadgets</title>
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/carts.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link rel="stylesheet" href="../styling/over-ons.css">
    

</head>
<body>
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
                </div>
        </div>

    </header>

    <div class="cartTab" id="exampleList">
        <h1>Shopping Cart</h1>
        <div class="listCart">
            <?php
            if (isset($_POST['add'])) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array();
                }

                $proid = $_POST['proid'];
                $item_exists = false;

                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['proid'] == $proid) {
                        // If the item already exists, update its quantity and exit the loop
                        $item['quantity'] += 1;
                        $item_exists = true;
                        break;
                    }
                }

                if (!$item_exists) {
                    // If the item does not exist, add it to the cart
                    $item_array = array(
                        'proid' => $proid,
                        'quantity' => 1,
                    );
                    $_SESSION['cart'][] = $item_array;
                }

                // Redirect to the same or a different page after processing the form
                header("Location: {$_SERVER['REQUEST_URI']}");
                exit;
            }
            if (!empty($_SESSION['cart'])) {
                if (isset($_POST['minus'])) {
                    $proid = $_POST['proid'];

                    // Store the index to unset after the loop
                    $index_to_unset = null;

                    foreach ($_SESSION['cart'] as $index => &$item) {
                        if ($item['proid'] == $proid) {
                            $item['quantity'] -= 1;

                            if ($item['quantity'] <= 0) {
                                // Set the index to unset after the loop
                                $index_to_unset = $index;
                            }

                            break;
                        }
                    }

                    // Unset the item if needed outside the loop
                    if ($index_to_unset !== null) {
                        unset($_SESSION['cart'][$index_to_unset]);
                    }
                }
            }
            if (!empty($_SESSION['cart'])) {
            $set = 0;
            foreach ($_SESSION['cart'] as $item) { 
                $proid = $item['proid'];
                $line = 'SELECT * FROM producten WHERE productid = ?';
                $prepare = mysqli_prepare($conn, $line);
                mysqli_stmt_bind_param($prepare, 'i', $proid);
                mysqli_stmt_execute($prepare);
                $end = mysqli_stmt_get_result($prepare);
                if ($rows = mysqli_fetch_assoc($end)) { 
                    $set += $rows['prijs'] * $item['quantity'];
                }
            }
            ?> <div class="name"><p>Totaal prijs: €<?php echo $set;?></p></div> <?php
        }
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $proid = $item['proid'];

                    // Use prepared statement to fetch product information
                    $sql = 'SELECT * FROM producten WHERE productid = ?';
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $proid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    

                    if ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="item">
                            <div class="image"><a href="pages/product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "images/", $row['imagesrc']; ?>" alt="Product"></a></div>
                            <div class="name"><?php echo $row['productnaam'];?><p><?php echo $item['quantity'];?>X</p></div>
                            <div class="totalprice">€<?php echo $row['prijs'] * $item['quantity']; ?></div>
                            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <input type="hidden" name="proid" value="<?php echo $proid; ?>">
                                <button type="submit" name="add">+</button>
                                <button type="submit" name="minus">-</button>
                            </form>
                        </div>
                        
            <?php
                    }
                }
            } else {
                // Display a message or take other actions when the cart is empty
                echo "Your shopping cart is empty.";
            }
        


            ?>
            


        </div>
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
            <a href="pong_easter_egg.php" style="opacity: 0;" class="knopNaarPong">Ontzichtbare knop naar Pong easter egg</a>
                <form action="login.php" method="post">
                    <h1> Login </h1>
                    <div class="input-box">
                        <input type="text" placeholder="email" name="mail" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="pass" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <button type="submit" name="apply" class="btn">login</button>
                    <div class="register-login">
                        <p>Dont't have a account?<a href="#" class="register-link"> Register</a></p>
                    </div>


                </form>
            </div>
            <div class="form-box register">

                <form action="pages/login.php" method="post">
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

    <script src="logic/script.js"></script>

<main>
    <section id="over-ons" class="section">
        <div class="container">
            <h1 class="title">Over Ons</h1>
            <div class="about-content">
                <div class="image">
                    <img src="../images/overons.jpg" alt="Over Ons">
                </div>
                <div class="content">
                    <p>Welkom bij NerdyGadgets. Hier kunt u meer te weten komen over onze organisatie, onze missie en wat wij te bieden hebben aan onze klanten.
                        Wij streven ernaar om geweldige producten aan te bieden voor de beste prijzen, met eenvoudige navigatie om snel te vinden wat u zoekt.
                        U kunt vertrouwen op veilige betalingsmogelijkheden voor uw gemoedsrust, en we zorgen ervoor dat uw producten snel worden geleverd, zodat u ze op tijd ontvangt.
                        Als u niet tevreden bent met uw product, bieden wij geld-terug-garantie. We behandelen de recensies van onze klanten als waardevolle feedback, omdat het vertrouwen van de klant voor ons het belangrijkste is.</p>
                    <a href="" class="leesmeer">Lees Meer</a>
                </div>
            </div>
        </div>
        <div id="secret-code" style="display: none;">Gefeliciteerd, Je hebt een geheime kortingscode ontdekt! Gebruik code: HieuChinees30</div>
    </section>

    <section>
        <div class="over-ons-section">
        <h2>Ons Team</h2>
        <div class="persoon-cards">
            <div class="persoon-card">
            
                    <img class="pimg" src="../images/Hieu!.jpg" alt="Hieu Phan">
      
                <div class="card-content">
                    <h3>Hieu Phan:</h3>
                    <p>Leerling en 's werelds eerste Covid 19 patiënt</p>
                </div>
            </div>

            <div class="persoon-card">
              
                    <img  class="pimg" src="../images/Danyaal_web.jpeg" alt="Danyaal Burney">
                
                <div class="card-content">
                    <h3>Danyaal Burney:</h3>
                    <p>Baas van Hieu/ervaren webontwikkelaar</p>
                </div>
            </div>

            <div class="persoon-card">
              
                    <img class="pimg" src="../images/Shahzaib!.jpg" alt="Shahzaib Saleem">
               
                <div class="card-content">
                    <h3>Shahzaib Saleem:</h3>
                    <p>Gecertificeerde Hieu hater/ervaren webontwikkelaar</p>
                </div>
            </div>

            <div class="persoon-card">
                
                    <img class="pimg" src="../images/Wiljan!!!.jpg" alt="Wiljan Verhoeven">
           
                <div class="card-content">
                    <h3>Wiljan Verhoeven:</h3>
                    <p>Lead Developer/Alleskunner</p>
                </div>
            </div>

            <div class="persoon-card">
              
                    <img class="pimg" src="../images/Alex_web.jpg" alt="Alexander Dijkhuizen">
              
                <div class="card-content">
                    <h3>Alexander Dijkhuizen:</h3>
                    <p>Aangewezen project leider. (Scrum master van niks.)</p>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

<script src="../logic/script.js"></script>

<script>
    var secretCodeVisible = false;

    // Voeg een keydown event listener toe aan het document
    document.addEventListener('keydown', function(event) {
        // Controleer of de toets 'e' is ingedrukt
        if (event.key === 'e') {
            // Wissel de zichtbaarheid van de geheime code
            secretCodeVisible = !secretCodeVisible;

            // Toon de geheime code als deze zichtbaar moet zijn
            if (secretCodeVisible) {
                document.getElementById('secret-code').style.display = 'block';
            } else {
                document.getElementById('secret-code').style.display = 'none';
            }
        }
    });
</script>

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
                        <img src="../images/icon-mastercard.png" width="64.2" height="40" >
                        <img src="../images/IDEAL_Logo.png" width="46" height="40" >
                        <img src="../images/icon-visa.png" width="64.2" height="40" >
                    </a>
                </ul>
                We nemen ook strenge beveiligingsmaatregelen om ervoor te zorgen dat uw betalingen veilig worden verwerkt.
                <br>
                Copyright © 2023 NerdyGadgets Inc. Alle rechten voorbehouden.</h6>
        </div>

        <div class="links">
            <h3>Links</h3>
            <a style="color: #fff" ; href="./">Home</a>
            <a style="color: #fff" ; href="./#about">Over ons</a>
            <a style="color: #fff" ; href="./search/">Producten</a>
            <a style="color: #fff"; href="./account/">Account</a>
            <a style="color: #fff"; href="./legal/">Legaal</a>
        </div>
    </div>
</footer>
</body>
</html>