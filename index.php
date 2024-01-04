<!DOCTYPE html>
<html lang="nl">

<head>

    <?php
    //haalt informatie van bijnodigde bestanden op
    require 'dbconnect.php';

    session_start();
    $_SESSION['token'] = uniqid();
    $appel = "";
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Home</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="styling/basic-style.css">
    <link rel="stylesheet" href="styling/homepage.css">
    <link rel="stylesheet" href="styling/carts.css">
    <link rel="stylesheet" href="styling/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


</head>

<body class="">


    <div class="container2">
        <header>
            <div class="logo">
                <a href="index.php">
                    <img src="images/NerdyGadgets_logo 5.png" alt="Logo" width="250" height="90">
                </a>
            </div>


            <div id="search">
                <form action="pages/search.php" method="POST">
                    <input class="search-bar" type="text" name="keyword" autocomplete="off" placeholder="Waar zoek je naar?">
                    <button class="btn btn-primary searchSubmit" type="submit"> <img src="images/zoeken_icon.png" alt="Winkelwagen" width="15.5" height="15.5">
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

                <?php
                if (isset($_COOKIE['email'])) {
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
                            <div class="image"><a href="pages/product.php?product=<?php echo $row['productid']; ?>"><img height="100px" width="100px" src="<?php echo "images/", $row['imagesrc']; ?>" alt="Product"></a></div>
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
            <a href="pages/pong_easter_egg.php" style="opacity: 0;" class="knopNaarPong">Ontzichtbare knop naar Pong easter egg</a>
                <form action="pages/login.php" method="post">
                    <h1> Login </h1>
                    <div class="input-box">
                        <input type="text" placeholder="email" name="mail" required>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" placeholder="Password" name="pass" required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <div class="remember-forgot">
                        <label><input type="checkbox" name="remember"> remember me</label>
                        <a href="http://localhost/nerdygadgets-1/pages/memory.html"> Forgot password</a>
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

    <script src="logic/script.js"></script>

    <div class="main">
        <section id="home" class="section">
            <div class="welkom">
                <h1 class="WNG">Welkom bij NerdyGadgets</h1>
                <p class="slogan" behavior="scroll" direction="left"><?php
                                                                        $strings = array('Ontdek geweldige producten voor de beste prijzen!', 'Eenvoudige navigatie om snel te vinden wat u zoekt!', 'Veilige betalingsmogelijkheden voor uw gemoedsrust!', 'Snelle levering om uw producten op tijd te ontvangen!', 'Niet tevreden met uw product? Geld terug!', 'Wij behandelen de recensies van onze klanten als feedback!', 'Het vertrouwen van de klant is voor ons het belangrijkst!');
                                                                        echo $strings[array_rand($strings)]; ?>
            </div>
            <img id="scrollBtn" src="images/arrow.png">
        </section>



        <script>
            ;
            (() => {
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

            if (empty($_SESSION['search'])) {
                for ($i = 0; $i < 3; $i++) {
                    $sql = "SELECT * FROM producten WHERE productid=$i";
                    $prod = mysqli_query($conn, $sql);
                    ${"producten$i"} = mysqli_fetch_assoc($prod); ?>
                    <div class="product ">
                        <a href="pages/product.php?product=<?php echo ${"producten$i"}['productid']; ?>"><img height="200px" src="<?php echo "images/", ${"producten$i"}['imagesrc']; ?>" alt="Product 1"></a>
                        <h3><?php echo ${"producten$i"}["productnaam"]; ?></h3>
                        <p><?php echo "€", ${"producten$i"}["prijs"]; ?></p>
                        <p><?php echo ${"producten$i"}["productinformatie"]; ?></p>
                        <form method="get" action="pages/product.php">
                            <button class="add-to-cart" name="product" value="<?php echo ${"producten$i"}["productid"]; ?>">go to page</button>
                        </form>
                        <form method="post">
                            <input type="hidden" name="proid" value="<?php echo ${"producten$i"}["productid"]; ?>">
                            <button class="add-to-cart" name="add" value="<?php echo ${"producten$i"}["productid"]; ?>">Voeg toe aan winkelwagen</button>
                        </form>
                    </div>
                    <?php }
            } else {
                $appel = $_SESSION['search'];
            }

            $used = 0;

            if ($appel != null) {
                $sql = 'SELECT * FROM producten WHERE productnaam LIKE "%' . $appel . '%" OR categorie LIKE "%' . $appel . '%" or merk LIKE "%' . $appel . '%"';
                if ($result = mysqli_query($conn, $sql)) {

                    for ($i = 0; $i < 3; $i++) {
                        $row = mysqli_fetch_row($result);
                        if ($row != null) { ?>
                            <div class="product">
                                <a href="pages/product.php?product=<?php echo $row[0]; ?>"><img height="200px" src="<?php echo "images/", $row[5]; ?>" alt="Product"></a>
                                <h3><?php echo $row[1]; ?></h3>
                                <p><?php echo "€", $row[3]; ?></p>
                                <p><?php echo $row[8]; ?></p>
                                <form method="get" action="../pages.product.php">
                            <button class="add-to-cart" name="add" value="<?php echo $row[0]; ?>">go to page</button>
                        </form>
                                <form method="post">
                                    <input type="hidden" name="proid" value="<?php echo $row[0]; ?>">
                                    <button class="add-to-cart" name="add" value=" <?php echo $row[0]; ?>"> Voeg toe aan winkelwagen</button>
                                </form>
                            </div>
                            <?php
                            $cata = $row[4];
                            $pid = $row[0];
                        } elseif ($row == null) {
                            $sql2 = 'SELECT * FROM producten WHERE categorie LIKE "%' . $cata . '%" AND NOT productid = ' . $pid . ' AND NOT productid = ' . $used . ' ';
                            if ($result2 = mysqli_query($conn, $sql2)) {
                                $row2 = mysqli_fetch_row($result2);
                                $used = $row2[0];
                            ?>
                                <div class="product">
                                    <a href="pages/product.php?product=<?php echo $row2[0]; ?>"><img height="200px" src="<?php echo "images/", $row2[5]; ?>" alt="Product"></a>
                                    <h3><?php echo $row2[1]; ?></h3>
                                    <p><?php echo "€", $row2[3]; ?></p>
                                    <p><?php echo $row2[8]; ?></p>
                                    <form method="post">
                                        <input type="hidden" name="proid" value="<?php echo $row2[0]; ?>">
                                        <button class="add-to-cart" name="add" value=" <?php echo $row2[0]; ?>"> Voeg toe aan winkelwagen</button>
                                    </form>
                                </div>
            <?php }
                        }
                    }
                }
            } ?>

        </section>

        <section id="bottom" class="section">

            <div class="bottom">

                <div class="contact">
                    <h2>Contacteer ons</h2>
                    <form>
                        <label for="naam">Naam:</label>
                        <input class="input" type="text" id="naam" name="naam" required>
                        <label for="email">E-mail:</label>
                        <input class="input" type="email" id="email" name="email" required>
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
    <button style="opacity: 0;" id="easterEggButton">Geheime Knop</button>

<div id="easterEggQuiz" style="display: none;">
  <h2>Nerd Quiz</h2>
  <div id="questionContainer"></div>

  <button onclick="checkAnswers()">Indienen</button>
</div>

<div id="quizResult" style="display: none;">
  <h2>Resultaat</h2>
  <p id="resultText"></p>
</div>

<script>
  const questions = [
    {
      question: "Wat is de favoriete programmeertaal van een computer?",
      options: ["Java", "Binary", "C-sharp"],
      correctAnswer: "Binary"
    },
    {
      question: "Hoe lost een programmeur een gebroken hart op?",
      options: ["Met een algoritme", "Door de code te debuggen", "Door een nieuwe relatieklasse te maken"],
      correctAnswer: "Door de code te debuggen"
    },
    {
      question: "Hoe noem je een programmeur zonder koffie?",
      options: ["Ontnuchterd", "Slaperig", "Niet-gecompileerd"],
      correctAnswer: "Niet-gecompileerd"
    }
  ];

  let currentQuestion = null;

  document.getElementById('easterEggButton').addEventListener('click', function() {
    const questionContainer = document.getElementById('questionContainer');

    // Controleer of er al een vraag is weergegeven
    if (!currentQuestion) {
      currentQuestion = getRandomQuestion();
      displayQuestion(currentQuestion);
      document.getElementById('easterEggQuiz').style.display = 'block';
    }
  });

  function getRandomQuestion() {
    return questions[Math.floor(Math.random() * questions.length)];
  }

  function displayQuestion(question) {
    const questionContainer = document.getElementById('questionContainer');
    questionContainer.innerHTML = `<p>${question.question}</p>`;

    question.options.forEach((option, index) => {
      questionContainer.innerHTML += `<input type="radio" name="question" value="${option}"> ${option}<br>`;
    });
  }

  function checkAnswers() {
    const selectedAnswer = document.querySelector('input[name="question"]:checked');
    const resultText = document.getElementById('resultText');

    if (selectedAnswer && selectedAnswer.value === currentQuestion.correctAnswer) {
      const discountCode = generateDiscountCode();
      resultText.innerHTML = `Gefeliciteerd! Je hebt een kortingscode van 15% ontvangen: ${discountCode}`;
    } else {
      resultText.innerHTML = 'Helaas, probeer het opnieuw voor de easter egg-expertstatus.';
    }

    document.getElementById('quizResult').style.display = 'block';
    document.getElementById('easterEggQuiz').style.display = 'none';
  }

  function generateDiscountCode() {
    // Hier kun je een functie toevoegen om een willekeurige kortingscode te genereren
    // Bijvoorbeeld: implementeer een algoritme om een unieke code te maken
    return 'EASTER15'; // Dit is slechts een voorbeeld, pas aan zoals nodig
  }
</script>




    
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
                <a style="color: #fff" ; href="../index.php">Home</a>
                <a style="color: #fff" ; href="../pages/over-ons.php">Over ons</a>
                <a style="color: #fff" ; href="../pages/productoverzicht.php">Producten</a>
                <a style="color: #fff" ; href="../pages/account.php">Account</a>
                <a style="color: #fff" ; href="../pages/legal.php">Legaal</a>
            </div>
    </footer>
    </div>
    </div>
    </div>
    <script src="logic/app.js"></script>