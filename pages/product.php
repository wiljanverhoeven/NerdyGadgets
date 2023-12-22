<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    require '../dbconnect.php';

    session_start();

    $query2 = 'SELECT * FROM producten WHERE productid = "' . $_GET['product'] . '"';
    $result2 = mysqli_query($conn, $query2);
    $pro = mysqli_fetch_assoc($result2);
    $id = $_GET['product'];
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Product</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="../styling/product.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link rel="stylesheet" href="../styling/carts.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<<body onload="changeImage('https://assets.mmsrg.com/isr/166325/c1/-/ASSET_MMS_104177670?x=960&y=720&format=jpg&quality=80&sp=yes&strip=yes&trim&ex=960&ey=720&align=center&resizesource&unsharp=1.5x1+0.7+0.02&cox=0&coy=0&cdx=960&cdy=720')">>
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

    <div class="productbeschrijving">
        <h2>Productinformatie</h2>
        <ul>
            <li>Afmetingen: [B x H x D]</li>
            <li>Gewicht: [Gewicht van het product]</li>
            <li>Materiaal: [Materiaal van het product]</li>
            <li>Kleur: [Beschikbare kleuren]</li>
            <li>Batterijduur: [Indien van toepassing]</li>
        </ul>

        <!-- Voeg hier technische gegevens en beschikbare varianten toe -->
    </div>

    <div class="productreviews">
        <h2>Klantbeoordelingen</h2>
        <!-- Voeg hier klantbeoordelingen en feedbacksectie toe -->
    </div>
    <div class="aanraders">
        <div class="product2">
            <a href="../pages/product.php"><img src="../images/product.png" alt="Product 1"></a>
            <h3>Product 1</h3>
            <p>Beschrijving van Product 1 en prijs hier.</p>        
            <button class="add-to-cart">Voeg toe aan winkelwagen</button>
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

    <?php
                $sql = 'SELECT * FROM producten WHERE productid="'.$id.'" ';
                if ($result = mysqli_query($conn, $sql)) {
                    // Fetch one and one row
                    while ($row = mysqli_fetch_row($result)) {
            ?>
                        <div id="product">
                            <a href="product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/", $row[5]; ?>" alt="Product"></a>
                            <h3><?php echo $row[1]; ?></h3>
                            <p><?php echo "€", $row[3]; ?></p>
                            <p><?php echo $row[8]; ?></p> 

                            <h3><?php echo $row['productnaam']; ?></h3>
                <p>Price: €<?php echo $row['prijs']; ?></p>
                <p><?php echo $row['description']; ?></p>

                            <button class="add-to-cart" name="toevoegen" value=" <?php echo $row[0]; ?>">Voeg toe aan winkelwagen</button>
                        </div>

                    <?php  }} ?>

                    

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
                            <img src="images/icon-mastercard.png" width="64.2" height="40">
                            <img src="images/IDEAL_Logo.png" width="46" height="40">
                            <img src="images/icon-visa.png" width="64.2" height="40">
                        </a>
                    </ul>
                    We nemen ook strenge beveiligingsmaatregelen om ervoor te zorgen dat uw betalingen veilig worden verwerkt.
                    <br>
                    Copyright © 2023 NerdyGadgets Inc. Alle rechten voorbehouden.
                </h6>
            </div>

            <div class="links">
                <h3>Links</h3>
                <a style="color: #fff" ; href="../index.php">Home</a>
                <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
                <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
                <a style="color: #fff" ; href="../pages/account.php">Account</a>
                <a style="color: #fff" ; href="../pages/legal.php">Legaal</a>
            </div>
    </footer>

    </body>
    <script src="../logic/app.js"></script>
</html>