<?php
// Set headers to prevent caching
// header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
// header("Pragma: no-cache"); // HTTP 1.0.
// header("Expires: 0"); // Proxies.
?>
<?php
        include_once 'header.php';
    ?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ecommerce Site-BenHaynie</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css"
    />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="body-container">
      <div class="columns mt-6 pt-6">
        <div class="column">
          <a onclick="productPage('Jakeson Windbreaker')">
            <div class="card lpCard">
              <div
                class="card1"
                style="
                  background-image: url('assets/Product-Images/Windbreaker-black\ 1.jpg');
                "
              ></div>
              <div class="card-content has-text-centered">
                Jakeson Windbreaker <br />
              </div>
            </div>
          </a>
        </div>
        <div class="column">
          <a onclick="productPage('FL Hoodie')">
            <div class="card lpCard">
              <div
                class="card1"
                style="
                  background-image: url(' assets/Product-Images/fruitOfLoomHoodie-black\ 1.jpg');
                "
              ></div>
              <div class="card-content has-text-centered">FL Hoodie</div>
            </div>
          </a>
        </div>
        <div class="column">
          <a onclick="productPage('Jakeson Windbreaker')">
            <div class="card lpCard">
              <div
                class="card1"
                style="
                  background-image: url(' assets/Product-Images/Windbreaker-navy\ 1.jpg');
                "
              ></div>
              <div class="card-content has-text-centered">Jakeson Windbreaker</div>
            </div>
          </a>
        </div>
        <div class="column">
          <a onclick="productPage('FL Hoodie')">
            <div class="card lpCard">
              <div
                class="card1"
                style="
                  background-image: url('assets/Product-Images/fruitOfLoomHoodie-greyHeather 1.jpg');
                "
                
              ></div>
              <div class="card-content has-text-centered">FL Hoodie</div>
            </div>
          </a>
        </div>
        <div class="column">
          <a onclick="productPage('FL Hoodie')">
            <div class="card lpCard">
              <div
                class="card1"
                style="
                  background-image: url('assets/Product-Images/fruitOfLoomHoodie-blackHeather 1.jpg');
                "
              ></div>
              <div class="card-content has-text-centered">FL Hoodie</div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <footer class="footer">
    <div
      class="content is-size-7 has-text-weight-normal is-fullwidth has-text-centered"
    >
      This website is for showcase purposes <strong>only</strong>. None of the
      listed products are actually for sale. Any input or potential customer
      information or PII <strong>is not</strong> submitted, stored or sold.
    </div>
  </footer>
  </body>
  
  <script src="index.js"></script>
</html>
