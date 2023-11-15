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

    <link rel="stylesheet"href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</header>

<section class="outer main section">

<div class="producten section">
        
        <h2>Alle <?php echo $_GET['categorie']; ?></h2>
        <?php

        $sort = "";
        $order = "";
        
        if(isset($_POST['sort'])) {
            if(is_numeric($_POST['sort']) && $_POST['sort'] > 0) {
                $sort = $_POST['sort'];
                $_GET['categorie'];

                switch ($sort) {
                case 1:
                    $order = "ORDER BY datum DESC";
                    break;
                case 2: 
                    $order = "ORDER BY datum ASC";
                    break;
                case 3:
                    $order = "ORDER BY prijs ASC";
                    break;
                case 4:
                    $order = "ORDER BY prijs desc";
                    break;
                
                default :
            }
        }
    }

    
        if ($sort == NULL) {
            $sql = 'SELECT * FROM producten WHERE categorie="'.$_GET['categorie'].'"';
                if ($result = mysqli_query($conn, $sql)) {
                    // Fetch one and one row
                    while ($row = mysqli_fetch_row($result)) {
                ?>
            <div id="product">
                <a href="product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/",$row[5]; ?>" alt="Product"></a>
                <h3><?php echo $row[1]; ?></h3>
                <p><?php echo "€",$row[3]; ?></p>
                <p><?php echo $row[8]; ?></p>
                <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
            </div>

        <?php } } } elseif ($sort !== NULL) {
                
                    $sql = 'SELECT * FROM producten WHERE categorie="'.$_GET['categorie'].'" '. $order .'';
                        if ($result = mysqli_query($conn, $sql)) {
                            // Fetch one and one row
                            while ($row = mysqli_fetch_row($result)) {
                        ?>
                    <div id="product">
                        <a href="product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "../images/",$row[5]; ?>" alt="Product"></a>
                        <h3><?php echo $row[1]; ?></h3>
                        <p><?php echo "€",$row[3]; ?></p>
                        <p><?php echo $row[8]; ?></p>
                        <button  class="add-to-cart">Voeg toe aan winkelwagen</button>
                    </div>
            <?php } } }?>
</div>

<div id="filters"> 
    <div id="sorting">
    <form action="search.php?categorie=<?php echo $_GET['categorie']; ?>" method="post">
    <input type="text" name="search" placeholder="Waar zoek je naar?" />
    <br />
    <label>Sort by date descending</label>
    <input type="radio" name="sort" value="1" />
    <br />
    <label>Sort by date ascending</label>
    <input type="radio" name="sort" value="2" />
    <br />
    <label>Sort by price ascending</label>
    <input type="radio" name="sort" value="3" />
    <br />
    <label>Sort by price descending</label>
    <input type="radio" name="sort" value="4" />
    <br /><input type="submit" value="Apply" />
    </div>
</form>             

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