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
    <title>Bulma Cart</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css"
    />
    <link rel="stylesheet" href="index.css" />
  </head>
  <body>
    <div class="body-container1">
      <br /><br />
      <div class="columns">
        <div class="column is-two-third">
          <p class="is-size-3" style="border-bottom: grey 1px solid">
            Shopping Cart
          </p>
          <?php
            $mysqli = new mysqli('localhost', 'root', '', 'testcrud') or die(mysqli_error($mysqli));
            //siteGround edit
            // $mysqli = new mysqli('localhost', 'uu4xg0pyr8587', 'benjaminis#GR86', 'db6kkdlvtmvryl') or die(mysqli_error($mysqli));

            $cartRead = $mysqli->prepare("SELECT * FROM carts WHERE user_uid = ?");
            $cartRead->bind_param("s", $_SESSION['user_uid']);
            $cartRead->execute();
            $cartResult = $cartRead->get_result();
            while ($cartRow = $cartResult->fetch_array()):
                $productID = $cartRow['product_id'];
                $pvID = $cartRow['pv_id'];
                $productRead = $mysqli->query("SELECT * FROM products WHERE product_id = $productID");
                $productRow = $productRead->fetch_assoc();
                $productPic = $productRow['product_pic'];
                $productDesc = $productRow['description'];

                $pvRead = $mysqli->query("SELECT * FROM productvariants WHERE pv_id = $pvID");
                $pvRow = $pvRead->fetch_assoc();
                $total = $pvRow['product_price'] * $cartRow['quantity'];
          ?>
          <div class="shopping-cart">
            <div class="columns cart-item">
                <div class="column is-one-quarter">
                    <div class="cart-item-big-picture">
                    <?php echo $productPic ?>
                    </div>
                </div>
                <div class="column is-two-quarter">
                    <div class="item-desc has-text-weight-bold">
                        <?php echo $productDesc ?>
                    </div>
                    <br>
                    <?php
                    //  echo print_r($_SESSION['cart-items-array']);
                     ?>
                    Color: <?php echo $pvRow['product_color'] ?><br>
                    Size: <?php echo $pvRow['product_size'] ?><br>
                    Quantity: <?php echo $cartRow['quantity'] ?><br>
                    <form  method="post">
                    <button type="submit" class="button is-small is-warning" name="quantity-sub-button" value="<?php echo $pvID; ?>">-</button>
                    <button type="submit" class="button is-small is-info ml-1" name="quantity-add-button" value="<?php echo $pvID; ?>">+</button>
                    <input type="hidden" name="item-total" value="<?php $total ?>">
                    <input type="hidden" name="delete-cart-item-product-id" value="<?php echo $productID; ?>">
                    <input type="hidden" name="scroll-input" class="scroll-input" value="">
                    <button type="submit" class="button is-small is-danger ml-6" name="delete-cart-item-pv-id" value="<?php echo $pvID; ?>">Delete</button>
                </form>
                </div>
                <div class="column is-one-quarter has-text-right is-size-3 mt-3">
                $<?php echo $total?>
                </div>
            </div>
           
          </div>
          <?php
              endwhile;
              if($cartResult->num_rows == 0):
            ?><br>
            <div class="has-text-centered mt-6">You have nothing in your cart! <a href="index.php">Continue Shopping?</a></div>
            <?php
            endif;
            $cartRead->close();
            ?>
        </div>
        <div class="column is-one-third checkout-section">
          <p class="is-size-3" style="border-bottom: grey 1px solid">Total</p>
          <br />
          <br />
          <p class="is-size-3 has-text-centered">
            <?php 
            if (cartTotal($mysqli) !== null) {
                echo "$" .  cartTotal($mysqli);
            }else{
                echo "$0";
            }
            ?>
          </p>
          <br>
          <button class="button is-primary is-fullwidth is-rounded mt-6" onclick="showCheckout()">Checkout</button>
        </div>
      </div>
    </div>
    <div class="more-space"></div>

<!-- hidden forms -->
 <div class="checkout">
    <h1>Checkout</h1>
     <div class="modal is-active">
        <div class="modal-background" id="checkoutBackground"></div>
        <div class="modal-content card has-background-white p-5">
                <h1 class="title is-3 has-text-centered">Checkout</h1>
                <?php 
                    $cartStmt = $mysqli->prepare("SELECT * FROM carts WHERE user_uid = ?");
                    $cartStmt->bind_param("s", $_SESSION['user_uid']);
                    $cartStmt->execute();
                    $res = $cartStmt->get_result();
                        while ($row = $res->fetch_array()):
                            $productID = $row['product_id'];
                            $pvID = $row['pv_id'];
                            $quantity = $row['quantity'];
                            

                            $productStmt = $mysqli->query("SELECT * FROM products WHERE product_id = $productID");
                            $productRow = $productStmt->fetch_array();
                            $productName = $productRow['product_name'];

                            $pvStmt = $mysqli->query("SELECT * FROM productvariants WHERE pv_id = $pvID");
                            $pvRow = $pvStmt->fetch_array();
                            $productColor = $pvRow['product_color'];
                            $productSize = $pvRow['product_size'];
                            $productPrice = $pvRow['product_price'];
                            $total = $quantity * $productPrice;
                        
                ?>
                <div class="columns">
                    <div class="column is-two-thirds">
                        <tr>
                            <td><?php
                            //  echo $res->num_rows; 
                                ?></td>
                            <td><?php echo $productName ?></td>
                            <td><?php echo $productColor ?></td>
                            <td><?php echo $productSize ?></td>
                            <td><?php echo "*" . $quantity ?></td>
                        </tr>
                    </div>
                    <div class="column is-one-third">
                    <p class="has-text-right"><?php echo "$" . $total ?></p>
                    </div>
                </div>
                
                <?php 
                    endwhile;
                    if($res->num_rows == 0):
                ?>
                
                <div>
                    You have no items in your cart <a href="index.php">Continue Shopping?</a>
                    <br><br>
                </div>
                <?php
                    endif;
                    $cartStmt->close();
                ?>
                <label class="label">First Name</label>
                <input type="text" class="input" placeholder="John" disabled>
                <br />
                <label for="" class="label">Last Name</label>
                <input type="password" class="input" placeholder="Doe" disabled>
                <br>
                <label for="" class="label">Mobile Number</label>
                <input type="password" class="input" placeholder="(000)-000-0000" disabled>
                <br>
                <label for="" class="label">Email Address</label>
                <input type="password" class="input" placeholder="johndoe@gmail.com" disabled>
                <br>
                <label for="" class="label">Cardholder Name(as printed on your card)</label>
                <input type="password" class="input" placeholder="John Wilson Doe" disabled>
                <br>
                <label for="" class="label">Billing Address</label>
                <input type="password" class="input" placeholder="132 My Street, Kingston, New York 12401" disabled>
                <br>
                <label for="" class="label">Card Number</label>
                <input type="password" class="input" placeholder="0000-0000-0000-0000" disabled>
                <br><br>
                <button class="button is-info">Submit Order $<?php echo cartTotal($mysqli) ?></button>
            <br /><br /><br />
            <p class="is-size-7 has-text-weight-normal has-text-centered">
                This website is for showcase purposes <strong>only</strong>.<br />
                Any input or potential customer information or PII
                <strong>is not</strong> submitted, stored or sold.
            </p>
        </div>
     </div>
    <div class="checkout-total"><?php echo cartTotal($mysqli) ?></div>
    <div class="checkout-extra-space"></div>
 </div>
 <?php
    $mysqli->close();
 ?>
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
  <script>
    //SCROLL POSITION
    window.scrollTo({
        top: <?php echo $scrollPosition ?>,
        behavior: 'auto'
    })
  </script>
</html>