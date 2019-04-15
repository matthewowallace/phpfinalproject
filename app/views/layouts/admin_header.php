<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Jam | Admin</title>
  <!-- <link type="text/css" href="<?php echo URL; ?>/css/bootstrap.min.css" rel="stylesheet"> -->
  <link type="text/css" href="<?php echo URL; ?>/css/admin.bootstrap.min.css" rel="stylesheet">
  <link type="text/css" href="<?php echo URL; ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
  <link type="text/css" href="<?php echo URL; ?>/css/theme.css" rel="stylesheet">
  <link type="text/css" href="<?php echo URL; ?>/img/icons/css/font-awesome.css" rel="stylesheet">
  <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse"><i class="icon-reorder shaded"></i></a>

            <a class="brand" href="<?= URL ?>admin">Health Jam | Admin</a>

            <div class="nav-collapse collapse navbar-inverse-collapse">
                <ul class="nav pull-right">
                    <li><a href="#"> Admin </a></li>
                    <li class="nav-user dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= URL ?>/img/zeno.jpeg" class="nav-avatar" />
                        <b class="caret"></b> </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= URL ?>admin/change">Change Password</a></li>
                            <li class="divider"></li>
                            <li><a href="<?php echo URL; ?>/user/logout">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->
