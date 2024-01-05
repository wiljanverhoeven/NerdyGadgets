<!DOCTYPE html>
<html lang="nl">

<head>

    <?php
    //haalt informatie van bijnodigde bestanden op
    require '../dbconnect.php';
    require '../logic/functions.php';

    session_start();
    $_SESSION['token'] = uniqid();
    $appel = "";
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Home</title>
    <link rel="icon" type="../image/png" href="../images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/carts.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../styling/recensie.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body class="">


    <div class="container2">
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
                    <li><a href="../index.php" class="paginas" title="Ga naar de homepagina">Home<span class="tooltiptext"></span></a></li>
                    <li><a href="../pages/over-ons.php" class="paginas" title="Meer informatie over ons">Over ons<span class="tooltiptext"></span></a></li>
                    <li><a href="../pages/productoverzicht.php" class="paginas" title="Bekijk onze producten">Producten<span class="tooltiptext"></span></a></li>
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
                </div>
            </div>
        </header>
    </div>
    <div class="cartTab" id="exampleList">
        <h1>Shopping Cart</h1>
        <div class="listCart">
            <?php
            if (isset($_POST['add'])) {
                if (!isset($_SESSION['cart'])) {
                    $_SESSION['cart'] = array();
                }

                $proid = $_POST['proid'];
                $item_exists = false;

                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['proid'] == $proid) {
                        // If the item already exists, update its quantity and exit the loop
                        $item['quantity'] += 1;
                        $item_exists = true;
                        break;
                    }
                }

                if (!$item_exists) {
                    // If the item does not exist, add it to the cart
                    $item_array = array(
                        'proid' => $proid,
                        'quantity' => 1,
                    );
                    $_SESSION['cart'][] = $item_array;
                }

                // Redirect to the same or a different page after processing the form
                header("Location: {$_SERVER['REQUEST_URI']}");
                exit;
            }
            if (!empty($_SESSION['cart'])) {
                if (isset($_POST['minus'])) {
                    $proid = $_POST['proid'];

                    // Store the index to unset after the loop
                    $index_to_unset = null;

                    foreach ($_SESSION['cart'] as $index => &$item) {
                        if ($item['proid'] == $proid) {
                            $item['quantity'] -= 1;

                            if ($item['quantity'] <= 0) {
                                // Set the index to unset after the loop
                                $index_to_unset = $index;
                            }

                            break;
                        }
                    }

                    // Unset the item if needed outside the loop
                    if ($index_to_unset !== null) {
                        unset($_SESSION['cart'][$index_to_unset]);
                    }
                }
            }
            if (!empty($_SESSION['cart'])) {
                $set = 0;
                foreach ($_SESSION['cart'] as $item) { 
                    $proid = $item['proid'];
                    $line = 'SELECT * FROM producten WHERE productid = ?';
                    $prepare = mysqli_prepare($conn, $line);
                    mysqli_stmt_bind_param($prepare, 'i', $proid);
                    mysqli_stmt_execute($prepare);
                    $end = mysqli_stmt_get_result($prepare);
                    if ($rows = mysqli_fetch_assoc($end)) { 
                        $set += $rows['prijs'] * $item['quantity'];
                    }
                }
                ?> <div class="name"><p>Totaal prijs: €<?php echo $set;?></p></div> <?php
            }
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $item) {
                    $proid = $item['proid'];

                    // Use prepared statement to fetch product information
                    $sql = 'SELECT * FROM producten WHERE productid = ?';
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, 'i', $proid);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="item">
                            <div class="image"><a href="../pages/product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "../images/", $row['imagesrc']; ?>" alt="Product"></a></div>
                            <div class="name"><?php echo $row['productnaam'];?><p><?php echo $item['quantity'];?>X</p></div>
                            <div class="totalprice">€<?php echo $row['prijs'] * $item['quantity']; ?></div>
                            <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
                                <input type="hidden" name="proid" value="<?php echo $proid; ?>">
                                <button type="submit" name="add">+</button>
                                <button type="submit" name="minus">-</button>
                            </form>
                        </div>
            <?php
                    }
                }
            } else {
                // Display a message or take other actions when the cart is empty
                echo "Your shopping cart is empty.";
            }

            ?>


        </div>
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
            <a href="pong_easter_egg.php" style="opacity: 0;" class="knopNaarPong">Ontzichtbare knop naar Pong easter egg</a>
                <form action="login.php" method="post">
                    <h1> Login </h1>
                    <div class="input-box">
                        <input type="text" placeholder="email" name="mail" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="pass" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <button type="submit" name="apply" class="btn">login</button>
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

</header>

<section id="review" class=""section>
    <div class="container">
        <div class="board">
            <h2 class="text-light">Onze reviews</h2>
            <p class="text-light">Top reviews</p>
            <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->               
                        <?php
                        $sql = "SELECT r.*, u.first_name, u.surname_prefix, u.surname
                        FROM recensies r
                        JOIN user u ON r.User_id = u.id
                        Where rating > 2
                        ORDER BY rating DESC";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0) {
                        while ($row3 = $result->fetch_assoc()) {
                        $product_id = $row3['Product_id'];
                        $inhoud = $row3['inhoud'];
                        $rating = $row3['rating'];
                        $name = $row3['first_name'] ." ". $row3['surname_prefix'] ." ". $row3['surname'];              
                        ?>                
                    <div class="swiper-slide">
                        <div class="flex">
                            <?php
                                if ($rating == 1) {
                                    echo "<span>&starf;&star;&star;&star;&star;</span>";
                                } else if ($rating == 2) {
                                    echo "<span>&starf;&starf;&star;&star;&star;</span>";
                                }else if ($rating == 3) {
                                    echo "<span>&starf;&starf;&starf;&star;&star;</span>";
                                }else if ($rating == 4) {
                                    echo "<span>&starf;&starf;&starf;&starf;&star;</span>";
                                }else if ($rating == 5) {
                                    echo "<span>&starf;&starf;&starf;&starf;&starf;</span>";
                                }
                            ?>
                            <div class="comments">
                                <p><?=$inhoud?></p>
                            </div>
                            <div class="profile">
                                <h4></h4><?=$name?></h4>
                            </div>
                         </div>
                    </div>
                    <?php
                    } }?>  
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

                <!-- If we need scrollbar -->
                <div class="swiper-scrollbar"></div>
            </div>
        </div>
    </div>

</section>


<section id="klantrecensies" class="section">

    <script>
        let reviews = [];

        // Dummy recensies (voorbeeld)
        const dummyReviews = [
            { review: "Goede service en snelle levering! Zal zeker weer bestellen.", rating: 5, date: "2023-10-02" },
            { review: "NerdyGadgets heeft een geweldig assortiment producten. Erg blij met mijn aankoop.", rating: 4, date: "2023-09-30" },
            // Voeg meer recensies toe zoals hierboven
        ];

        const reviewForm = document.getElementById('reviewForm');
        const reviewsContainer = document.getElementById('reviews');

        // Functie om recensies weer te geven
        function displayReviews() {
            reviewsContainer.innerHTML = '';
            reviews.forEach(review => {
                const reviewDiv = document.createElement('div');
                reviewDiv.classList.add('review');
                reviewDiv.innerHTML = `
                      <p>${review.review}</p>
                      <div class="review-info">
                          <span>Beoordeling: ${review.rating}/5</span>
                          <span>Geplaatst op: ${review.date}</span>
                      </div>
                  `;
                reviewsContainer.appendChild(reviewDiv);
            });
        }

        // Voeg event listener toe aan het formulier om een recensie te plaatsen
        reviewForm.addEventListener('submit', event => {
            event.preventDefault();
            const reviewText = document.getElementById('review').value;
            const rating = document.getElementById('rating').value;
            const currentDate = new Date().toISOString().split('T')[0]; // Vandaag's datum
            const newReview = { review: reviewText, rating: rating, date: currentDate };
            reviews.push(newReview);
            displayReviews(); // Update de weergave van recensies
            reviewForm.reset(); // Reset het formulier
        });

        // Laad de initiÃ«le recensies bij het laden van de pagina
        reviews = dummyReviews.slice(); // Kopieer de dummy recensies naar de reviews-array
        displayReviews();

        // Functie om recensies te sorteren op basis van geselecteerde optie
        function sortReviews() {
            const sortOption = document.getElementById('sort').value;

            if (sortOption === 'relevantie') {
                // Geen actie nodig, de volgorde is al zoals de recensies zijn toegevoegd
            } else if (sortOption === 'datum') {
                reviews.sort((a, b) => new Date(b.date) - new Date(a.date));
            } else if (sortOption === 'waardering') {
                reviews.sort((a, b) => b.rating - a.rating);
            }

            displayReviews(); // Update de weergave van recensies na sorteren
        }
    </script>
</section>

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
                    <img src="../images/icon-mastercard.png" width="64.2" height="40">
                    <img src="../images/IDEAL_Logo.png" width="46" height="40">
                    <img src="../images/icon-visa.png" width="64.2" height="40">
                </a>
            </ul>
            We nemen ook strenge beveiligingsmaatregelen om ervoor te zorgen dat uw betalingen veilig worden verwerkt.
            <br>
            Copyright © 2023 NerdyGadgets Inc. Alle rechten voorbehouden.
        </h6>
    </div>

    <div class="links">
        <a style="color: #fff" ; href="../index.php">Home</a>
        <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
        <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
        <a style="color: #fff" ; href="../pages/account.php">Account</a>
        <a style="color: #fff" ; href="../pages/legal.php">Legaal</a>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="../logic/main.js"></script>
</body>
<script src="../logic/app.js"></script>

</html>