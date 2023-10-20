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

<<body onload="changeImage('https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177670?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720')">>
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

<div class="product-container">
    <div class="product-images">
        <img id="mainImage" src="https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177670?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720" alt="Product Image 1">
        <div class="thumbnail-container">
            <img onclick="changeImage('https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177670?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720', width=37.89, height=50.521)" src="https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177670?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720" alt="Thumbnail 1">
            <img onclick="changeImage('https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177671?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720', width=37.89, height=50.521)" src="https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177671?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720" alt="Thumbnail 2">
            <img onclick="changeImage('https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177669?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720' , width=37.89, height=50.521)" src="https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177669?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720" alt="Thumbnail 3">
        </div>
    </div>
    <script>
        function changeImage(imageSrc) {
            document.getElementById('mainImage').src = imageSrc;
        }
    </script>

    <section id="productinformatie" class="productinformatie">

        <div class="bottom">

        <div class="product-details">
        <div class="product-name">Productnaam</div>
        <div class="product-description">Korte beschrijving van het product.</div>
        <div class="product-info">
            <p>Kleur: Blauw</p>
            <p>Grootte: Medium</p>
        </div>
        <div class="product-price">€99.99</div>
        <div class="product-variants">
            <label for="color">Kies een kleur:</label>
            <select id="color">
                <option value="blauw">Blauw</option>
                <option value="rood">Rood</option>
                <option value="groen">Groen</option>
            </select>
        </div>
        <button class="add-to-cart">Toevoegen aan winkelwagen</button>
        <div class="availability">Beschikbaarheid: Op voorraad</div>
    </div>
    </section>
</div>

<div class= "productbeschrijving">
    <h2>Gedetailleerde Productinformatie</h2>
    <ul>
        <li>Afmetingen: [B x H x D]</li>
        <li>Gewicht: [Gewicht van het product]</li>
        <li>Materiaal: [Materiaal van het product]</li>
        <li>Kleur: [Beschikbare kleuren]</li>
        <li>Batterijduur: [Indien van toepassing]</li>
    </ul>

    <!-- Voeg hier technische gegevens en beschikbare varianten toe -->
</div>

<div class= "productreviews">
    <h2>Klantbeoordelingen</h2>
    <!-- Voeg hier klantbeoordelingen en feedbacksectie toe -->
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
        <a style="color: #fff" ; href="../index.php">Home</a>
        <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
        <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
        <a style="color: #fff"; href="../pages/account.php">Account</a>
        <a style="color: #fff"; href="../pages/legal.php">Legaal</a>
    </div>
</footer>

</body>
</html>