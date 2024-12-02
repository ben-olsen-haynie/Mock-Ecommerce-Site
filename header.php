<?php
  include_once 'dbh.php';
?>
<?php
// Set headers to prevent caching
// header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
// header("Pragma: no-cache"); // HTTP 1.0.
// header("Expires: 0"); // Proxies.
?>

<!DOCTYPE html>
<html lang="en">
<body>
<nav class="navbar is-dark">
    <div class="navbar-brand">
      <a href="https://bulma.io/">
        <img
          src="assets/Bulma Logo White.png"
          alt="bulma logo"
          class="navbar-item bulma-logo-img"
        />
      </a>
      <a
        role="button"
        class="navbar-burger"
        aria-label="menu"
        aria-expanded="false"
        data-target="navbarBasicExample"
        id="burger"
      >
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
      </a>
    </div>
    <div class="navbar-menu" id="nav-links">
      <div class="navbar-start">
        <a href=" index.php" class="navbar-item"> Home </a>
        <a onclick="showSearch()" class="search-btn navbar-item">Search</a>
      </div>
      <?php
        if(isset($_SESSION['user_uid']) && $_SESSION['user_uid'] === "JohnDoe"):
      ?>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons mb-0">
            <div class="button is-primary signUpButton" onclick="createModal('sign-up')">
              <strong>Sign Up</strong>
            </div>
            <div onclick="createModal('sign-in')" class="button is-warning logInButton">Log In</div>
          </div>
        </div>
        <?php
          endif;
          if(isset($_SESSION['user_uid']) && $_SESSION['user_uid'] !== "JohnDoe"):
        ?>
      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons mb-0">
            <!-- dropdown -->
          <div class="dropdown is-hoverable">
            <div class="dropdown-trigger">
              <a class="name-account-button" aria-haspopup="true" aria-controls="dropdown-menu">
                <strong class="title is-4 has-text-primary"><?php echo $_SESSION['user_uid']; ?></strong>
              </a>
            </div>
            <div class="dropdown-menu mt-0" id="dropdown-menu" role="menu">
              <div class="dropdown-content has-background-dark">
                <a onclick="createModal('sign-in')" class="dropdown-item has-background-dark has-text-white logInButton">Sign In</a>
                <a onclick="createModal('sign-up')" class="dropdown-item has-background-dark has-text-white">Sign Up </a>
                <a onclick="createModal('edit')" class="dropdown-item has-background-dark has-text-white">Edit Account </a>
                <hr class="dropdown-divider" />
                <a onclick="createModal('delete')" class="dropdown-item has-background-dark has-text-white"><span class="has-text-danger">Delete Account</span></a>
              </div>
            </div>
          </div>
          </div>
        </div>
        <?php
          endif;
        ?>
        <a href="cart.php" class="navbar-item ml-5"
          >Shopping Cart (
          <?php 
            $mysqli = new mysqli('localhost', 'root', '', 'testcrud') or die(mysqli_error($mysqli));
            //siteGround edit
            // $mysqli = new mysqli('localhost', 'uu4xg0pyr8587', 'benjaminis#GR86', 'db6kkdlvtmvryl') or die(mysqli_error($mysqli));
            echo cartItemCount($mysqli);
            $mysqli->close();
            ?>
          )</a>
      </div>
    </div>
</nav>
<div class="searchbar">
  <div class="searchbar-card card">
    <div class="search-container">
      <input type="hidden" class="searchInput input is-medium"/>
    </div>
    <p class="suggestions"></p>
  </div>
</div>

<div class="errors">
  <?php 
    if(isset($_GET['error'])) {
      switch($_GET['error']) {
        case 'usernameTaken': 
          echo "***Sorry, that username is taken***";
        break;
        case 'wrongLogin': 
          echo "***Invalid Login***";
        break;
        case 'usernameIncorrect': 
          echo "***Invalid Username***";
        break;
        case 'alreadyInCart': 
          echo "***Product is already in your cart.***";
        break;
      }
    }
  ?>
</div>
</body>
<script>
  function showSearch() {
    const searchInput = document.querySelector('.searchInput');
    const searchBtn = document.querySelector('.search-btn');
    const searchbar = document.querySelector('.searchbar');

    searchInput.type = "text";
    searchInput.focus();
    searchbar.classList.toggle("fade-in-top");



    document.addEventListener('click', function(event) {
      if(!searchBtn.contains(event.target) && !searchInput.contains(event.target)) {
        searchInput.type = "hidden";
        searchbar.classList.toggle("fade-in-top");
      }
    })

  }

    const wordArray = <?php echo json_encode($productNames); ?>;
    document.querySelector('.searchInput').addEventListener('input', function() {
        const searchInput = this.value;
        const suggestions = document.querySelector('.suggestions');

        suggestions.innerHTML = '';

        const matches = wordArray.filter(word => word.toLowerCase().includes(searchInput.toLowerCase()));

        matches.forEach(match => {
            const listItem = document.createElement('button');
            listItem.textContent = match;
            listItem.onclick = () => productPage(match);
            listItem.classList.add('list-item');
            suggestions.appendChild(listItem);
            if (searchInput == '' || searchInput == ' ') {
              suggestions.innerHTML = '';
            }
            
        })
        if(matches.length === 0) {
              suggestions.innerHTML = `**Sorry, no products by that name**`;
            }
    })
</script>
</html>