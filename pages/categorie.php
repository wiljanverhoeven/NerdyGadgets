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
    <link rel="stylesheet" href="../styling/categorie.css">
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
            <li><a href="../pages/over-ons.php" class="paginas">Over ons</a></li>
            <li><a href="../pages/productoverzicht.php" class="paginas">Producten</a></li>
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

<section class="main section">

<div class="producten section">
        
        <h2>Alle <?php echo $_GET['categorie']; ?></h2>
        <?php

           
        for ($i = 6;$i <= 6; $i++) {  
            $sql = 'SELECT * FROM producten WHERE categorie="'.$_GET['categorie'].'"';
                if ($result = mysqli_query($conn, $sql)) {
                    // Fetch one and one row
                    while ($row = mysqli_fetch_row($result)) {
                ?>
            <div id="product">
                <a href="product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/",$row[4]; ?>" alt="Product"></a>
                <h3><?php echo $row[1]; ?></h3>
                <p><?php echo "€",$row[2]; ?></p>
                <p><?php echo $row[3]; ?></p>
                <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
            </div>

        <?php } } }?>
</div>

</section>
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