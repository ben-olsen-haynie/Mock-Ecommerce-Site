<?php
    include_once 'header.php';
?>
<?php
// Set headers to prevent caching
// header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
// header("Pragma: no-cache"); // HTTP 1.0.
// header("Expires: 0"); // Proxies.
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title id="productPageTitle">product</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css"
    />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    
    <div class="body-container1">
    <form method="post">
      <div class="columns pt-6">
        <div class="column">
          <div class="is-centered is-flex">
            <div class="m-0 p-0">
              <a>
                <div class="card card-preview mb-0">
                  <div class="card-image">
                    <figure class="image" id="productCardPreviewImg1"></figure>
                  </div>
                </div>
              </a>
              <a>
                <div class="card card-preview mb-0 p-0">
                  <div class="card-image">
                    <figure class="image" id="productCardPreviewImg2"></figure>
                  </div>
                </div>
              </a>
              <a>
                <div class="card card-preview mb-0 p-0">
                  <div class="card-image">
                    <figure class="image" id="productCardPreviewImg3"></figure>
                  </div>
                </div>
              </a>
              <a>
                <div class="card card-preview mb-0 p-0">
                  <div class="card-image">
                    <figure class="image" id="productCardPreviewImg4"></figure>
                  </div>
                </div>
              </a>
              <a>
                <div class="card card-preview mb-0 p-0">
                  <div class="card-image">
                    <figure class="image" id="productCardPreviewImg5"></figure>
                  </div>
                </div>
              </a>
            </div>
            <div class="m-0 p-0">
              <div class="card big-picture-card m-0 p-0">
                <div class="card-image">
                  <figure class="image" id="productBigPicture"></figure>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="column">
          <input type="hidden" name="pageTitle" value="" id="pageTitle">
          <h1 class="title is-4" id="productTitle"></h1>
          <p>Price</p>
          <p class="has-text-primary is-size-4" id="productPrice"></p>
          <br />
          <p>Size</p>
          <div class="select">
            <select name="size-select" id="selectSize" required>
                <option value="Small" selected>Small</option>
                <option value="Medium">Medium</option>
                <option value="Large">Large</option>
                <option value="Large Tall">Large Tall</option>
                <option value="X-Large">X-Large</option>
                <option value="X-Large Tall">X-Large Tall</option>
                <option value="XX-Large">XX-Large</option>
                <option value="XX-Large Tall">XX-Large Tall</option>
                <option value="3X-Large">3X-Large</option>
                <option value="3X-Large Tall">3X-Large Tall</option>
                <option value="4X-Large Tall">4X-Large Tall</option>
            </select>
          </div>
          <br /><br />
          <p>Color<span id="colorName"></span></p>
          <!-- based on color text->js var->input.value->submit->php->db -->
          <input type="hidden" value="Black" name="color-select" id="colorInput">
          <div class="color-cards-container mt-3">
            <div class="card color-card">
              <div class="card-image">
                <figure class="image" id="productColorCard1"></figure>
              </div>
            </div>
            <div class="card color-card">
              <div class="card-image">
                <figure class="image" id="productColorCard2"></figure>
              </div>
            </div>
            <div class="card color-card">
              <div class="card-image">
                <figure class="image" id="productColorCard3"></figure>
              </div>
            </div>
            <div class="card color-card">
              <div class="card-image">
                <figure class="image" id="productColorCard4"></figure>
              </div>
            </div>
          </div>
        </div>
        <div class="column" id="addToCart">
          <div class="has-text-centered is-size-3 has-text-primary">
            $<span id="addToCartPrice"></span> <br /><br />
            <div class="select is-rounded is-small">
              <div class="is-flex is-align-items-center">
                <label class="is-size-4 has-text-dark has-text-weight-normal"
                  >Quantity
                </label>
                <select 
                  name="quantity-select"
                  class="is-size-6 has-text-weight-bold"
                  id="productSelectedQuantity"
                >
                  <option value="1" selected>1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6">6</option>
                  <option value="7">7</option>
                  <option value="8">8</option>
                  <option value="9">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                </select>
              </div>
            </div>
            <br /><br />
            <button
              type="submit"
              name="product-submit"
              class="button is-rounded is-warning is-fullwidth"
              id="addToCartButton"
            >
              Add to Cart
            </button>
          </div>
        </div>
      </div>
      </form>
      <div class="columns">
        <div class="column">
          <p class="is-size-4 has-text-centered">
            <strong>Product Details</strong>
          </p>
          <br />
          <p id="productDetails"></p>
        </div>

        <div class="column is-relative">
          <p class="is-size-4 has-text-centered">
            <strong>About this item</strong>
          </p>
          <br />
          <div id="aboutProduct" class="showMore-LessHeight"></div>
          <div id="aboutBlur" class="about-blur"></div>
          <button class="button is-small" id="showMoreToggleButton">
            Show More
          </button>
        </div>
        <div class="column"></div>
      </div>
    </div>
    <div class="more-space"></div>
    
  </body>
  <script src="index.js"></script>
  <script>
    //after product page load, adds the specific product to the page.
    document.addEventListener("DOMContentLoaded", loadProductPage);
  </script>
</html>