<?php 
require_once 'bootstrap.php';

/* Checks if the user is logged in or if the user has the right permissions */
if(!isUserLoggedIn() || $dbh->getUserPermissions($_SESSION['user_id'])[0]['permissions'] != 1) {
    /* Returns to the main page */
    header("Location: main.php");
}

/* Checks if the item that wants to be changed or removed exists */
if((isset($_GET['id']) && empty($dbh->getProductById($_GET['id'])))) {
    header("Location: items-manager.php");
}

/* Checks if the submit button has been clicked */
if(isset($_POST['nome-articolo']) && isset($_POST['descrizione_breve-articolo']) &&
 isset($_POST['descrizione-articolo']) && isset($_POST['prezzo-articolo'])) {

    $nome = $_POST['nome-articolo'];
    $descrizione_breve = $_POST['descrizione_breve-articolo'];
    $descrizione = $_POST['descrizione-articolo'];
    $prezzo = floatval($_POST['prezzo-articolo']);
    $return = true;
    
    /* Optional fields that can be left empty */
    $quantita = isset($_POST['quantita-articolo']) ? $_POST['quantita-articolo'] : 0;
    $sconto = isset($_POST['sconto-articolo']) ? $_POST['sconto-articolo'] : 0;
    $img = $_FILES['upload']['name'] != "" ? $_FILES['upload']['name'] : "";
    
    /* Gives different error messages based on the missing fields */
    if(empty($nome)) {
        $templateParams['global-error'] = "Campo Nome richiesto";
    } else if(empty($descrizione_breve)) {
        $templateParams['global-error'] = "Campo Descrizione breve richiesto";
    } else if(empty($descrizione)) {
        $templateParams['global-error'] = "Campo Descrizione richiesto";
    } else if(empty($prezzo)) {
        $templateParams['global-error'] = "Campo Prezzo richiesto";
    } else {
        /* Checks if an image has been uploaded */
        if(isset($_POST['image-upload']) != "") {
            $img = $_FILES['image'];
    
            $target_file = UPLOAD_DIR . basename($img['name']);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
            $check = getimagesize($img['tmp_name']);
            /* Checks image size */
            if($check != false && $img['size'] < 30000) {
                /* Checks image type */
                if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                    /* Checks if the image already exists */
                    if(!file_exists($target_file)) {
                        if(move_uploaded_file($img['tmp_name'], $target_file)) {
                        } else {
                            $msg_out = 0;
                        }
                    }

                    /* Checks if the image has been uploaded correctly */
                    if($msg_out != 0) {
                        $result = $dbh->changeAccountImage($user_id, $img['name']);
                        $msg_out = 1;
                        $user_image = $img['name'];
                    }
                } else {
                    $templateParams['global-error'] = "Errore durante l'aggiornamento: Formato non supportato";
                }
            } else {
                $templateParams['global-error'] = "Errore durante l'aggiornamento: Immagine non accettata";
            }
        }

        /* Checks if admin is trying to add a new item */
        if(!isset($_GET['action']) && !isset($_GET['id'])) {
            if($dbh->isProductNameFree($nome)) {
                $return = $dbh->addProduct($nome, $quantita, $descrizione, $descrizione_breve, $prezzo, $sconto, $img);
            } else {
                $templateParams['global-error'] = "Nome già utilizzato";
            }
        } else if ($_GET['action'] == 1) { /* Checks if the admin is trying to add modify an item */
            if($img == "") $img = $dbh->getProductById($_GET['id'])[0]['image'];
            $return = $dbh->updateProduct($_GET['id'], $nome, $quantita, $descrizione, $descrizione_breve, $prezzo, $sconto, $img);
        } else { /* Checks if the admin is trying to remove an item */
            $dbh->removeProduct($_GET['id']);
        }
        
        if($return == false) {
            header("Location: list-objects.php?success=1");
            exit;
        } else {
            header("Location: list-objects.php?success=0");
            exit;
        }
    }
}

$templateParams['titolo'] = "Build-it - Gestisci oggetti";
$templateParams['nome'] = 'items-manager-form.php';
$templateParams['js'] = array('./js/addImage.js', './js/search.js');
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}
/* Checks if the action is available otherwise load a clean page to add a new item */
if(isset($_GET['action']) && isset($_GET['id']) && ($_GET['action'] == 1 || $_GET['action'] == 2)) {
    $templateParams['articolo'] = $dbh->getProductById($_GET['id']);
} else if(isset($_GET['action'])) {
    header("Location: items-manager.php");
}

require './templates/base.php';
?>