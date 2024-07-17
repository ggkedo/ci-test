<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS WEB APP</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!--     <link href="<?=base_url()?>ci-test/public/res/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?=base_url()?>ci-test/public/res/js/bootstrap.min.js"></script> -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body class="bg-light">

    <header class="container-fluid bg-primary text-white pt-2 pb-2">
        <div class="row">
            <div class="col-sm-4 h5 pt-3">LMS WEB APP</div>
            <nav class="navbar navbar-dark navbar-expand-sm col-sm-8 justify-content-end">
                <ul class="navbar-nav">
				<?php //if(\App\Controllers\UserAuth::GetSession()): ?>
                    
					<li class="nav-item">
                        <a href="<?= base_url() ?>" class="nav-link">
                        	<i class="fa-solid fa-house-chimney"></i> Kezdőlap
                        </a>
                    </li>
                    
					<li class="nav-item">
                        <a href="<?= base_url('projects') ?>" class="nav-link">
                        	<i class="fa-solid fa-folder-open"></i> Projektek
                        </a>
                    </li>
                    
					<li class="nav-item">
                        <a href="<?= base_url('tasks') ?>" class="nav-link">
                        	<i class="fa-solid fa-rectangle-list"></i> Feladatok
                        </a>
                    </li>
                    
					<li class="nav-item">
                        <a href="<?= base_url('logout') ?>" class="nav-link">
                        	<i class="fa-solid fa-door-open"></i> Kijelentkezés
                        </a>
                    </li>
					
				<?php //endif; ?>
                </ul>
            </nav>
        </div>
        
    </header>

    <main class="container pt-4">
        <h2><?= $title ?></h2>
        <section class="p-4 bg-white border shadow mb-4">