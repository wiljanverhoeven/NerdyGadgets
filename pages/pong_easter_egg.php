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
<link rel="icon" type="image/png" href="/images/Logo_icon 2">
<link rel="stylesheet" href="../styling/basic-style.css">
<link rel="stylesheet" href="../styling/pong_easter_egg.css">
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

    <div class="witregel1">
        <h1>Een witregel</h1>
    </div>

    <div>

    </div>

    <div class="canvas">
        <canvas id="pong" width="600" height="400"></canvas>
    </div>
    <script>
        const canvas = document.getElementById('pong');
        const ctx = canvas.getContext('2d');
        //moves player
        canvas.addEventListener('mousemove', (e) => {
            player.y = e.clientY - player.height / 2;
        });
        //creates player
        const player = {
            x: 10,
            y: canvas.height / 2 - 50,
            width: 10,
            height: 100,
            color: '#fff',
        };
        //creates ai
        const ai = {
            x: canvas.width - 20,
            y: canvas.height / 2 - 50,
            width: 10,
            height: 100,
            color: '#fff',
        };
        //creates ball
        const ball = {
            x: canvas.width / 2,
            y: canvas.height / 2,
            radius: 8,
            color: '#fff',
            speed: 5,
            velocityX: 5,
            velocityY: 5,
        };
        //creates canvas
        function drawRect(x, y, width, height, color) {
            ctx.fillStyle = color;
            ctx.fillRect(x, y, width, height);
        }
        //makes path of the ball
        function drawBall(x, y, radius, color) {
            ctx.fillStyle = color;
            ctx.beginPath();
            ctx.arc(x, y, radius, 0, Math.PI * 2, false);
            ctx.closePath();
            ctx.fill();
        }

        function game() {
            update();
            render();
            requestAnimationFrame(game);
        }

        //checks ball location and moves the ai based on the ball
        function update() {
            ball.x += ball.velocityX;
            ball.y += ball.velocityY;

            if (ball.y + ball.radius > canvas.height || ball.y - ball.radius < 0) {
                ball.velocityY = -ball.velocityY;
            }

            let paddle = ball.x < canvas.width / 2 ? player : ai;
            if (collision(ball, paddle)) {
                let angle = (Math.random() - 0.5) * Math.PI / 4;
                ball.velocityX = -ball.velocityX * 1.1;
                ball.velocityY = ball.speed * Math.sin(angle);
            }

            if (ball.x - ball.radius < 0) {
                resetBall();
            } else if (ball.x + ball.radius > canvas.width) {
                resetBall();
            }

            ai.y += (ball.y - (ai.y + ai.height / 2)) * 0.1;
        }

        //checks when two entities connect
        function collision(b, p) {
            return (
                b.x + b.radius > p.x &&
                b.x - b.radius < p.x + p.width &&
                b.y + b.radius > p.y &&
                b.y - b.radius < p.y + p.height
            );
        }

        //resets theball
        function resetBall() {
            ball.x = canvas.width / 2;
            ball.y = canvas.height / 2;
            ball.speed = 5;
            ball.velocityX = -ball.velocityX;
            ball.velocityY = (Math.random() - 0.5) * 10;
        }

        //draws game
        function render() {
            drawRect(0, 0, canvas.width, canvas.height, '#000');
            drawRect(player.x, player.y, player.width, player.height, player.color);
            drawRect(ai.x, ai.y, ai.width, ai.height, ai.color);
            drawBall(ball.x, ball.y, ball.radius, ball.color);
        }

        game();
    </script>

    <div>
        <h1 class="witregel2">Gebruik je muis in de verticale richting om de linkerspeler te besturen</h1>
    </div>

</body>

<?php include('footer.php'); ?>
</div>
</div>
</div>
<script src="../logic/app.js"></script>