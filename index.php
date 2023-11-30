<!DOCTYPE html>
<html lang="nl">

<head>

    <?php
        //haalt informatie van bijnodigde bestanden op
        require 'dbconnect.php';

        session_start();
        $appel = "";
     ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Home</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="styling/basic-style.css">
    <link rel="stylesheet" href="styling/homepage.css">
    <link rel="stylesheet" href="styling/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    

</head>

<body>
<header>
    <div class="logo">
        <a href="index.php">
            <img src="images/NerdyGadgets_logo 5.png" alt="Logo"  width="250" height="90">
        </a>
    </div>


    <div id="search">
        <form action="pages/search.php" method="POST">
            <input  class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">
            <button  class="btn btn-primary searchSubmit" type="submit"> <img src="images/zoeken_icon.png" alt="Winkelwagen"  width="15.5" height="15.5">
        </form>
    </div>

    <nav>
        <ul>
            <li><a href="index.php" class="paginas" title="Ga naar de homepagina">Home<span class="tooltiptext"></span></a></li>
            <li><a href="pages/over-ons.php" class="paginas" title="Meer informatie over ons">Over ons<span class="tooltiptext"></span></a></li>
            <li><a href="pages/productoverzicht.php" class="paginas" title="Bekijk onze producten">Producten<span class="tooltiptext"></span></a></li>
        </ul>
    </nav>

    <div class="icons">
        <div class="cart">
            <a href="winkelwagen.php" title="Bekijk uw winkelwagen">
                <img class="wagen" src="images/winkelwagen_icon.png" alt="Winkelwagen" width="42" height="42">
                <img class="wagen_neon" src="images/winkelwagen_icon_neon.png" alt="Winkelwagen_neon" width="42" height="42">
            </a>
        </div>
        <?php 
            if(isset($_COOKIE['email'])) {
                ?>  
                    <nav>
                    <div class="account">
                        <a class="paginas" title="ga naar uw account" href="pages/logout.php">log uit</a>
                    </div>
                    </nav>
                 <?php
            } else { 
                ?>  
                    <div class="account">
                    <a class="btnlogin-popup"><img class="user" src="images/account_icon.png" alt="Account" width="40" height="40">
                    <img class="user_neon" src="images/account_icon_neon.png" alt="Account" width="40" height="40"> </a>
                    </a>
                    </div>
                    
                <?php
            } 
        ?>
        
    </div>
</div>

</header>




<section id="block">
<div class="wrapper">
    <span class="close-icon">
        <i class='bx bx-x'></i>
    </span>

    <div class="form-box login">
    <form action="pages/login.php" method="post">
    <h1> Login </h1>
        <div class="input-box">
            <input type="text" placeholder="email" name="mail" required >
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" name="pass" required >
            <i class='bx bxs-lock-alt' ></i>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox" name="remember"> remember me</label>
            <a href="#"> Forgot password</a>
        </div>

        <button type="submit" name="apply" class="btn">login</button>
        <div class="register-login">
            <a href="pages/register.php">register</a>
            <p>Dont't have a account?<a href="#" class="register-link"> Register</a></p>
        </div>


    </form>
</div>
    <div class="form-box register">

        <form action="pages/login.php" method="post">
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
</section>

<script src="logic/script.js"></script>

<div class="main">
<section id="home" class="section">
    <div class="welkom">
        <h1 class="WNG">Welkom bij NerdyGadgets</h1>
        <p class="slogan" behavior="scroll" direction="left"><?php
$strings = array('Ontdek geweldige producten voor de beste prijzen!', 'Eenvoudige navigatie om snel te vinden wat u zoekt!', 'Veilige betalingsmogelijkheden voor uw gemoedsrust!', 'Snelle levering om uw producten op tijd te ontvangen!', 'Niet tevreden met uw product? Geld terug!', 'Wij behandelen de recensies van onze klanten als feedback!', 'Het vertrouwen van de klant is voor ons het belangrijkst!');
echo $strings[array_rand($strings)];?>
    </div>
    <img id="scrollBtn" src="images/arrow.png">
</section>

  

  <script >
;(()=>{
   var lastPos = 0;
   var scrollToPos = 800;

   scrollBtn.addEventListener("click", () => {
       window.scrollTo({
           top: scrollToPos,
           behavior: 'smooth'
       });
   });

   addEventListener("scroll", () => {
      
   }, false);
})();
</script>

<section id="aanbevolen_producten" class="section products">
    
    <h1>Onze aanbevolen producten</h1>

    <?php

    if(empty($_SESSION['search'])) {
        for ($i = 0;$i < 3; $i++) {
            $sql = "SELECT * FROM producten WHERE productid=$i";
            $prod = mysqli_query($conn, $sql);
            ${"producten$i"} = mysqli_fetch_assoc($prod); ?>
        <div class="product ">
            <a href="pages/product.php?product=<?php echo ${"producten$i"}['productid']; ?>"><img height="200px" src="<?php echo "images/",${"producten$i"}['imagesrc']; ?>" alt="Product 1"></a>
            <h3><?php echo ${"producten$i"}["productnaam"]; ?></h3>
            <p><?php echo "€",${"producten$i"}["prijs"]; ?></p>
            <p><?php echo ${"producten$i"}["productinformatie"]; ?></p>
            <button class="add-to-cart" name="toevoegen" value="<?php echo ${"producten$i"}["productid"]; ?>">Voeg toe aan winkelwagen</button>
        </div>
<?php } } else {
            $appel = $_SESSION['search'];
        }
    
    $used = 0;
    
    if ($appel != null) { 
            $sql = 'SELECT * FROM producten WHERE productnaam LIKE "%' . $appel . '%" OR categorie LIKE "%' . $appel . '%" ';
            if ($result = mysqli_query($conn, $sql)) {
                
                for ($i = 0; $i < 3; $i++) {
                    $row = mysqli_fetch_row($result);
                    if ($row != null) { ?>
                        <div class="product">
                            <a href="pages/product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "images/",$row[5]; ?>" alt="Product"></a>
                            <h3><?php echo $row[1]; ?></h3>
                            <p><?php echo "€",$row[3]; ?></p>
                            <p><?php echo $row[8]; ?></p>
                            <button class="add-to-cart" name="toevoegen" value=" <?php echo $row[0]; ?>" >Voeg toe aan winkelwagen</button>
                        </div>
<?php   
        $cata = $row[4]; 
        $pid = $row[0];    
        } elseif ($row == null){
        $sql2 = 'SELECT * FROM producten WHERE categorie LIKE "%' . $cata . '%" AND NOT productid = '.$pid.' AND NOT productid = '.$used.' ';
                if ($result2 = mysqli_query($conn, $sql2)) {
                        $row2 = mysqli_fetch_row($result2);
                        $used = $row2[0];
?>
                        <div class="product">
                            <a href="pages/product.php?product=<?php echo $row2[0]; ?>"><img height="200px" src="<?php echo "images/",$row2[5]; ?>" alt="Product"></a>
                            <h3><?php echo $row2[1]; ?></h3>
                            <p><?php echo "€",$row2[3]; ?></p>
                            <p><?php echo $row2[8]; ?></p>
                            <button class="add-to-cart" name="toevoegen" value=" <?php echo $row2[0]; ?>" >Voeg toe aan winkelwagen</button>
                        </div>
<?php } } } } } ?>



</section>

<section id="bottom" class="section">

    <div class="bottom">

    <div class="contact">
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
    </div>
    
        <div class="recensies">
        <h2>Klantrecensies</h2>
        <div>
        <h3>Lees hieronder de ervaringen van andere klanten</h3>
        <h3>met betrekking tot onze producten en service.</h3> 
        <h3>Sorteer op relevantie, datum of waardering.</h3>
        </div>
       <a href="pages/klantrecensies.php">
            <button class="submit-button" onclick="">Bekijk Klantrecensies</button>
        </a>
        </div>
    </div>
</section>

<section id="winkelervaring" class="section">
    <div class="section-content">

<br>

</section>

</div>

<footer>

<div class="inhoudFooter">
    <div class="contactgegevens">
        <h3 style="color: #fff" ;>Contactgegevens</h3>
        <p style="color: #fff" ;>
            Adres: Hospitaaldreef 5, Almere
            <br>
            Email: administratie@nerdygadgets.nl
            <br>
            Telefoonnummer: +31 6 12345678
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
        <a style="color: #fff" ; href="../index.php">Home</a>
        <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
        <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
        <a style="color: #fff"; href="../pages/account.php">Account</a>
        <a style="color: #fff"; href="../pages/legal.php">Legaal</a>
    </div>
</footer>