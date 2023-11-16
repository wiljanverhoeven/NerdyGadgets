<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Over Ons | NerdyGadgets</title>
    <link rel="icon" type="image/png" href="../images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">

</head>
<body>
    <header>
        <div class="logo">
            <a href="../index.php">
                <img src="../images/NerdyGadgets_logo 5.png" alt="Logo" width="250" height="90">
            </a>
        </div>

        <div>
            <input class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">
            <button class="btn btn-primary searchSubmit" type="submit"> <img src="../images/zoeken_icon.png" alt="Zoeken" width="15.5" height="15.5">
            </button>
        </div>

        <nav>
            <ul>
                <li><a href="../index.php" class="paginas" title="Ga naar de homepagina">Home<span class="tooltiptext"></span></a></li>
                <li><a href="../pages/over-ons.php" class="paginas current" title="Meer informatie over ons">Over ons<span class="tooltiptext"></span></a></li>
                <li><a href="producten.php" class="paginas" title="Bekijk onze producten">Producten<span class="tooltiptext"></span></a></li>
            </ul>
        </nav>

        <div class="icons">
        <div class="cart">
            <a href="winkelwagen.php" title="Bekijk uw winkelwagen">
                <img class="wagen" src="../images/winkelwagen_icon.png" alt="Winkelwagen" width="42" height="42">
                <img class="wagen_neon" src="../images/winkelwagen_icon_neon.png" alt="Winkelwagen_neon" width="42" height="42">
            </a>
        </div>
        <div class="account">
            <a href="account.php" title="Ga naar uw account">
                <img class="user" src="../images/account_icon.png" alt="Account" width="40" height="40">
                <img class="user_neon" src="../images/account_icon_neon.png" alt="Account" width="40" height="40">
            </a>
        </div>
        </div>
    </header>

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
    </footer>