<?php

//header.php

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="generator" content="">
        <title>Library Management System</title>
        <link rel="canonical" href="">
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url(); ?>asset/css/simple-datatables-style.css" rel="stylesheet" />
        <link href="<?php echo base_url(); ?>asset/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>asset/js/font-awesome-5-all.min.js" crossorigin="anonymous"></script>
        <!-- Favicons -->
        <link rel="apple-touch-icon" href="" sizes="180x180">
        <link rel="icon" href="" sizes="32x32" type="image/png">
        <link rel="icon" href="" sizes="16x16" type="image/png">
        <link rel="manifest" href="">
        <link rel="mask-icon" href="" color="#7952b3">
        <link rel="icon" href="">
        <meta name="theme-color" content="#7952b3">
        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                    font-size: 3.5rem;
                }
            }
            .navbar-brand {
                 font-weight: bold; 
                 color: black;
                }
            /* For the top navigation bar */
            .navbar {
                background-color: #333; 
            }

            /* For the side navigation bar */
            .sb-sidenav {
                background-color: pink; 
            }
            .nav-link {
            color: black; 
            font-size: 15px; 
            font-weight: bold;
             }
        </style>
    </head>

    <?php 

    if(is_admin_login())
    {

    ?>
  
  <body class="sb-nav-fixed">

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.php" >LIBRARY MANAGEMENT SYSTEM</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="setting.php">Setting</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link" href="category.php">CATEGORY</a>
                    <a class="nav-link" href="author.php">AUTHOR</a>
                    <a class="nav-link" href="location_rack.php">RACK LOCATION</a>
                    <a class="nav-link" href="book.php">BOOK</a>
                    <a class="nav-link" href="user.php">USER</a>
                    <a class="nav-link" href="issue_book.php">ISSUE BOOK</a>
                    <a class="nav-link" href="logout.php">LOGOUT</a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
               
            </div>
        </nav>
    </div>
</div>
            <div id="layoutSidenav_content">
                <main>


    <?php 
    }
    else
    {

    ?>

    <body>


    <style>
    .navbar {
        background-color: #333;
        padding: 10px;
    }

    .navbar ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .navbar ul li {
        display: inline-block;
        margin-right: 10px;
    }

    .navbar ul li a {
        color: white;
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .navbar ul li a:hover {
        background-color: #555;
    }
</style>

    	<main>

    		<div class="container py-4">

    			<header class="pb-3 mb-4 border-bottom">
                    <div class="row">
        				<div class="col-md-6">
                            <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
                            <span class="fs-4" style="font-size: 24px; color: black; font-weight: bold;">LIBRARY MANAGEMENT SYSTEM</span>
                            </a>
                        </div>
                        <div class="col-md-6">
                            <?php 

                            if(is_user_login())
                            {
                            ?>
                            <nav class="navbar navbar-dark bg-dark container-fluid">
                                <ul class="list-inline mt-4 float-end">
                                    <li class="list-inline-item"><?php echo $_SESSION['user_id']; ?></li>
                                    <li class="list-inline-item"><a href="issue_book_details.php">ISSUE BOOKS</a></li>
                                    <li class="list-inline-item"><a href="search_book.php">SEARCH BOOKS</a></li>
                                    <li class="list-inline-item"><a href="profile.php">PROFILE</a></li>
                                    <li class="list-inline-item"><a href="logout.php">LOGOUT</a></li>
                                </ul>
                            </nav>
                            <?php 
                            }

                            ?>
                        </div>
                    </div>

    			</header>
    <?php 
    }
    ?>
    			