<?php 
$login = "login-form.php";
$register = "register-form.php";
$cart_objects = 0;
if(isset($_SESSION['cart'])) {
    foreach($_SESSION['cart'] as $item) {
        $cart_objects += $item[1];
    }
}

if(isUserLoggedIn()) {
    $permissions = $templateParams['permissions'][0]['permissions'];
}

$link = "main.php";
if(isset($templateParams['main'])) $link = "#";
?>

<!DOCTYPE html>
<html lang="it">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php echo $templateParams["titolo"]; ?></title>
		<link rel="stylesheet" href="./themes/css/styles.css" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <?php if(isReCaptchaRequired()): ?>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <?php endif; ?>
	</head>
	<body>
        <header>
            <div class="header-wrapper">
                <a href="main.php?clear=1" class="id-logo" title="Online shop"></a>
                <div class="search-wrapper">
                        <label for="search" style="font-size: 0;">Ricerca<input type="text" class="search-box" id="search" placeholder="Ricerca articoli" <?php if(isset($_SESSION['search'])) echo 'value="' . $_SESSION["search"] . '"'; ?>></label>
                        <a href="<?php echo $link; ?>"><p class="search-box-submit" id="search-btn" style="font-size: 0;">Invia</p></a>
                </div>
                <?php if(!isset($templateParams['permissions']) || !$permissions): ?>
                <div class="cart-wrapper">
                    <a href="cart.php" class="cart" title="Cart"></a>
                    <p class="cart-items"><?php echo $cart_objects; ?></p>
                </div>
                <?php endif; ?> 
                <div class="dropdown">
                    <button class="menu-button"></button>
                    <div class="dropdown-menu">
                        <div class="dropdown-links">
                            <?php if(isUserLoggedIn()): ?>
                                <img src="./themes/imgs/user-image.png" alt="immagine avatar account utente" class="avatar-image">
                                <?php if(!isset($templateParams['permissions']) || !$permissions): ?>
                                    <a href="./orders-list.php">I miei ordini</a>
                                <?php else: ?>
                                    <a href="./list-objects.php">Gestisci articoli</a>
                                <?php endif; ?> 
                                <a href="./settings.php">Impostazioni</a>
                                <a href="./login.php?logout=1">Logout</a>
                            <?php else: ?>
                                <a href="./login.php">Login</a>
                                <a href="./register.php">Registrati</a>
                            <?php endif; ?>  
                        </div>               
                    </div>                    
                </div>
            </div>
        </header>
        <?php if(isset($templateParams['global-error'])): ?>
                    <div class="alert alert-danger global" role="alert" id="global-alert">
                        <p><?=$templateParams['global-error']; ?></p>
                        <p class="hide-error" id="close-error"></p>
                    </div>
        <?php endif; ?>
        <?php if(isset($templateParams['global-success'])): ?>
                    <div class="alert alert-success global" role="alert" id="global-alert">
                        <p><?=$templateParams['global-success']; ?></p>
                        <p class="hide-error" id="close-error"></p>
                    </div>
        <?php endif; ?>
        <div class="main-container">
            <?php if(!isset($templateParams["no-aside"])): ?>
            <aside>
                <div class="wrapper aside-wrapper">
                    <h2>Categorie Prodotti:</h2>
                    <ul>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">Processore</a>
                            <ul>
                                <li><a href="<?php echo $link; ?>" class="aside">Processore AMD</a></li>
                                <li><a href="<?php echo $link; ?>" class="aside">Processore Intel</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">Scheda Madre</a>
                        </li>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">Scheda Video</a>
                            <ul>
                                <li><a href="<?php echo $link; ?>" class="aside">Scheda Video AMD</a></li>
                                <li><a href="<?php echo $link; ?>" class="aside">Scheda Video Nvidia</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">RAM</a>
                        </li>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">HDD</a>
                        </li>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">Alimentatore</a>
                        </li>
                        <li>
                            <a href="<?php echo $link; ?>" class="aside">Accessori</a>
                            <ul>
                                <li><a href="<?php echo $link; ?>" class="aside">Dissipatore</a></li>
                                <li><a href="<?php echo $link; ?>" class="aside">Ventole</a></li>
                                <li><a href="<?php echo $link; ?>" class="aside">Tastiera</a></li>
                                <li><a href="<?php echo $link; ?>" class="aside">Mouse</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </aside>
            <?php endif; ?>
            <main>
                <?php if(isset($templateParams["nome"])) {
                    require($templateParams["nome"]);
                }
                ?>
            </main>
        </div>
        <footer>
            <a href="./contatti.php">Contatti</a>         
            <p>Progetto Tecnologie Web - A.A. 2021/2022</p>
        </footer>
        <?php
        if(isset($templateParams["js"])):
            foreach($templateParams["js"] as $script):
        ?>
            <script src="<?php echo $script; ?>"></script>
        <?php
            endforeach;
        endif;
        ?>
        <script src="./js/hideGlobalError.js"></script>
	</body>
</html>
