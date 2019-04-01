<?php 

/**
 * Because cart total will be showing on every page
 * is is made into a global variable in start.php ln 36
 */
global $cart_count;

?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>FitSeeker</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?php echo URL; ?>/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.6.0/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="<?php echo URL; ?>/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="<?php echo URL; ?>/img/logo.png" />
  <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">

  <!--  CSS adopted -->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Megrim" />
  <link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
  <link href="https://fonts.googleapis.com/css?family=Rajdhani" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
  
</head>

<body>
  <!-- Main Navigation -->
<header>
  <section class="navigation">
      <div class="nav-container">
        <div class="brand">
          <div class="logo-img"><img src="<?php echo URL; ?>/img/logo.png"></div>
          <a href="<?php echo URL; ?>/index">Health Jam</a>
        </div>
        <nav>
          <div class="nav-mobile"><a id="nav-toggle" href="#"><span></span></a></div>
          <ul class="nav-list">
            <li><a href="<?= URL ?>/contact">Contact</a></li>
            <li><a href="<?= URL ?>/shop">Shop</a></li>
            <?php if (Session::userIsLoggedIn()) : ?>
           <!--  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Welcome <strong><?= Session::get('username') ?></strong></a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo URL; ?>/user/profile">Dashboard</a></li>
                      <li><a href="<?php echo URL; ?>/user/logout">Logout</a></li>
                    </ul>
              </li> -->
              <li><a href="<?php echo URL; ?>/cart">Cart (<?= $cart_count ?>)</a></li>
              <li><a href="<?= URL ?>/orders">Orders</a></li>
              <li><a href="<?php echo URL; ?>/user/logout">Logout</a></li>
              <li><a href="<?php echo URL; ?>/user/profile">Welcome <strong><?= Session::get('username') ?></strong></a></li>
            <?php else: ?>
                <li><a href="<?php echo URL; ?>/user/login">Login</a></li> 
            <?php endif; ?>
          </ul>
        </nav>
      </div>
    </section>
</header>
 <!-- end of Main Navigation -->