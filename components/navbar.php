<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zen</title>
  <link rel="stylesheet" href="./styles/navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg ">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">ZEN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">

          <li class="nav-item me-3" id="nav-item">
            <a class="nav-link active" aria-current="page" href="./index.php">HOME</a>
          </li>
          <li class="nav-item me-3" id="nav-item">
            <a class="nav-link active" aria-current="page" href="./product.php">PRODUCT</a>
          </li>
          <li class="nav-item me-3" id="nav-item">
            <a class="nav-link active" aria-current="page" href="#">SPECIALS</a>
          </li>
          <li class="nav-item me-3" id="nav-item">
            <a class="nav-link active" aria-current="page" href="#">BLOGS</a>
          </li>


          <li class="nav-item me-3" id="nav-item">
            <a class="nav-link active" aria-current="page" href="#">ABOUT US</a>
          </li>
          <li class="nav-item me-3" id="nav-item">
            <a class="nav-link active" aria-current="page" href="#">POPPULAR</a>
          </li>



          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i id="user-icon" class="fa-solid fa-regular fa-user"></i>&nbsp;Profile
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="./cart.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>
              <!-- <li><a class="dropdown-item" href="./register.php">Register</a></li> -->
              <li><a class="dropdown-item" href="./edit_profile.php"><i class="fa-solid fa-user-pen"></i> Edit profile</a></li>
              <li><a class="dropdown-item" href="./changepass.php"><i class="fa-solid fa-user-pen"></i>Change password</a></li>

              <li><a class="dropdown-item" href="./user_history.php"><i class="fa-solid fa-list"></i> History</a></li>
              <!-- <li><a class="dropdown-item" href="./login.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li> -->

              <li><a class="dropdown-item" href="./logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a></li>
              <!-- <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li> -->
            </ul>
          </li>
          <!-- 
          <li class="nav-item me-3">
            <a class="nav-link active" aria-current="page" href="#"><i class="fa-solid fa-cart-shopping"></i></a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>