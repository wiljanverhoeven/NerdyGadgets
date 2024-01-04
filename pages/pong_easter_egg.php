<!DOCTYPE html>
<html lang="nl">

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Pong</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/pong_easter_egg.css">
    <link rel="stylesheet" href="../styling/carts.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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

        canvas.addEventListener('mousemove', (e) => {
            player.y = e.clientY - player.height / 2;
        });

        const player = {
            x: 10,
            y: canvas.height / 2 - 50,
            width: 10,
            height: 100,
            color: '#fff',
        };

        const ai = {
            x: canvas.width - 20,
            y: canvas.height / 2 - 50,
            width: 10,
            height: 100,
            color: '#fff',
        };

        const ball = {
            x: canvas.width / 2,
            y: canvas.height / 2,
            radius: 8,
            color: '#fff',
            speed: 5,
            velocityX: 5,
            velocityY: 5,
        };

        function drawRect(x, y, width, height, color) {
            ctx.fillStyle = color;
            ctx.fillRect(x, y, width, height);
        }

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

        function collision(b, p) {
            return (
                b.x + b.radius > p.x &&
                b.x - b.radius < p.x + p.width &&
                b.y + b.radius > p.y &&
                b.y - b.radius < p.y + p.height
            );
        }

        function resetBall() {
            ball.x = canvas.width / 2;
            ball.y = canvas.height / 2;
            ball.speed = 5;
            ball.velocityX = -ball.velocityX;
            ball.velocityY = (Math.random() - 0.5) * 10;
        }

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
    </div>
    </div>
    </div>
    <script src="logic/app.js"></script>