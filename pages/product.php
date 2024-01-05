<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    require '../dbconnect.php';
    require '../logic/functions.php';
    ob_start();

    session_start();
    $_SESSION['token'] = uniqid();
    $appel = "";

    $query2 = 'SELECT * FROM producten WHERE productid = "' . $_GET['product'] . '"';
    $result2 = mysqli_query($conn, $query2);
    $pro = mysqli_fetch_assoc($result2);
    $id = $_GET['product'];
    ?>

    

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Product</title>
    <link rel="icon" type="image/png" href="../images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/product.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link rel="stylesheet" href="../styling/carts.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                            <div class="image"><a href="../pages/product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "../images/", $row['imagesrc']; ?>" alt="Product"></a></div>
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
                    <form method="post">
                        <input type="hidden" name="proid" value="<?php echo $row[0]; ?>">
                        <button class="add-to-cart" name="add" value=" <?php echo $row[0]; ?>"> Voeg toe aan winkelwagen</button>
                    </form>
                    <div class="availability">Beschikbaarheid: Op voorraad</div>
                </div>
        </section>
    </div>

    <div class="productbeschrijving">
        <h2>Productinformatie</h2>
        <div><?php echo $row[2]; ?></div>

        <!-- Voeg hier technische gegevens en beschikbare varianten toe -->
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
    

    <div class="productreviews">
        <h2>Klantbeoordelingen</h2>
        <!-- Voeg hier klantbeoordelingen en feedbacksectie toe -->
        <?php
        $sql = "SELECT r.*, u.first_name, u.surname_prefix, u.surname
        FROM recensies r
        JOIN user u ON r.User_id = u.id
        WHERE product_id = " . $row[0];
        $result = $conn->query($sql);
        if($result->num_rows > 0) {
        while ($row3 = $result->fetch_assoc()) {
            $product_id = $row3['Product_id'];
            $inhoud = $row3['inhoud'];
            $rating = $row3['rating'];
            $name = $row3['first_name'] ." ". $row3['surname_prefix'] ." ". $row3['surname'];
        
        ?>
        <div class="existing-reviews">
            <!-- user name, date and stars -->
            <div class="review-user">
                <h4><?=$name?></h4>
                <?php
                    if ($rating == 1) {
                        echo "<span>&starf;&star;&star;&star;&star;</span>";
                    } else if ($rating == 2) {
                        echo "<span>&starf;&starf;&star;&star;&star;</span>";
                    }else if ($rating == 3) {
                        echo "<span>&starf;&starf;&starf;&star;&star;</span>";
                    }else if ($rating == 4) {
                        echo "<span>&starf;&starf;&starf;&starf;&star;</span>";
                    }else if ($rating == 5) {
                        echo "<span>&starf;&starf;&starf;&starf;&starf;</span>";
                    }
                ?>
                
            </div>

            <div class="review-comment">
                <p><?=$inhoud?></p>
            </div>
        </div>
        <?php
        } 
        } else {
            echo "<div style='width: 100%; height: 300px; display: flex; align-items: center; justify-content: center;'>
            <p>Dit product heeft nog geen reviews</p>
        </div>";
        }
        if (isset($_COOKIE['email'])) {
    ?>

        <form method="post">
                <p>laat zelf een review achter</p>
                <div class="stars">
                    <input type="radio" value="1" name="ster">
                    <input type="radio" value="2" name="ster">
                    <input type="radio" value="3" name="ster">
                    <input type="radio" value="4" name="ster">
                    <input type="radio" value="5" name="ster">
                </div>
                <!-- inhoud -->
                <label for="review">
                    <textarea name="review" cols="30" rows="10" style="resize: none"></textarea>
                </label>
                <input type="submit" class="review-btn" name="submit">
            </form>
        <?php } else {
            ?> <p>log in to leave a review</p> <?php
        }
        
        if (isset($_POST["submit"])) {
            $rating = $_POST["ster"];
            $review = $_POST["review"];
            $prodctid = $row[0];
            $query = "SELECT * FROM user where email LIKE '".$_COOKIE['email']."' ;";
            $result = mysqli_query($conn, $query);
            $rows = mysqli_fetch_row($result);
            $id = $rows[0];
    

            $query = "INSERT INTO recensies (inhoud, rating, Product_id, User_id) VALUES (?, ?, ?, ?);";
            $stmt = $conn->prepare($query) or die("prepare failed.");
            $stmt->bind_param('ssss', $review, $rating, $prodctid, $id);
            $stmt->execute() or die('execution failed.');
            $productLink = "product.php?product=" . $row[0];
            header("Location: $productLink");
                
        }
        
        ?>
    </div>
<?php } ?>
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