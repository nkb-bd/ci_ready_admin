<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $this->settings->site_name ?></title>
  <meta charset="utf-8">
  <meta name="description" content="<?php echo $this->settings->meta_description ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      width: 100%; /* Set width to 100% */
      margin: auto;
      min-height:200px;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">
        <img src="<?php echo $this->settings->logo1 ?>" width=60 class="img-responsive">

      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li>  <a href="<?php echo   base_url() ?>"><?php echo $this->settings->site_name ?></a></li>
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

        <li>
          <?php if (!$this->user): ?>
            
              <a href="<?php echo   base_url() ?>login"><span class="glyphicon glyphicon-log-in"></span> Login</a>
          
          <?php elseif ($this->user): ?>

              <a href="<?php echo   base_url() ?>logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
          
          <?php endif ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="main">