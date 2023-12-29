User
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: sans-serif;
}

.container {
    width: 80%;
    margin: 50px auto;
    padding: 20px;
}

.title {
    text-align: center;
    font-size: 45px;
    font-weight: bold;
    margin-bottom: 70px;
}

.about-content {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
}

.image {
    flex: 1;
    margin-right: 20px;
    overflow: hidden;
    border-radius: 10px;
}

.image img {
    width: 100%;
    transition: transform 0.3s ease;
}

.image:hover img {
    transform: scale(1.1);
}

.content {
    flex: 1;
    margin-left: 20px;
}

.over-ons-section h2 {
    font-size: 38px;
    text-align: center;
    color: #cccccc;
    margin: 50px 0px;
}

.persoon-cards {
    width: 85%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    margin: auto;
    align-items: center;
}

.persoon-card {
    width: 50%;
    margin: 30px;
    box-shadow: 0px 0px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
}

.persoon-card img {
    width: 30%;
    height: auto;
}

.card-content {
    padding: 20px;
}

.card-content h2 {
    z-index: 1;
    position: relative;
    font-size: 22px;
    margin-bottom: 10px;
}

.card-content p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}


<!DOCTYPE html>
<html lang="nl">
<head>
    <?php
    session_start();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Ons | NerdyGadgets</title>
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <button class="btn btn-primary searchSubmit" type="submit"> <img src="../images/zoeken_icon.png" alt="Winkelwagen" width="15.5" height="15.5"></button>
        </form>
    </div>

    <nav>
        <ul>
            <li><a href="../index.php" class="paginas" title="Ga naar de homepagina">Home<span class="tooltiptext"></span></a></li>
            <li><a href="../pages/over-ons.php" class="paginas current" title="Meer informatie over ons">Over ons<span class="tooltiptext"></span></a></li>
            <li><a href="../pages/producten.php" class="paginas" title="Bekijk onze producten">Producten<span class="tooltiptext"></span></a></li>
        </ul>
    </nav>

    <div class="icons">
        <div class="cart">
            <a href="winkelwagen.php" title="Bekijk uw winkelwagen">
                <img class="wagen" src="../images/winkelwagen_icon.png" alt="Winkelwagen" width="42" height="42">
                <img class="wagen_neon" src="../images/winkelwagen_icon_neon.png" alt="Winkelwagen_neon" width="42" height="42">
            </a>
        </div>
        <?php
            if(isset($_COOKIE['email'])) {
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
            </div>
        <?php
            }
        ?>
    </div>
</header>

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

    <section id="block">
        <div class="wrapper">
            <span class="close-icon">
                <i class='bx bx-x'></i>
            </span>

            <div class="form-box login">
                <form action="../logic/loginB.php" method="post">
                    <h1> Login </h1>
                    <div class="input-box">
                        <input type="text" placeholder="username" required >
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" required >
                        <i class='bx bxs-lock-alt' ></i>
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
                        <i class='bx bx-envelope' ></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" required name="passwordlogin">
                        <i class='bx bxs-lock-alt' ></i>
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
        </div>
    </section>

    <section>
        <h2>Ons Team</h2>
        <div class="persoon-cards">
            <div class="persoon-card">
                <div class="persoon-image">
                    <img src="../images/Hieu_web.jpg" alt="Hieu Phan">
                </div>
                <div class="card-content">
                    <h3>Hieu Phan:</h3>
                    <p>Leerling en 's werelds eerste Covid 19 patiënt</p>
                </div>
            </div>

            <div class="persoon-card">
                <div class="persoon-image">
                    <img src="../images/Danyaal_web.jpeg" alt="Danyaal Burney">
                </div>
                <div class="card-content">
                    <h3>Danyaal Burney:</h3>
                    <p>Baas van Hieu/ervaren webontwikkelaar</p>
                </div>
            </div>

            <div class="persoon-card">
                <div class="persoon-image">
                    <img src="../images/Shahzaib_web.jpg" alt="Shahzaib Saleem">
                </div>
                <div class="card-content">
                    <h3>Shahzaib Saleem:</h3>
                    <p>Gecertificeerde Hieu hater/ervaren webontwikkelaar</p>
                </div>
            </div>

            <div class="persoon-card">
                <div class="persoon-image">
                    <img src="../images/Wiljan_web.jpg" alt="Wiljan Verhoeven">
                </div>
                <div class="card-content">
                    <h3>Wiljan Verhoeven:</h3>
                    <p>Lead Developer/Alleskunner</p>
                </div>
            </div>

            <div class="persoon-card">
                <div class="persoon-image">
                    <img src="../images/Alex_web.jpg" alt="Alexander Dijkhuizen">
                </div>
                <div class="card-content">
                    <h3>Alexander Dijkhuizen:</h3>
                    <p>Aangewezen project leider. (Scrum master van niks.)</p>
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