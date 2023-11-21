<?php
include("./components/navbar.php");
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./styles/index.css">

  <title>Homepage</title>
</head>

<body>
  <div class="container-fluid">

    <div  >
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1421217336522-861978fdf33a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Harley Benton
                Guitars</h5>
              <p>From high-gain axes with fanned frets and active electronics for red-hot shredding to classic hollowbody guitars crafted for jazz: Harley Benton offers the wide world of the electric guitar in all its facets and for every budget. Beginner instruments are as much a part of our repertoire as sophisticated ones for professional use, including special designs for specific genres as well as guitars inspired by iconic designs from rock history in authentic vintage versions or refined, modern Fusion incarnations. And our DIY kits offer every guitarist a fascinating way to build their own unique electric guitar.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1471478331149-c72f17e33c73?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Harley Benton
                Guitars</h5>
              <p>From high-gain axes with fanned frets and active electronics for red-hot shredding to classic hollowbody guitars crafted for jazz: Harley Benton offers the wide world of the electric guitar in all its facets and for every budget. Beginner instruments are as much a part of our repertoire as sophisticated ones for professional use, including special designs for specific genres as well as guitars inspired by iconic designs from rock history in authentic vintage versions or refined, modern Fusion incarnations. And our DIY kits offer every guitarist a fascinating way to build their own unique electric guitar.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1525201548942-d8732f6617a0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Harley Benton
                Guitars</h5>
              <p>From high-gain axes with fanned frets and active electronics for red-hot shredding to classic hollowbody guitars crafted for jazz: Harley Benton offers the wide world of the electric guitar in all its facets and for every budget. Beginner instruments are as much a part of our repertoire as sophisticated ones for professional use, including special designs for specific genres as well as guitars inspired by iconic designs from rock history in authentic vintage versions or refined, modern Fusion incarnations. And our DIY kits offer every guitarist a fascinating way to build their own unique electric guitar.</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

    <hr class="featurette-divider">

    <main>
      <div class="container py-4">


        <div class="p-5 mb-4 bg-light border rounded-3">
          <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">Custom jumbotron</h1>
            <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
            <button class="btn btn-primary btn-lg" type="button">Example button</button>
          </div>
        </div>

        <div class="row align-items-md-stretch ">
          <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
              <h2>Change the background</h2>
              <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
              <button class="btn btn-outline-light" type="button">Example button</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
              <h2>Add borders</h2>
              <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
              <button class="btn btn-outline-secondary" type="button">Example button</button>
            </div>
          </div>
        </div>

      </div>
    </main>
  </div>
  <main>
    <hr class="featurette-divider">


    <div class="container mt-5">
        <div class="row">

            <!-- Product 1 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="./images/R.png" class="card-img-top" alt="Product 1">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 1</h5>
                        <p class="card-text text-muted">Category 1</p>
                        <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h6 class="card-subtitle mb-2 text-muted">$49.99</h6>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="./images/R.png" class="card-img-top" alt="Product 2">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 2</h5>
                        <p class="card-text text-muted">Category 2</p>
                        <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h6 class="card-subtitle mb-2 text-muted">$69.99</h6>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="./images/R.png" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 3</h5>
                        <p class="card-text text-muted">Category 3</p>
                        <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h6 class="card-subtitle mb-2 text-muted">$89.99</h6>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="./images/R.png" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 3</h5>
                        <p class="card-text text-muted">Category 3</p>
                        <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h6 class="card-subtitle mb-2 text-muted">$89.99</h6>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="./images/R.png" class="card-img-top" alt="Product 3">
                    <div class="card-body">
                        <h5 class="card-title">Product Name 3</h5>
                        <p class="card-text text-muted">Category 3</p>
                        <p class="card-text">Description: Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <h6 class="card-subtitle mb-2 text-muted">$89.99</h6>
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>

            <!-- Add more product cards as needed -->

        </div>
    </div>
  </main>
  <footer class="pt-3 mt-4  border-top bg-black text-white">
    &copy; 2021
  </footer>

</body>

</html>