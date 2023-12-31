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
    $cata = null;
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
    <link rel="stylesheet" href="../styling/footer.css">


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
                    <div class="account">
                        <a href="logout.php"><img class="user" src="../images/loguit.png" alt="Account" width="40" height="40">
                        </a>
                    </div>
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
            //adding items to cart array
            if (isset($_POST['add'])) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array();
                }

                $proid = $_POST['proid'];
                $item_exists = false;

                //checks if item exists
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
            //when removing something out of the cart
            if (!empty($_SESSION['cart'])) {
                if (isset($_POST['minus'])) {
                    $proid = $_POST['proid'];

                    // Store the index to unset after the loop
                    $index_to_unset = null;

                    foreach ($_SESSION['cart'] as $index => &$item) {
                        if ($item['proid'] == $proid) {
                            //lower the quantity of an item
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
            //uses the productID's in the cart array to get all the product information out of the DB
            if (!empty($_SESSION['cart'])) {
                $set = 0;
                foreach ($_SESSION['cart'] as $item) {
                    $proid = $item['proid'];
                    $line = 'SELECT * FROM producten WHERE productid = ?';
                    $prepare = mysqli_prepare($conn, $line);
                    mysqli_stmt_bind_param($prepare, 'i', $proid);
                    mysqli_stmt_execute($prepare);
                    $end = mysqli_stmt_get_result($prepare);
                    //increases the price with the quantity
                    if ($rows = mysqli_fetch_assoc($end)) {
                        $set += $rows['prijs'] * $item['quantity'];
                    }
                }
                //uses the prices and quantity to give the full price
            ?> <div class="name">
                    <p>Totaal prijs: €<?php echo $set; ?></p>
                </div> <?php
                    }    //uses the productID's in the cart array to get all the product information out of the DB
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $item) {
                            $proid = $item['proid'];

                            // Use prepared statement to fetch product information
                            $sql = 'SELECT * FROM producten WHERE productid = ?';
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, 'i', $proid);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            //display all of the products in the cart array in the HTML
                            if ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="item">
                            <div class="image"><a href="pages/product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "images/", $row['imagesrc']; ?>" alt="Product"></a></div>
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
            <!-- login pop up screen -->
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
                <!-- register pop up screen-->
                <form action="register.php" method="post">
                    <h1> Register </h1>
                    <div class="input-box">
                        <input type="text" placeholder="firstname" required name="name">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="prefix" name="prefix">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Last name" required name="Lname">
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="password" required name="pass">
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="E-mail" required name="mail">
                        <i class='bx bx-envelope'></i>
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="street" required name="street">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="House number" required name="HNM">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="Postal code" required name="Pcode">
                    </div>
                    <div class="input-box">
                        <input type="text" placeholder="City" required name="city">
                    </div>

                    <button type="submit" class="btn" name="apply">Make account</button>
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
            <!-- filter voor categorie -->
            <a href="categorie.php?categorie=spelcomputers"><img class="filter" height="200px" src="../images/spelcomputers.JPEG" alt="spelcomputers"></a>
            <a href="categorie.php?categorie=onderdelen"><img class="filter" height="200px" src="../images/onderdelen.JPEG" alt="onderdelen"></a>
            <a href="categorie.php?categorie=gadgets"><img class="filter" height="200px" src="../images/gadgets.JPEG" alt="gadgets"></a>
            <a href="categorie.php?categorie=laptops"><img class="filter" height="200px" src="../images/laptops.jpg" alt="laptops"></a>
            <a href="categorie.php?categorie=telefoons"><img class="filter" height="200px" src="../images/telefoons.Jfif" alt="telefoons"></a>

        </section>
        <a href="../pages/memory.php" style="opacity: 0;" class="knopNaarPong">Ontzichtbare knop naar Pong easter egg</a>
        <section class="producten">
            <div class="sliders">
                <div id="slide1">
                    <h2>Aanbevolen producten</h2>
                    <div id="slider">
                        <?php
                        $used = null;

                        // If the search bar has not been used yet, display standard products from the database
                        if (empty($_SESSION['search'])) {
                            for ($i = 0; $i < 3; $i++) {
                                $sql = "SELECT * FROM producten WHERE productid=$i";
                                $prod = mysqli_query($conn, $sql);
                                ${"producten$i"} = mysqli_fetch_assoc($prod); ?>

                                <div class="product ">
                                    <a href="product.php?product=<?php echo ${"producten$i"}['productid']; ?>"><img height="200px" src="<?php echo "../images/", ${"producten$i"}['imagesrc']; ?>" alt="Product 1"></a>
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
                            // Sets $appel to the data from the search bar
                            $appel = $_SESSION['search'];

                            // Uses the data from the search bar to show items with information similar to what's in the search bar
                            if ($appel != null) {
                                $sql = 'SELECT * FROM producten WHERE productnaam LIKE "%' . $appel . '%" OR categorie LIKE "%' . $appel . '%" or merk LIKE "%' . $appel . '%"';
                                if ($result = mysqli_query($conn, $sql)) {

                                    $found = false;

                                    for ($i = 0; $i < 3; $i++) {
                                        $row = mysqli_fetch_assoc($result);

                                        if ($row != null) {
                                            $found = true; ?>

                                            <div class="product">
                                                <a href="product.php?product=<?php echo $row['productid']; ?>"><img height="200px" src="<?php echo "../images/", $row['imagesrc']; ?>" alt="Product"></a>
                                                <h3><?php echo $row['productnaam']; ?></h3>
                                                <p><?php echo "€", $row['prijs']; ?></p>
                                                <p><?php echo $row['productinformatie']; ?></p>
                                                <form method="post">
                                                    <input type="hidden" name="proid" value="<?php echo $row['productid']; ?>">
                                                    <button class="add-to-cart" name="add" value=" <?php echo $row['productid']; ?>"> Voeg toe aan winkelwagen</button>
                                                </form>
                                            </div>
                                            <?php
                                            $cata = $row['categorie'];
                                            $id = $row['productid'];
                                            // If there are not enough similar products, it will start basing it on items of the same category
                                        } elseif ($row == null && $cata != null && $used == null) {

                                            $sql2 = 'SELECT * FROM producten WHERE categorie LIKE "%' . $cata . '%" AND NOT productid = ' . $id;
                                            if ($result2 = mysqli_query($conn, $sql2)) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $used = $row2['productid']; ?>
                                                <div class="product">
                                                    <a href="product.php?product=<?php echo $row2['productid']; ?>"><img height="200px" src="<?php echo "../images/", $row2['imagesrc']; ?>" alt="Product"></a>
                                                    <h3><?php echo $row2['productnaam']; ?></h3>
                                                    <p><?php echo "€", $row2['prijs']; ?></p>
                                                    <p><?php echo $row2['productinformatie']; ?></p>
                                                    <form method="post">
                                                        <input type="hidden" name="proid" value="<?php echo $row2['productid']; ?>">
                                                        <button class="add-to-cart" name="add" value=" <?php echo $row2['productid']; ?>"> Voeg toe aan winkelwagen</button>
                                                    </form>
                                                </div>
                                                <?php
                                            }
                                        } elseif ($used != null) {
                                            $sql3 = 'SELECT * FROM producten WHERE categorie LIKE "%' . $cata . '%" AND NOT (productid = ' . $id . ') AND NOT (productid = ' . $used . ')';
                                            if ($result3 = mysqli_query($conn, $sql3)) {
                                                $row3 = mysqli_fetch_assoc($result3);
                                                if ($row3 != null) { ?>
                                                    <div class="product">
                                                        <a href="product.php?product=<?php echo $row3['productid']; ?>"><img height="200px" src="<?php echo "../images/", $row3['imagesrc']; ?>" alt="Product"></a>
                                                        <h3><?php echo $row3['productnaam']; ?></h3>
                                                        <p><?php echo "€", $row3['prijs']; ?></p>
                                                        <p><?php echo $row3['productinformatie']; ?></p>
                                                        <form method="post">
                                                            <input type="hidden" name="proid" value="<?php echo $row3['productid']; ?>">
                                                            <button class="add-to-cart" name="add" value=" <?php echo $row3['productid']; ?>"> Voeg toe aan winkelwagen</button>
                                                        </form>
                                                    </div>
                                            <?php
                                                } else {
                                                    // If there is no response from the database at the final try, go back to the initial code block
                                                    break;
                                                }
                                            }
                                        }
                                    }

                                    // If there is no response from the database at the final try, go back to the initial code block
                                    if (!$found) {
                                        for ($i = 0; $i < 3; $i++) {
                                            $sql = "SELECT * FROM producten WHERE productid=$i";
                                            $prod = mysqli_query($conn, $sql);
                                            ${"producten$i"} = mysqli_fetch_assoc($prod); ?>

                                            <div class="product ">
                                                <a href="product.php?product=<?php echo ${"producten$i"}['productid']; ?>"><img height="200px" src="<?php echo "../images/", ${"producten$i"}['imagesrc']; ?>" alt="Product 1"></a>
                                                <h3><?php echo ${"producten$i"}["productnaam"]; ?></h3>
                                                <p><?php echo "€", ${"producten$i"}["prijs"]; ?></p>
                                                <p><?php echo ${"producten$i"}["productinformatie"]; ?></p>
                                                <form method="post">
                                                    <input type="hidden" name="proid" value="<?php echo ${"producten$i"}["productid"]; ?>">
                                                    <button class="add-to-cart" name="add" value="<?php echo ${"producten$i"}["productid"]; ?>">Voeg toe aan winkelwagen</button>
                                                </form>
                                            </div>

                        <?php
                                        }
                                    }
                                }
                            }
                        }
                        ?>


                    </div>
                </div>
                <div id="slide2">
                    <h2>Nieuwe producten</h2>
                    <div id="slider">
                        <?php
                        //laat de nieuwste producten zien
                        $sql = "SELECT * FROM producten ORDER BY datum DESC";
                        if ($result = mysqli_query($conn, $sql)) {
                            for ($i = 0; $i < 6; $i++) {
                                $row = mysqli_fetch_row($result);
                                if ($row != null) { ?>
                                    <div class="product">
                                        <a href="product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/", $row[5]; ?>" alt="Product"></a>
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
    <?php include('footer.php'); ?>
</body>
<script src="../logic/app.js"></script>

</html>