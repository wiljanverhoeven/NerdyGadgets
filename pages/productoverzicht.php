<!DOCTYPE html>
<html lang="nl">

<head>

    <?php
    //haalt informatie van bijnodigde bestanden op
    require '../dbconnect.php';
    require '../logic/functions.php';

    session_start();
    $_SESSION['token'] = uniqid();
    $appel = "";
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Home</title>
    <link rel="icon" type="../image/png" href="../images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/productoverzicht.css">
    <link rel="stylesheet" href="../styling/carts.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body class="">


    <div class="container2">
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
                    <li><a href="../index.php" class="paginas" title="Ga naar de homepagina">Home<span class="tooltiptext"></span></a></li>
                    <li><a href="../pages/over-ons.php" class="paginas" title="Meer informatie over ons">Over ons<span class="tooltiptext"></span></a></li>
                    <li><a href="../pages/productoverzicht.php" class="paginas" title="Bekijk onze producten">Producten<span class="tooltiptext"></span></a></li>
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
    </div>
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
                            <div class="image"><a href="../pages/product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "../images/", $row['imagesrc']; ?>" alt="Product"></a></div>
                            <div class="name"><?php echo $row['productnaam']; ?><p><?php echo $item['quantity']; ?>X</p>
                            </div>
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

    <div class="main section">

        <section class="filters">
            <a href="categorie.php?categorie=spelcomputers"><img class="filter" height="200px" src="../images/spelcomputers.JPEG" alt="spelcomputers"></a>
            <a href="categorie.php?categorie=onderdelen"><img class="filter" height="200px" src="../images/onderdelen.JPEG" alt="onderdelen"></a>
            <a href="categorie.php?categorie=gadgets"><img class="filter" height="200px" src="../images/gadgets.JPEG" alt="gadgets"></a>
            <a href="categorie.php?categorie=laptops"><img class="filter" height="200px" src="../images/laptops.jpg" alt="laptops"></a>
            <a href="categorie.php?categorie=telefoons"><img class="filter" height="200px" src="../images/telefoons.Jfif" alt="telefoons"></a>

        </section>
        <a href="../pages/memory.html" style="opacity: 0;" class="knopNaarPong">Ontzichtbare knop naar Memory easter egg</a>
        <section class="producten">
            <div class="sliders">
                <div id="slide1">
                    <h2>Aanbevolen producten</h2>
                    <div id="slider">
                        <?php

                        if (empty($_SESSION['search'])) {
                            for ($i = 0; $i < 3; $i++) {
                                $sql = "SELECT * FROM producten WHERE productid=$i";
                                $prod = mysqli_query($conn, $sql);
                                ${"producten$i"} = mysqli_fetch_assoc($prod); ?>
                                <div class="product ">
                                    <a href="../pages/product.php?product=<?php echo ${"producten$i"}['productid']; ?>"><img height="200px" src="<?php echo "../images/", ${"producten$i"}['imagesrc']; ?>" alt="Product 1"></a>
                                    <h3><?php echo ${"producten$i"}["productnaam"]; ?></h3>
                                    <p><?php echo "€", ${"producten$i"}["prijs"]; ?></p>
                                    <p><?php echo ${"producten$i"}["productinformatie"]; ?></p>
                                    <form method="post">
                                        <input type="hidden" name="proid" value="<?php echo ${"producten$i"}["productid"]; ?>">
                                        <button class="add-to-cart" name="add" value="<?php echo ${"producten$i"}["productid"]; ?>">Voeg toe aan winkelwagen</button>
                                    </form>
                                </div>
                                <?php }
                        } else {
                            $appel = $_SESSION['search'];
                        }

                        $used = 0;

                        if ($appel != null) {
                            $sql = 'SELECT * FROM producten WHERE productnaam LIKE "%' . $appel . '%" OR categorie LIKE "%' . $appel . '%" OR merk LIKE "%' . $appel . '%"';
                            if ($result = mysqli_query($conn, $sql)) {

                                for ($i = 0; $i < 3; $i++) {
                                    $row = mysqli_fetch_row($result);
                                    if ($row != null) { ?>
                                        <div class="product">
                                            <a href="../pages/product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/", $row[5]; ?>" alt="Product"></a>
                                            <h3><?php echo $row[1]; ?></h3>
                                            <p><?php echo "€", $row[3]; ?></p>
                                            <p><?php echo $row[8]; ?></p>
                                            <form method="post">
                                                <input type="hidden" name="proid" value="<?php echo $row[0]; ?>">
                                                <button class="add-to-cart" name="add" value=" <?php echo $row[0]; ?>"> Voeg toe aan winkelwagen</button>
                                            </form>
                                        </div>
                                        <?php
                                        $cata = $row[4];
                                        $pid = $row[0];
                                    } elseif ($row == null) {
                                        $sql2 = 'SELECT * FROM producten WHERE categorie LIKE "%' . $cata . '%" AND NOT productid = ' . $pid . ' AND NOT productid = ' . $used . ' ';
                                        if ($result2 = mysqli_query($conn, $sql2)) {
                                            $row2 = mysqli_fetch_row($result2);
                                            $used = $row2[0];
                                        ?>
                                            <div class="product">
                                                <a href="../pages/product.php?product=<?php echo $row2[0]; ?>"><img height="200px" src="<?php echo "../images/", $row2[5]; ?>" alt="Product"></a>
                                                <h3><?php echo $row2[1]; ?></h3>
                                                <p><?php echo "€", $row2[3]; ?></p>
                                                <p><?php echo $row2[8]; ?></p>
                                                <form method="post">
                                                    <input type="hidden" name="proid" value="<?php echo $row2[0]; ?>">
                                                    <button class="add-to-cart" name="add" value=" <?php echo $row2[0]; ?>"> Voeg toe aan winkelwagen</button>
                                                </form>
                                            </div>
                        <?php }
                                    }
                                }
                            }
                        } ?>

                    </div>
                </div>
                <div id="slide2">
                    <h2>Nieuwe producten</h2>
                    <div id="slider">
                        <?php
                        $sql = "SELECT * FROM producten ORDER BY datum DESC";
                        if ($result = mysqli_query($conn, $sql)) {
                            for ($i = 0; $i < 6; $i++) {
                                $row = mysqli_fetch_row($result);
                                if ($row != null) { ?>
                                    <div class="product">
                                        <a href="../pages/product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/", $row[5]; ?>" alt="Product"></a>
                                        <h3><?php echo $row[1]; ?></h3>
                                        <p><?php echo "€", $row[3]; ?></p>
                                        <p><?php echo $row[8]; ?></p>
                                        <form method="post">
                                            <input type="hidden" name="proid" value="<?php echo $row[0]; ?>">
                                            <button class="add-to-cart" name="add" value=" <?php echo $row[0]; ?>"> Voeg toe aan winkelwagen</button>
                                        </form>
                                    </div>
                        <?php }
                            }
                        }  ?>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <footer>

        <div class="inhoudFooter">
            <div class="contactgegevens">
                <h3 style="color: #fff" ;>Contactgegevens</h3>
                <p style="color: #fff" ;>
                    Adres: Hospitaaldreef 5, Almere
                    <br>
                    Email: administratie@nerdygadgets.nl
                    <br>
                    Telefoonnummer: +31 6 12345678
                </p>
            </div>

            <div class="betaalmiddelen">
                <h6>
                    <p>Bij NerdyGadgets bieden wij diverse betalingsmogelijkheden aan om uw betalingservaring veilig en vertrouwd te maken:</p>
                    <ul id="list">
                        <a>
                            <img src="../images/icon-mastercard.png" width="64.2" height="40">
                            <img src="../images/IDEAL_Logo.png" width="46" height="40">
                            <img src="../images/icon-visa.png" width="64.2" height="40">
                        </a>
                    </ul>
                    We nemen ook strenge beveiligingsmaatregelen om ervoor te zorgen dat uw betalingen veilig worden verwerkt.
                    <br>
                    Copyright © 2023 NerdyGadgets Inc. Alle rechten voorbehouden.
                </h6>
            </div>

            <div class="links">
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