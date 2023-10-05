<!DOCTYPE html>
<html lang="nl">

<head>

    <?php
        require 'dbconnect.php';

        for ($i = 1;$i <= 3; $i++) {
            $query = "SELECT * FROM producten WHERE productid=$i";
            $result = mysqli_query($conn, $query);

            if ($i == 1) {
                $awnser1 = mysqli_fetch_assoc($result);
                $naam1 = $awnser1['productnaam'];
                $info1 = $awnser1['productinformatie'];
            } elseif ($i == 2){
                $awnser2 = mysqli_fetch_assoc($result);
                $naam2 = $awnser2['productnaam'];
                $info2 = $awnser2['productinformatie'];
            } else {
                $awnser3 = mysqli_fetch_assoc($result);
                $naam3 = $awnser3['productnaam'];
                $info3 = $awnser3['productinformatie'];
            }
        };
     ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets</title>
    <link rel="stylesheet" href="styling/basic-style.css">
    <link rel="stylesheet" href="styling/homepage.css">
</head>

<body>
<header>
    <div class="logo">
        <a href="index.html">
            <img src="images/NerdyGadgets_logo.png" alt="Logo"  width="228" height="114">
        </a>
    </div>


    <div>
        <input class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">        

        <button class="btn btn-primary searchSubmit" type="submit"> <img src="images/zoeken_icon.png" alt="Winkelwagen"  width="15.5" height="15.5">

    </div>


    
    <nav>
        <ul>
            <li><a href="index.html" class="paginas">Home</a></li>
            <li><a href="over-ons.html" class="paginas">Over ons</a></li>
            <li><a href="producten.html" class="paginas">Producten</a></li>
        </ul>
    </nav>

    <div class="cart">
        <a href="winkelwagen.html">
            <img class="wagen" src="images/winkelwagen_icon.png" alt="Winkelwagen"  width="40" height="40">
            <img class="wagen_neon" src="images/winkelwagen_icon_neon.png" alt="Winkelwagen_neon"  width="40" height="40">
        </a>
    </div>

</header>

<section id="home" class="section">

    <h2>Welkom bij NerdyGadgets</h2>
    <marquee class="slidein" behavior="scroll" direction="left">Ontdek geweldige producten voor de beste prijzen.</marquee>

</section>

<section id="aanbevolen products" class="section products">

    <h2>Onze aanbevolen producten</h2>

    <div class="product">
        <a href="pages/product.php?product=<?php $product = $awnser1; echo $product['productid']; ?>"><img height="200px" src="<?php echo $awnser1['imagesrc']; ?>" alt="Product 1"></a>
        <h3><?= $naam1 ?></h3>
        <p><?= $info1 ?></p>
        <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
    </div>

    <div class="product">
        <a href="pages/product.php?product=<?php $product = $awnser2; echo $product['productid']; ?>"><img height="200px" src="images/product.png" alt="Product 2"></a>
        <h3><?= $naam2 ?></h3>
        <p><?= $info2 ?></p>
        <button class="add-to-cart">Voeg toe aan winkelwagen</button>
    </div>

    <div class="product">
    <a href="pages/product.php?product=<?php $product = $awnser3; echo $product['productid']; ?>"><img height="200px" src="images/product.png" alt="Product 3"></a>
        <h3><?= $naam3 ?></h3>
        <p><?= $info3 ?></p>
        <button class="add-to-cart">Voeg toe aan winkelwagen</button>
    </div>

    <div class="product">
        <a href="pages/product.html"><img height="200px" src="images/product.png" alt="Product 4"></a>
        <h3>Product 4</h3>
        <p>Beschrijving van Product 4 en prijs hier.</p>
        <button class="add-to-cart">Voeg toe aan winkelwagen</button>
    </div>

    <div class="product">
        <a href="pages/product.html"><img height="200px" src="images/product.png" alt="Product 5"></a>
        <h3>Product 5</h3>
        <p>Beschrijving van Product 5 en prijs hier.</p>
        <button class="add-to-cart">Voeg toe aan winkelwagen</button>
    </div>

    <div class="product">
        <a href="pages/product.html"><img height="200px" src="images/product.png" alt="Product 6"></a>
        <h3>Product 6</h3>
        <p>Beschrijving van Product 6 en prijs hier.</p>
        <button class="add-to-cart" >Voeg toe aan winkelwagen</button>
    </div>



</section>

<section id="contact" class="section">

    <h2>Contacteer ons</h2>

    <form>
        <label for="naam">Naam:</label>
        <input class="input"  type="text" id="naam" name="naam" required>
        <label for="email">E-mail:</label>
        <input  class="input"  type="email" id="email" name="email" required>
        <label for="bericht">Bericht:</label>
        <textarea class="input" id="bericht" name="bericht" rows="4" required></textarea>
        <button class="submit-button" type="submit">Verstuur</button>
    </form>

</section>

<section id="klantrecensies" class="section">
    <div class="section-content">
        <h2>Klantrecensies</h2>
        <p>Lees hieronder de ervaringen van andere klanten met betrekking tot onze producten en service. Sorteer op relevantie, datum of waardering.</p>
       <a href="pages/klantrecensies.html">
            <button class="submit-button" onclick="">Bekijk Klantrecensies</button>
        </a>
    </div>
</section>

<section id="winkelervaring" class="section">
    <div class="section-content">
        <h2>Verbeter uw winkelervaring bij NerdyGadgets</h2>
        <p>We streven naar de beste winkelervaring voor onze klanten. Bij NerdyGadgets garanderen wij:</p>
        <ul id="list">
            <li>Klantrecensies voor echte feedback</li>
            <li>Eenvoudige navigatie om snel te vinden wat u zoekt</li>
            <li>Veilige betalingsmogelijkheden voor uw gemoedsrust</li>
            <li>Snelle levering om uw producten op tijd te ontvangen</li>
        </ul>
    </div>


    

<br>



    <h2>Veilige betalingsmogelijkheden</h2>
    <p>Bij NerdyGadgets bieden wij diverse betalingsmogelijkheden aan om uw betalingservaring veilig en vertrouwd te maken:</p>
    <ul id="list">
    <div class="betaalmiddelen">
            <a>
                <img src="images/icon-mastercard.png" width="90" height="56" >
                <img src="images/IDEAL_Logo.png" width="64.4" height="56" >
                <img src="images/icon-visa.png" width="90" height="56" >
            
            </a>
        </ul>
    <p>We nemen ook strenge beveiligingsmaatregelen om ervoor te zorgen dat uw betalingen veilig worden verwerkt en om het vertrouwen van onze klanten te vergroten.</p>
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