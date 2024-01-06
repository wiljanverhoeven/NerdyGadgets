<!DOCTYPE html>
<html lang="nl">
<?php
require '../dbconnect.php';
require '../logic/functions.php';

session_start();
$_SESSION['token'] = uniqid();
$appel = "";

?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NerdyGadgets | Pong</title>
<style>
    .section {
        margin: 300px;
        margin-top: 150px;
    }

    #memory-game {

        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .game-card {
        width: 100px;
        height: 100px;
        cursor: pointer;
        position: relative;
        perspective: 1000px;
    }

    .card-inner {
        width: 100%;
        height: 100%;
        transition: transform 0.6s;
        transform-style: preserve-3d;
        position: absolute;
    }

    .game-card.flip .card-inner {
        transform: rotateY(180deg);
    }

    .card-face {
        width: 100%;
        height: 100%;
        position: absolute;
        backface-visibility: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .card-front {
        transform: rotateY(0deg);
        background-color: #ccc;
        background-image: url('../image/koko.png');
        background-size: cover;
        background-position: center;
    }

    .card-back {
        transform: rotateY(180deg);
        background-size: cover;
    }

    .card-image {
        max-width: 100%;
        max-height: 100%;
        display: block;
    }
</style>
<link rel="stylesheet" href="../styling/basic-style.css">
<link rel="stylesheet" href="../styling/homepage.css">
<link rel="stylesheet" href="../styling/carts.css">
<link rel="stylesheet" href="../styling/logincss.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="../styling/footer.css">
</head>

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
            <li><a href="../pages/producten.php" class="paginas">Producten</a></li>
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

</head>

<body>
    <section class="section">
        <h1>Memory Game with Images</h1>
        <p>Click on the cards to reveal them and find matching pairs.</p>

        <div id="memory-game"></div>

        <script>
            //gets images
            const imageSources = [
                '../image/a.png', // Replace with your image paths
                '../image/b.png',
                '../image/c.png',
                '../image/d.jpg',
                '../image/e.png',
                '../image/f.png',
                '../image/g.png',
                // Pairs of images
                '../image/a.png',
                '../image/b.png',
                '../image/c.png',
                '../image/d.jpg',
                '../image/e.png',
                '../image/f.png',
                '../image/g.png'
            ];

            //places cards on random locations
            function shuffle(array) {
                let currentIndex = array.length,
                    tempValue, randomIndex;

                while (currentIndex !== 0) {
                    randomIndex = Math.floor(Math.random() * currentIndex);
                    currentIndex -= 1;

                    tempValue = array[currentIndex];
                    array[currentIndex] = array[randomIndex];
                    array[randomIndex] = tempValue;
                }

                return array;
            }

            //flips cards
            function initializeMemoryGame() {
                const memoryGameContainer = document.getElementById('memory-game');
                let isFlipped = false;
                let lockBoard = false;
                let firstCard, secondCard;

                function flipCard() {
                    if (lockBoard) return;
                    if (this === firstCard) return;

                    this.classList.add('flip');

                    if (!isFlipped) {
                        isFlipped = true;
                        firstCard = this;
                        return;
                    }

                    secondCard = this;
                    checkForMatch();
                }

                //checks if the two cards match
                function checkForMatch() {
                    let isMatch = firstCard.querySelector('.card-back').style.backgroundImage === secondCard.querySelector('.card-back').style.backgroundImage;

                    isMatch ? disableCards() : unflipCards();
                }

                //disables cards when theyre flippen
                function disableCards() {
                    firstCard.removeEventListener('click', flipCard);
                    secondCard.removeEventListener('click', flipCard);

                    resetBoard();
                }

                //unflips cards
                function unflipCards() {
                    lockBoard = true;

                    setTimeout(() => {
                        firstCard.classList.remove('flip');
                        secondCard.classList.remove('flip');

                        resetBoard();
                    }, 1000);
                }

                //resets board
                function resetBoard() {
                    [isFlipped, lockBoard] = [false, false];
                    [firstCard, secondCard] = [null, null];
                }

                shuffle(imageSources);
                imageSources.forEach(imageSrc => {
                    const card = document.createElement('div');
                    card.classList.add('game-card');

                    const cardInner = document.createElement('div');
                    cardInner.classList.add('card-inner');
                    card.appendChild(cardInner);

                    const cardFront = document.createElement('div');
                    cardFront.classList.add('card-face', 'card-front');
                    cardInner.appendChild(cardFront);

                    const cardBack = document.createElement('div');
                    cardBack.classList.add('card-face', 'card-back');
                    cardBack.style.backgroundImage = `url(${imageSrc})`;
                    cardInner.appendChild(cardBack);

                    card.addEventListener('click', flipCard);
                    memoryGameContainer.appendChild(card);
                });
            }

            initializeMemoryGame();
        </script>
    </section>

</body>

<?php include('footer.php'); ?>

<script src="../logic/app.js"></script>