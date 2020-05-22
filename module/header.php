<!DOCTYPE html>
<?php 
if(!isset($index)){$way="../";}else{$way='';}
include_once($way.'functions/fun.php');
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if(isset($title)){echo $title; }else{echo "support"; }?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' href='<?php echo $way;?>module/index.css'>

    <link href="<?php echo $way;?>vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $way;?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo $way;?>vendor/swiper/css/swiper.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $way;?>vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css" />

    <!-- THEME STYLES -->
    <link href="<?php echo $way;?>css/layout.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo $way;?>vendor/jquery.back-to-top.js " type="text/javascript "></script>

    <!-- Favicon -->

</head>

<body>

    <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation" style="border-radius: 0%;">
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // Get all "navbar-burger" elements
                const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

                // Check if there are any navbar burgers
                if ($navbarBurgers.length > 0) {

                    // Add a click event on each of them
                    $navbarBurgers.forEach(el => {
                        el.addEventListener('click', () => {

                            // Get the target from the "data-target" attribute
                            const target = el.dataset.target;
                            const $target = document.getElementById(target);

                            // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
                            el.classList.toggle('is-active');
                            $target.classList.toggle('is-active');

                        });
                    });
                }

            });
        </script>

        <div class="navbar-brand">
            <a class="navbar-item " href="" https: //besthack.newpage.xyz/ ">
            <div class="header_logo "><img src="<?php echo $way;?>img/stat/logo.png">
            </div></a><div class="navbar-end "><a role="button " class="navbar-burger burger " aria-label="menu " aria-expanded="false " data-target="navbarBasicExample "><span aria-hidden="true "></span><span aria-hidden="true
                "></span><span aria-hidden="true ">
            </span></a></div></div><div id="navbarBasicExample" class="navbar-menu "><div class="navbar-end "><div class="navbar-item has-dropdown is-hoverable "><a class="navbar-link is-arrowless is-arrowless ">Все продукты </a></div><div class="navbar-item
                has-dropdown is-hoverable ">
                <a class="navbar-link is-arrowless " href="<?php echo $way;?>consult">Консультация </a><div class="navbar-item has-dropdown is-hoverable "></div><div class="navbar-item has-dropdown is-hoverable "><a class="navbar-link is-arrowless " href='<?php echo $way;?>/task_choise'>Техподдержка </a></div><div class="navbar-item has-dropdown is-hoverable "><a class="navbar-link is-arrowless is-arrowless "href='<?php echo $way;?>/lk'>Личный кабинет </a></div>
               <?php if($r=check_cookie()){
				if(power_by_id($r)>2){
					echo '<div class="navbar-item has-dropdown is-hoverable ">
            <a class="navbar-link is-arrowless "href="'.$way.'admin">Админ </a></div><div class="navbar-item ">
            </div>';
				}
            echo'<div class="navbar-item has-dropdown is-hoverable ">
            <a class="navbar-link is-arrowless "href="'.$way.'logout">Выход </a></div><div class="navbar-item ">
            </div>';
            
		}  else{
		echo' <div class="navbar-item has-dropdown is-hoverable ">
					<a class="navbar-link
                is-arrowless " href="'.$way.'auth">Авторизация </a>
            </div>';}
          
		?>
            </div></div>
            </nav>
