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
    $sort = "";
    $order = "";
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Home</title>
    <link rel="icon" type="../image/png" href="../images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/categorie.css">
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
    <?php
    //easter egg Wiljan: wanneer het juiste keyword word verstuurd laat het een gif zien en speelt er muziek af
    if (isset($_POST['keyword']) && $_POST['keyword'] == "maxwell") {
    ?><img class="maxwell" src="../images/maxwell-cat.gif">
        <audio src="../audio/maxwell.mp3" visible="false" type="audio/mpeg" autoplay loop></audio>
    <?php
        exit;
    }

    ?>
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
                            <div class="image"><a href="product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "../images/", $row['imagesrc']; ?>" alt="Product"></a></div>
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

    <section class="outer main section">

        <div class="producten section">

            <?php
            //maakt een query aan van het gezochte keyword
            if (isset($_POST['keyword'])) {
                $like = $_POST['keyword'];
                $_SESSION['search'] = $like;
                $sanword = mysqli_real_escape_string($conn, $like);
                $where = "WHERE `productnaam` LIKE '%{$sanword}%' OR `categorie` LIKE '%{$sanword}%' or `merk` LIKE '%{$sanword}%'";
            } elseif (isset($_SESSION['search'])) {
                // Check if the search keyword is stored in the session (from previous load)
                $like = $_SESSION['search'];
                $sanword = mysqli_real_escape_string($conn, $like);
                $where = "WHERE `productnaam` LIKE '%{$sanword}%' OR `categorie` LIKE '%{$sanword}%' or `merk` LIKE '%{$sanword}%'";
            }

            //checkt of er er gesorteerd moet worden
            if (isset($_POST['sort'])) {
                if (is_numeric($_POST['sort']) && $_POST['sort'] > 0) {
                    $sort = $_POST['sort'];
                    $_SESSION['sort'] = $sort;
                    $sansort = mysqli_real_escape_string($conn, $sort);

                    //kiest welke order by clause er gebruikt moet worden in de query
                    switch ($sansort) {
                        case 1:
                            $order = "ORDER BY datum DESC";
                            break;
                        case 2:
                            $order = "ORDER BY datum ASC";
                            break;
                        case 3:
                            $order = "ORDER BY prijs ASC";
                            break;
                        case 4:
                            $order = "ORDER BY prijs desc";
                            break;

                        default:
                    }
                }
            }


            //laat resultaten zien van de zoekopdracht zonder sorting
            if ($sort == NULL) {
                $sql =  'SELECT * FROM producten ' . $where . '';
                if ($result = mysqli_query($conn, $sql)) {
                    // Fetch one and one row
                    while ($row = mysqli_fetch_row($result)) {
            ?>
                        <div id="product">
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
                //laat de resultaten van de zoekopdracht zien met sorting
            } elseif ($sort !== NULL) {

                $sql = 'SELECT * FROM producten ' . $where . ' ' . $order . '';
                if ($result = mysqli_query($conn, $sql)) {
                    // Fetch one and one row
                    while ($row2 = mysqli_fetch_row($result)) {
                    ?>
                        <div id="product">
                            <a href="product.php?product=<?php echo $row2[0]; ?>"><img height="200px" src="<?php echo "../images/", $row2[5]; ?>" alt="Product"></a>
                            <h3><?php echo $row2[1]; ?></h3>
                            <p><?php echo "€", $row2[3]; ?></p>
                            <p><?php echo $row2[8]; ?></p>
                                <input type="hidden" name="proid" value="<?php echo $row2[0]; ?>">
                                <button class="add-to-cart" name="add" value=" <?php echo $row2[0]; ?>"> Voeg toe aan winkelwagen</button>
                            </form>
                        </div>
            <?php }
                }
            }
            ?>
        </div>
        <?php
        ?>


        <div id="filters">
            <div id="sorting">
                <form action="search.php" method="post">
                    <label>Filter</label>
                    <select id="input" name="sort">
                        <option value="1">date descending</option>
                        <option value="2">date ascending</option>
                        <option value="3">price ascending</option>
                        <option value="4">price descending</option>
                    </select>
                    <input type="hidden" name="keyword" value="<?= $like ?>">
                    <br /><input class="apply" id="input" type="submit" value="Apply" />
            </div>
            </form>

        </div>
    </section>
    <?php include('footer.php'); ?>

</body>
<script src="../logic/app.js"></script>

</html>