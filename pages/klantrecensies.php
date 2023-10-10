<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Klantrecensies - NerdyGadgets</title>
  <link rel="stylesheet" href="../styling/basic-style.css">
  <link rel="stylesheet" href="../styling/recensiepagina.css">
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
            <li><a href="over-ons.php" class="paginas">Over ons</a></li>
            <li><a href="producten.php" class="paginas">Producten</a></li>
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

<div class="main">

<section id="home" class="section">
  <h2>Welkom bij NerdyGadgets</h2>
  <marquee class="slidein" behavior="scroll" direction="left">Ontdek geweldige producten voor de beste prijzen.</marquee>
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
</div>

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