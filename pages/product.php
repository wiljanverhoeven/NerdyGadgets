<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    require '../dbconnect.php';

    $query2 = 'SELECT * FROM producten WHERE productid = "'.$_GET['product'].'"';
    $result2 = mysqli_query($conn, $query2);
    $pro = mysqli_fetch_assoc($result2);
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Product</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/product.css">
</head>

<body>
<header>
    <div class="logo">
        <a href="../index.php">
            <img src="../images/NerdyGadgets_logo 5.png" alt="Logo"  width="250" height="90">
        </a>
    </div>


    <div>
        <input class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">

        <button class="btn btn-primary searchSubmit" type="submit"> <img src="../images/zoeken_icon.png" alt="Winkelwagen"  width="15.5" height="15.5">

    </div>

    <nav>
        <ul>
            <li><a href="../index.php" class="paginas">Home</a></li>
            <li><a href="over-ons.php" class="paginas">Over ons</a></li>
            <li><a href="producten.php" class="paginas">Producten</a></li>
        </ul>
    </nav>

    <div class="icons">
    <div class="cart">
        <a href="winkelwagen.php">
            <img class="wagen" src="../images/winkelwagen_icon.png" alt="Winkelwagen"  width="42" height="42">
            <img class="wagen_neon" src="../images/winkelwagen_icon_neon.png" alt="Winkelwagen_neon"  width="42" height="42">
        </a>
    </div>

    <div class="account">
        <a href="account.php">
            <img class="user" src="../images/account_icon.png" alt="Account"  width="40" height="40">
            <img class="user_neon" src="../images/account_icon_neon.png" alt="Account"  width="40" height="40">
        </a>
    </div>
    </div>

</header>

<div class="main">

<section id="product-images">
        <!-- Voeg hier meerdere afbeeldingen en video's toe -->
        <img src="link_naar_afbeelding1.jpg" alt="Afbeelding 1">
        <img src="link_naar_afbeelding2.jpg" alt="Afbeelding 2">
        <!-- Voeg hier de video toe -->
        <iframe width="560" height="315" src="link_naar_video" frameborder="0" allowfullscreen></iframe>
    </section>

<section class="section product-block">
    <div  class="product">
        <img src="<?php echo "../images/",$pro['imagesrc'];?>" alt="product">
        <img src="<?php echo "../images/",$pro['imagesrc'];?>" alt="product">
        <iframe width="560" height="315" src="link_naar_video" frameborder="0" allowfullscreen></iframe>
        <div class="product-box">
            <h3><?= $pro['productnaam'] ?></h3>
            <p><?= $pro['productinformatie'] ?></p>
            <h1><?= $pro['prijs'] ?></h1>
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    </div>
    <div class="aanraders">
        <div class="product2">
            <a href="../pages/product.php"><img src="../images/product.png" alt="Product 1"></a>
            <h3>Product 1</h3>
            <p>Beschrijving van Product 1 en prijs hier.</p>
            <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    
        <div class="product2">
            <a href="../pages/product.php"><img src="../images/product.png" alt="Product 2"></a>
            <h3>Product 2</h3>
            <p>Beschrijving van Product 2 en prijs hier.</p>
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    
        <div class="product2">
            <a href="../pages/product.php"><img src="../images/product.png" alt="Product 3"></a>
            <h3>Product 3</h3>
            <p>Beschrijving van Product 3 en prijs hier.</p>
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    </div>
    
    <section id="productdetails">
        <h2>Gedetailleerde Productinformatie</h2>
        <ul>
            <li><strong>Afmetingen:</strong> [B x H x D]</li>
            <li><strong>Gewicht:</strong> [Gewicht van het product]</li>
            <li><strong>Materiaal:</strong> [Materiaal van het product]</li>
            <li><strong>Kleur:</strong> [Beschikbare kleuren]</li>
            <li><strong>Batterijduur:</strong> [Indien van toepassing]</li>
        </ul>

        <!-- Voeg hier technische gegevens en beschikbare varianten toe -->
    </section>

    <section id="productreviews">
        <h2>Klantbeoordelingen</h2>
        <!-- Voeg hier klantbeoordelingen en feedbacksectie toe -->
    </section>

</section>



</div>
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
                    <img src="images/icon-mastercard.png" width="64.2" height="40" >
                    <img src="images/IDEAL_Logo.png" width="46" height="40" >
                    <img src="images/icon-visa.png" width="64.2" height="40" >
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

</body>
</html>