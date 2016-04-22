<!DOCTYPE html>
<html>
  <head>
    <?php
      // Setting the title for this page:
      $title = "About";
      $session_name = "PetRescue_Malmstrom_Bertolacci";
      include 'header.php';
    ?>
  </head>
  <body>
    <div class="about_PageContents"> <!-- Will hold all the page contents -->
      <?php
        // setting page Heading:
        $heading = "About Us";
        include "navbar.php"
      ?>
      <!-- Adding a div that will hold the "About Us" caption - professional looking -->
      <div class="about_us_header"><h2 class="abtUsText">About Us</h2></div>
      <div class="our_organization">
          <h3>Our Organization</h3>
          <p>
              The Bertomalmi Inc. is an organization that wants to help. We believe that everyone deserves a second chance.
              We love animals, just as much as animals love us. We have a strong, passionate sentiment towards the care of
              any animal. Bertomalmi Inc. is a non-profit, voluntary organization which was originally founded in a class
              room in 2016. We will continue to persue the rightful treatment and care for animals around the world and we won't
              stop at nothing.
          </p>
              <blockquote>
                <em>Our mission is to rescue abused and abandoned animals and give them a place to call home. Giving them the love and
                care they desreve while trying to find the perpetrator(s) responsible for these inhumane acts, bringing them to
                justice.</em>
              </blockquote>
      </div>
      <div class="about_us_header"><h2 class="abtUsText">Who we Are</h2></div>
      <div class="who_we_are">
          <h3>Tyrus Malmstrom</h3>
          <!-- Insert image of Tyrus here -->
          <img src="assets/images/tyru5.jpg" class="auth_imag" alt="Picture of one of the co-founders: Tyrus Malmstrom">
          <div class="auth_info">
              <p>
                  Tyrus Malmstrom is a quadruplet! His favorite colour is forest green and he loves macaroni and cheese. Some would
                  even quote him as saying,
                    <blockquote>
                        <em>"If macaroni was a video-game, I would be at the top of the leader boards!"</em>
                    </blockquote>
                  Tyrus also spent much of his childhood in Europe living in places such as Cyprus, Israel, Sweden, and the United
                  Kingdom. We are glad to have him as part of our team!
              </p>
          </div>
          <h3>Mateus Rocha</h3>
          <img src="assets/images/mateus.jpg" class="auth_imag" alt="Picture of one of the co-founders: Ian Bertolacci">
          <div class="auth_info">
              <p>
                Mateus Rocha is a student at Colorado State University.
              </p>
              <p>
                He likes track jackets, and <a href="https://bandcamp.com/ianbertolacci">music</a> that like, you've probably never heard of man; it's really different stuff.
              </p>
          </div>
      </div>
    </div>
    <?php include 'footer.php'; ?>
  </body>
</html>
