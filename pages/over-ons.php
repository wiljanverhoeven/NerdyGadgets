<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Ons | NerdyGadgets</title>
    <link rel="icon" type="image/png" href="../images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
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
                <li><a href="../index.php" class="paginas" title="Ga naar de homepagina">Home<span class="tooltiptext"></span></a></li>
                <li><a href="../pages/over-ons.php" class="paginas current" title="Meer informatie over ons">Over ons<span class="tooltiptext"></span></a></li>
                <li><a href="producten.php" class="paginas" title="Bekijk onze producten">Producten<span class="tooltiptext"></span></a></li>
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

    <main>
        <section id="over-ons" class="section">
            <h1>Over Ons</h1>
            <p>
                Welkom bij NerdyGadgets. Hier kunt u meer te weten komen over onze organisatie, onze missie en wat wij te bieden hebben aan onze klanten.
                Wij streven ernaar om geweldige producten aan te bieden voor de beste prijzen, met eenvoudige navigatie om snel te vinden wat u zoekt.
                U kunt vertrouwen op veilige betalingsmogelijkheden voor uw gemoedsrust, en we zorgen ervoor dat uw producten snel worden geleverd, zodat u ze op tijd ontvangt.
                Als u niet tevreden bent met uw product, bieden wij geld-terug-garantie. We behandelen de recensies van onze klanten als waardevolle feedback, omdat het vertrouwen van de klant voor ons het belangrijkste is.
            </p>




            <h2>Ons Team</h2>
            <p><strong>Alexander Dijkhuizen</strong> - Scrum Master</p>
            <p><strong>Wiljan Verhoeven</strong> - Lead Developer</p>
            <p><strong>Hieu Phan</strong> - Leerling</p>
            <p><strong>Danyaal Burney</strong> -Webontwikkelaar</p>
            <p><strong>Shahzaib Saleem</strong> - Hieu Hater</p>




            <p>Bij eventuele vragen kunt u contact met ons opnemen</p>
    </main>

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
                <h3>Links</h3>
                <a style="color: #fff" ; href="./">Home</a>
                <a style="color: #fff" ; href="./#about">Over ons</a>
                <a style="color: #fff" ; href="./search/">Producten</a>
                <a style="color: #fff" ; href="./account/">Account</a>
                <a style="color: #fff" ; href="./legal/">Legaal</a>
            </div>
    </footer>
    <script src="../logic/app.js"></script>