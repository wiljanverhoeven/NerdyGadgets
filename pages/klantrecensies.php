<!DOCTYPE html>
<html lang="nl">

<head>
    <?php 
    session_start();
    
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NerdyGadgets | Klantrecensies</title>
    <link rel="icon" type="image/png" href="/images/Logo_icon 2">
    <link rel="stylesheet" href="../styling/basic-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="../styling/recensie.css">
    <link rel="stylesheet" href="../styling/logincss.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <li><a href="../over-ons.php" class="paginas">Over ons</a></li>
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

    <?php 
            if(isset($_COOKIE['email'])) {
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
    </div>

</header>

<section id="block">
<div class="wrapper">
    <span class="close-icon">
        <i class='bx bx-x'></i>
    </span>

    <div class="form-box login">
    <form action="../logic/loginB.php" method="post">
    <h1> Login </h1>
        <div class="input-box">
            <input type="text" placeholder="username" required >
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" required >
            <i class='bx bxs-lock-alt' ></i>
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

<script src="../logic/script.js"></script>

<section id="review" class="section">
    <div class="container">
        <div class="board">
            <h2 class="text-light">Onze reviews</h2>
            <p class="text-light">Top reviews</p>
            <!-- Slider main container -->
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                Zit er geen eten op mijn bord, dan eet ik het hele bord!
                            </div>
                            <div class="profile">
                                <img src="https://th.bing.com/th?q=Rapper+Bigidagoe&w=120&h=120&c=1&rs=1&qlt=90&cb=1&dpr=1.3&pid=InlineBlock&mkt=nl-NL&cc=NL&setlang=nl&adlt=strict&t=1&mw=247" width="66.59" height="66.59">
                                <a href="#">Bigidagoe</a>
                                <span>Favoriete uitvinding: de frituurpan</span>
                            </div>
                        </div>


                    </div>

                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                W's in de chat!
                            </div>
                            <div class="profile">
                                <img src="https://th.bing.com/th/id/OIP.viHhFcj6ud1UVjUxrHmy8gAAAA?pid=ImgDet&rs=1" width="66.59" height="66.59">
                                <a href="#">IShowSpeed</a>
                                <span>Fan van Talking Ben</span>
                            </div>
                        </div>
                        </div>


                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                It's very great site. Suiiiiiiiiiiiiiiiii!
                            </div>
                            <div class="profile">
                                <img src="https://www.beautyfreelancer.nl/files/post/img1/thumb_Kapsel-Ronaldo.png" width="66.59" height="66.59">
                                <a href="#">Ronaldo</a>
                                <span>IShowSpeed's best friend</span>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                Eyy wie joint m'n minecraft server?
                            </div>
                            <div class="profile">
                                <img src="../images/BoredHiro.png" width="66.59" height="66.59">
                                <a href="#">Hieu</a>
                                <span>Een bully</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                Can I buy this site too?
                            </div>
                            <div class="profile">
                                <img src="https://marriedbiography.com/wp-content/uploads/2018/06/elon-150x150.jpg" width="66.59" height="66.59">
                                <a href="#">Elon Musk</a>
                                <span>Founder and CEO of ruining Twitter</span>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                Als koning der Nederlanden, Prins van Oranje-Nassau en jonkheer van Amsberg verklaar ik deze site als een topsite.
                            </div>
                            <div class="profile">
                                <img src="https://caribischnetwerk.ntr.nl/files/2013/05/willem-alexander-150x150.jpg" width="66.59" height="66.59">
                                <a href="#">Willem-Alexander der Nederlanden</a>
                                <span>Koning Willie is ook goed hoor</span>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                Tt goedkoop G! Vraag: zijn hier ook minderjarigen te koop? Vraag 't voor een vriend.
                            </div>
                            <div class="profile">
                                <img src="https://th.bing.com/th/id/OIP.l3JAXHjxILhsOXvdiw2qJgCWCW?pid=ImgDet&rs=1" width="66.59" height="66.59">
                                <a href="#">Anoniem</a>
                                <span>Naam: Marco Borsato </span>
                            </div>
                        </div>
                    </div>


                    <div class="swiper-slide">
                        <div class="flex">
                            <div class="comments">
                                What we do in the physical realm reflects in the spiritual realm (hello karma!), but it's also a powerful reminder to strive to make the lower self in reflection of the higher self, and to remember that we are in unity with the universe, with our bodies being microcosms, a miniture version of the macrocosm, the universe. Btw great site.
                            </div>
                            <div class="profile">
                                <img src="../images/een reviewer.png" width="66.59" height="66.59">
                                <a href="#">CestLavieMonAmi</a>
                                <span>the spiritual</span>
                            </div>
                        </div>
                    </div>
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
    <div class="section-content">
        <h2>Plaats uw recensie</h2>
        <form id="reviewForm">
            <label for="review">Uw recensie:</label>
            <textarea id="review" name="review" rows="5" required></textarea>
            <label for="rating">Beoordeling (1-5):</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>
            <button type="submit" class="btn btn-primary">Plaats recensie</button>
        </form>
    </div>
    <br>

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



    <div class="section-content">
        <h2>Klantrecensies</h2>
        <div>
            <label for="sort">Sorteer op:</label>
            <select id="sort" onchange="sortReviews()">
                <option value="datum">Datum</option>
                <option value="waardering">Waardering</option>
                <option value="relevantie">relevantie</option>
            </select>
        </div>
        <div id="reviews">
            <!-- Hier worden de recensies dynamisch ingevoegd -->
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script src="../logic/main.js"></script>
</body>
</html>