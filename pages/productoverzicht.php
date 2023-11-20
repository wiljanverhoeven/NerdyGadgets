<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    require '../dbconnect.php';
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Producten</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/productoverzicht.css">
</head>

<body>
<header>
    <div class="logo">
        <a href="../index.php">
            <img src="../images/NerdyGadgets_logo 5.png" alt="Logo"  width="250" height="90">
        </a>
    </div>


    <div id="search">
        <form action="../pages/search.php" method="POST">
            <input  class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">
            <button  class="btn btn-primary searchSubmit" type="submit"> <img src="../images/zoeken_icon.png" alt="Winkelwagen"  width="15.5" height="15.5">
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

<div class="main section">

<section class="filters">
        <a href="categorie.php?categorie=spelcomputers"><img class="filter" height="200px" src="../images/spelcomputers.JPEG" alt="spelcomputers"></a>
        <a href="categorie.php?categorie=onderdelen"><img class="filter" height="200px" src="../images/onderdelen.JPEG" alt="onderdelen"></a>   
        <a href="categorie.php?categorie=gadgets"><img class="filter" height="200px" src="../images/gadgets.JPEG" alt="gadgets"></a>

</section>

<section class="producten">
    <div class="sliders">
    <div id="slide1">
        <h2>Aanbevolen producten</h2>
    <div id="slider">
        <?php
        for ($i = 1;$i <= 4; $i++) {
                $sql = "SELECT * FROM producten WHERE productid=$i";
                $prod = mysqli_query($conn, $sql);
                ${"producten$i"} = mysqli_fetch_assoc($prod); ?>
            <div class="product ">
                <a href="product.php?product=<?php echo ${"producten$i"}['productid']; ?>"><img height="200px" src="<?php echo "../images/",${"producten$i"}['imagesrc']; ?>" alt="Product 1"></a>
                <h3><?php echo ${"producten$i"}["productnaam"]; ?></h3>
                <p><?php echo "€",${"producten$i"}["prijs"]; ?></p>
                <p><?php echo ${"producten$i"}["productinformatie"]; ?></p>
                <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
            </div>

        <?php } ?>
        </div>
        </div>
        <div id="slide2">
        <h2>Nieuwe producten</h2>
        <div id="slider">
        <div class="product">
            <a href="pages/product.php"><img height="200px" src="../images/product.png" alt="Product "></a>
                <h3>Product </h3>
            <p>Beschrijving van Product en prijs hier.</p>
            <button class="add-to-cart" >Voeg toe aan winkelwagen</button>
        </div>
        <div class="product">
            <a href="pages/product.php"><img height="200px" src="../images/product.png" alt="Product "></a>
                <h3>Product </h3>
            <p>Beschrijving van Product en prijs hier.</p>
            <button class="add-to-cart" >Voeg toe aan winkelwagen</button>
        </div>
        <div class="product">
            <a href="pages/product.php"><img height="200px" src="../images/product.png" alt="Product "></a>
                <h3>Product </h3>
            <p>Beschrijving van Product en prijs hier.</p>
            <button class="add-to-cart" >Voeg toe aan winkelwagen</button>
        </div>
        <div class="product">
            <a href="pages/product.php"><img height="200px" src="../images/product.png" alt="Product "></a>
                <h3>Product</h3>
            <p>Beschrijving van Product en prijs hier.</p>
            <button class="add-to-cart" >Voeg toe aan winkelwagen</button>
        </div>
        </div>
        </div>
        </div>
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
        <a style="color: #fff" ; href="../index.php">Home</a>
        <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
        <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
        <a style="color: #fff"; href="../pages/account.php">Account</a>
        <a style="color: #fff"; href="../pages/legal.php">Legaal</a>
    </div>
</footer>

</body>
</html>