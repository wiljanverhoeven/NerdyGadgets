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
    <title>NerdyGadgets</title>
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/product.css">
</head>

<body>
<header>
    <div class="logo">
        <a href="../index.php">
            <img src="../images/NerdyGadgets_logo.png" alt="Logo"  width="228" height="114">
        </a>
    </div>


    <div>
        <input class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">        

        <button class="btn btn-primary searchSubmit" type="submit"> <img src="../images/zoeken_icon.png" alt="Winkelwagen"  width="15.5" height="15.5">

    </div>

    <nav>
        <ul>
            <li><a href="../index.html" class="paginas">Home</a></li>
            <li><a href="../over-ons.html" class="paginas">Over ons</a></li>
            <li><a href="../producten.html" class="paginas">Producten</a></li>
        </ul>
    </nav>

    <div class="cart">
        <a href="../winkelwagen.html">
            <img class="wagen" src="../images/winkelwagen_icon.png" alt="Winkelwagen"  width="40" height="40">
            <img class="wagen_neon" src="../images/winkelwagen_icon_neon.png" alt="Winkelwagen_neon"  width="40" height="40">
        </a>
    </div>

</header>

<section class="section product-block">
    <div  class="product">
        <img src="../<?php echo $pro['imagesrc'];?>" alt="product">
        <div class="product-box">
            <h3><?= $pro['productnaam'] ?></h3>
            <p><?= $pro['productinformatie'] ?></p>
            <h1><?= $pro['prijs'] ?></h1>
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    </div>
    <div class="aanraders">
        <div class="product2">
            <a href="../pages/product.html"><img src="../images/product.png" alt="Product 1"></a>
            <h3>Product 1</h3>
            <p>Beschrijving van Product 1 en prijs hier.</p>
            <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    
        <div class="product2">
            <a href="../pages/product.html"><img src="../images/product.png" alt="Product 2"></a>
            <h3>Product 2</h3>
            <p>Beschrijving van Product 2 en prijs hier.</p>
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    
        <div class="product2">
            <a href="../pages/product.html"><img src="../images/product.png" alt="Product 3"></a>
            <h3>Product 3</h3>
            <p>Beschrijving van Product 3 en prijs hier.</p>
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
        </div>
    </div>
    
</section>




<footer>

    <div class="copyrights">
        <p>Copyright © 2023 NerdyGadgets Inc. Alle rechten voorbehouden.</p>
    </div>

    <div class="geg">
        <h2>Contactgegevens</h2>
        <p>Adres: Hospitaaldreef 5, 1315 RC Almere</p>
        <p>Email: administratie@nerdygadgets.nl</p>
        <p>Telefoon: 036-1234567</p>
    </div>

    <div class="makers">

        <h2>Makers</h2>

        <ul id="list">
            <li>Alexander Dijkhuizen</li>
            <li>Danyaal Burney</li>
            <li>Hieu Phan</li>
            <li>Shahzaib Saleem</li>
            <li>Wiljan Verhoeven</li>
        </ul>

    </div>

</footer>
</body>
</html>