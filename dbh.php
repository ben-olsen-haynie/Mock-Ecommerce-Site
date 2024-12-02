<?php
// Set headers to prevent caching
// header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
// header("Pragma: no-cache"); // HTTP 1.0.
// header("Expires: 0"); // Proxies.

    session_start();
    // session_unset();

    if(!isset($_SESSION['cart-items-array'])) {
        $_SESSION['cart-items-array'] = [];
    }

    if(!isset($_SESSION['user_uid'])) {
        $_SESSION['user_uid'] = 'JohnDoe';

    }

    function cartItemCount($mysqli) {
        $stmt = $mysqli->prepare("SELECT * FROM carts WHERE user_uid = ?");
        $stmt->bind_param("s", $_SESSION['user_uid']);
        $stmt->execute();
        $res = $stmt->get_result();
        

        return $res->num_rows;
        $stmt->close();

    }

    $mysqli = new mysqli('localhost', 'root', '', 'testcrud') or die(mysqli_error($mysqli));
    //siteGround edit
    // $mysqli = new mysqli('localhost', 'uu4xg0pyr8587', 'benjaminis#GR86', 'db6kkdlvtmvryl') or die(mysqli_error($mysqli));
    //mysqli called in header and cart page as well.

    //search array
    $searchArrayRes = $mysqli->query("SELECT product_name FROM products");
    if($searchArrayRes->num_rows > 0) {
        $productNames = [];
        
        while($row = $searchArrayRes->fetch_assoc()) {
            $productNames[] = $row['product_name'];
        }
    }

    //product div form/submit
    if(isset($_POST['product-submit'])) {
        if(isset($_GET['error'])) {
            switch($_GET['error']) {
                case 'alreadyInCart': 
                    header('location: ./index.php');
                    exit();
                break;
            }
        }
        $userUid = $_SESSION['user_uid'];
        $product = $_POST['pageTitle'];
        $color = $_POST['color-select'];
        $size = $_POST['size-select'];
        $quantity = $_POST['quantity-select'];

        
        //products db table
        $productStmt = $mysqli->query("SELECT product_id FROM products WHERE product_name = '$product'");
        $productRow = $productStmt->fetch_assoc();
        $productID = $productRow['product_id'];

        //productvariants db table
        $pvStmt = $mysqli->query("SELECT * FROM productvariants WHERE product_color = '$color' AND product_size = '$size' AND product_id = $productID");
        $pvRow = $pvStmt->fetch_array();
        $pvID = $pvRow['pv_id'];
        
        $price = $pvRow['product_price'];
        $total = $price * $quantity;

        
        $currentProduct = "P" . $productID . "V" . $pvID;
            if (in_array($currentProduct, $_SESSION['cart-items-array'])) {
                header('location: ./index.php?error=alreadyInCart');
                exit();
            } else {
                $_SESSION['cart-items-array'][] = $currentProduct;
            }

        //carts db table
        $stmt = $mysqli->query("INSERT INTO carts (user_uid, product_id, pv_id, quantity, price) VALUES('$userUid', $productID, $pvID, $quantity, $price)"); 

    }
    //SCROLL POSITION
    if(isset($_POST['scroll-input'])) {
        $scrollPosition = $_POST['scroll-input'];
    }

    //set to quantity/delete buttons in cart
    if(isset($_POST['quantity-sub-button'])) {
        $pvID = $_POST['quantity-sub-button'];



        $stmt = $mysqli->prepare("UPDATE carts SET quantity = quantity - 1 WHERE user_uid = ? and pv_id = ? AND quantity > 1");
        $stmt->bind_param("si", $_SESSION['user_uid'], $pvID);
        $stmt->execute();
        $stmt->close();
    }
    if(isset($_POST['quantity-add-button'])) {
        $pvID = $_POST['quantity-add-button'];

        $stmt = $mysqli->prepare("UPDATE carts SET quantity = quantity + 1 WHERE user_uid = ? AND pv_id = ?");
        $stmt->bind_param("si", $_SESSION['user_uid'], $pvID);
        $stmt->execute();
        $stmt->close();
    }
    if(isset($_POST['delete-cart-item-pv-id'])) {
        $pvID = $_POST['delete-cart-item-pv-id'];
        $productID = $_POST['delete-cart-item-product-id'];

        $productVersion = "P" . $productID . "V" . $pvID;
        $key = array_search($productVersion, $_SESSION['cart-items-array']);
        if ($key) {
            unset($_SESSION['cart-items-array'][$key]);
        }

        $stmt = $mysqli->prepare("DELETE FROM carts WHERE user_uid = ? and pv_id = ?");
        $stmt->bind_param("si", $_SESSION['user_uid'], $pvID);
        $stmt->execute();
        $stmt->close();
    }

    //sign up
    if(isset($_POST['sign-up-submit'])) {
        $name = $_POST['sign-up-username'];
        $pwd = $_POST['sign-up-pwd'];
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        //unique constraint
        $checkStmt = $mysqli->prepare("SELECT * FROM users WHERE user_uid = ?");
        $checkStmt->bind_param("s", $name);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows == 1) {
            header('location: ./index.php?error=usernameTaken');
            exit();
        }
        $checkStmt->close();


        //sql
        $stmt = $mysqli->prepare("INSERT INTO users (user_uid, user_pwd) VALUES(?, ?)");
        $stmt->bind_param("ss", $name, $hashedPwd);
        $stmt->execute();

        $stmt->close();
    }

    //sign in
    if(isset($_POST['sign-in-submit'])) {
        $name = $_POST['sign-in-username'];
        $pwd = $_POST['sign-in-pwd'];

        $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_uid = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_array();
            $resultName = $row['user_uid'];
            $resultPwd = $row['user_pwd'];

            $checkPwd = password_verify($pwd, $resultPwd);
            if($resultName !== $name || $checkPwd === false) {
                header('location: ./index.php?error=wrongLogin');
                exit();
            }
            // echo "Welcome " . $resultName . "<br><br>";

            $_SESSION['user_uid'] = $name;
            $_SESSION['cart-items-array'] = [];
            $defaultUseruid = "JohnDoe";

            $cartStmt = $mysqli->prepare("UPDATE carts SET user_uid = ? WHERE user_uid = ?");
            $cartStmt->bind_param("ss", $name, $defaultUseruid);
            $cartStmt->execute();

        } else {
            header('location: ./index.php?error=usernameIncorrect');
            exit();
        }
        $stmt->close();
    }

    //edit
    if(isset($_POST['account-edit-submit'])) {
        $originalName = $_POST['account-edit-original-username'];
        $originalPwd = $_POST['account-edit-original-pwd'];
        $newName = $_POST['account-edit-new-username'];
        $newPwd = $_POST['account-edit-new-pwd'];
        $newHashedPwd = password_hash($newPwd, PASSWORD_DEFAULT);

        //unique constraint
        $checkStmt = $mysqli->prepare("SELECT * FROM users WHERE user_uid = ?");
        $checkStmt->bind_param("s", $newName);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows == 1) {
            header('location: ./index.php?error=usernameTaken');
            exit();
        }
        $checkStmt->close();


        //sql
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_uid = ?");
        $stmt->bind_param("s", $originalName);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_array();
            $resultName = $row['user_uid'];
            $resultPwd = $row['user_pwd'];

            $checkPwd = password_verify($originalPwd, $resultPwd);
            if ($resultName !== $originalName || $checkPwd === false) {
                header('location: ./index.php?error=wrongLogin');
                exit();
            }
            // update sql
            $updateStmt = $mysqli->prepare("UPDATE users SET user_uid = ?, user_pwd = ? WHERE user_uid = ?");
            $updateStmt->bind_param("sss", $newName, $newHashedPwd, $originalName);
            $updateStmt->execute();

            $updateStmt->close();
            
        }
        $stmt->close();
    }

    //delete
    if(isset($_POST['account-delete-submit'])) {
        $name = $_POST['account-delete-username'];
        $pwd = $_POST['account-delete-pwd'];

        //sql
        $stmt = $mysqli->prepare("SELECT * FROM users WHERE user_uid = ?");
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $row = $result->fetch_array();
            $resultName = $row['user_uid'];
            $resultPwd = $row['user_pwd'];

            $checkPwd = password_verify($pwd, $resultPwd);
            if($resultName !== $name || $checkPwd === false) {
                header('location: ./index.php?error=wrongLogin');
                exit();
            }
            $deleteCartStmt = $mysqli->prepare("DELETE FROM carts WHERE user_uid = ?");
            $deleteCartStmt->bind_param("s", $name);
            $deleteCartStmt->execute();
            $deleteCartStmt->close();

            $deleteStmt = $mysqli->prepare("DELETE FROM users WHERE user_uid = ?");
            $deleteStmt->bind_param("s", $name);
            $deleteStmt->execute();
            $deleteStmt->close();

            
        }
        $stmt->close();
        session_unset();
        $_SESSION['user_uid'] = 'JohnDoe';
    }

    function cartTotal($mysqli) {
       //have chat GPT explain every line of this function code!!!
        $total = 0;
        $userId = $_SESSION['user_uid'];
        $query = "SELECT SUM(price * quantity) AS total FROM carts WHERE user_uid = ?";

        if($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("s", $userId);
            $stmt->execute();
            $stmt->bind_result($total);
            $stmt->fetch();
            $stmt->close();
        }

        $_SESSION['cart-total'] = $total;
        return $total;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
</body>
<?php 
    $mysqli->close(); 
?>
</html>


<!-- TO DO
- Mobile Dark Mode:
  - suggestions-searchbar can't see
  - checkout/signUp/signIn/edit/delete account modals hard to see lables, inputs.
- loginModal->createAccountBtn creates stuck modal, can't get out!!!
- editAccount does not show new name in nav. reset session['user_uid']
- signUp should automatically signIn, duh!
- create SignOut
- cartItem +,-,delete buttons glitch/reset page. ANNOYING!
- fix autoScroll on ^^^ buttons
- "sure you want to re-submit" when user hits <- arrow, fix.







- auto scroll works for first cart element but not the others. FIX!
- How do I take off confirm resubmission when user hits the <- arrow?
  - Post/Redirect/Get (PRG) Pattern

TRY
- Password requirments in signup input-text. not necessary but fun.
- think about making additional products through submittion like:
  - product form
    - product name
    - product desc.
    - product variants w/prices
    - 3-5 product images per color
  - extras: product limits and other limitations(how many you can buy etc...)




***NOTES***
CREATE TABLE users (
	id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_uid varchar(50) not null,
    user_pwd varchar(255) not null
)
CREATE TABLE products (
    product_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    product_name varchar(50) not null,
    description varchar(200) not null,
    product_pic varchar(200) not null
)
INSERT INTO products (product_name, description) VALUES(?, ?);

CREATE TABLE productVariants (
	pv_id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    product_id varchar(100) not null,
    product_size varchar(50) not null,
    product_color varchar(50) not null,
    product_price varchar(50) not null
)
INSERT INTO productvariants (product_id, product_size, product_color, product_price) VALUES(2, 'Small', 'Navy', 13.00);
INSERT INTO productvariants (product_id, product_size, product_color, product_price) VALUES(2, 'Medium', 'Navy', 13.00);
INSERT INTO productvariants (product_id, product_size, product_color, product_price) VALUES(2, 'Large', 'Navy', 13.00);
INSERT INTO productvariants (product_id, product_size, product_color, product_price) VALUES(2, 'X-Large', 'Navy', 13.00);
INSERT INTO productvariants (product_id, product_size, product_color, product_price) VALUES(2, 'XX-Large', 'Navy', 13.00);
INSERT INTO productvariants (product_id, product_size, product_color, product_price) VALUES(2, '3X-Large', 'Navy', 13.00);

CREATE TABLE carts (
	id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_uid varchar(50) not null,
    product_id varchar(100) not null,
    pv_id decimal(10) not null,
    quantity decimal(10) not null,
    price decimal(10, 2) not null
)
CREATE TABLE orders(
	id int(11) AUTO_INCREMENT PRIMARY KEY not null,
    user_uid varchar(50) not null,
    product_id varchar(100) not null,
    quantity decimal(10, 2) not null,
    total decimal(10, 2) not null
)

  -   ___            _____________
    <|*_*|>  \__/   /             \
    __| |__  / /  <( Hello Viewers )
   / .   . \/ /     \ ___________ / 
  | || + |\__/      
  |_||_+_| 
  / \/ * \
    / /\  \
   / /  \  \
  |  |   |  |
  |__|   |__|
-->