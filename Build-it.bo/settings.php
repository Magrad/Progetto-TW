<?php
require_once 'bootstrap.php';

/* Checks if user is logged in otherwise gets redirected */
if(isUserLoggedIn()) {
    $user_id = $_SESSION['user_id'];
    $user_email = $_SESSION['user_email'];

    /* Gets current user informations */
    $user_settings = $dbh->getUserInformations($user_id, $user_email)[0];

    $user_username = $user_settings['username'];
    $user_fullname = $user_settings['fullname'];
    $user_image = $user_settings['image'];
    $user_address = $user_settings['address'];
    $msg_out = -1;

    /* Checks if an image has been uploaded */
    if(isset($_POST['image-upload'])) {
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

                if($msg_out != 0) {
                    $result = $dbh->changeAccountImage($user_id, $img['name']);
                    $msg_out = !$result ? 1 : 0;
                    $user_image = $img['name'];
                }
            } else {
                $templateParams['global-error'] = "Errore durante l'aggiornamento: Formato non supportato";
            }
        } else {
            $templateParams['global-error'] = "Errore durante l'aggiornamento: Immagine non accettata";
        }
    }
    /* Changes the username if the input contains text */
    if(isset($_POST['username'])) {
        $user_username = $_POST['username'];
        if(!empty($user_username)) {
            $result = $dbh->changeAccountUsername($user_id, $user_username);
            $msg_out = !$result ? 1 : 0;
        } else {
            $msg_out = 1;      
        }
    }
    /* Changes the fullname if the input contains text */
    if(isset($_POST['fullname'])) {
        $user_fullname = $_POST['fullname'];
        $user_fullname = empty($user_fullname) ? NULL : $user_fullname;

        $result = $dbh->changeAccountFullname($user_id, $user_fullname);
        $msg_out = !$result ? 1 : 0;
    }
    /* Changes the email if the input contains text */
    if(isset($_POST['email'])) {
        $email = $_POST['email'];

        $result = $dbh->getUserEmail($user_id)[0];
        if($result['email'] != $email) {
            /* Checks email validity */
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $templateParams['global-error'] = "Email invalida";
            } else {
                if($dbh->isEmailAvailable($email)) {
                    $result = $dbh->changeAccountEmail($user_id, $email);
                    $msg_out = !$result ? 1 : 0;
                    $user_email = $email;
                } else {
                    $templateParams['global-error'] = "Errore durante l'aggiornamento: Email già in uso";
                }
            }
        } else {
            $templateParams['global-error'] = "Errore durante l'aggiornamento: Email uguali";
        }
    }
    /* Changes the address if the input contains text */
    if(isset($_POST['address'])) {
        $address = $_POST['address'];
        $address = empty($address) ? NULL : $address;

        $result = $dbh->changeAccountAddress($user_id, $address);
        $msg_out = !$result ? 1 : 0;
        $user_address = $address;
    }
    /* Changes the password if the input contains text */
    if(isset($_POST['password'])) {
        $password = $_POST['password'];

        if(empty(checkPasswordIntegrity($password))) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $result = $dbh->changeAccountPassword($user_id, $hashed_password);
            $msg_out = !$result ? 1 : 0;
        } else {
            $msg_out = 1;
        }
    }
} else {
    header("Location: main.php");
}

$templateParams['username'] = $user_username;
$templateParams['fullname'] = $user_fullname;
$templateParams['email'] = $user_email;
$templateParams['image'] = $user_image;
$templateParams['address'] = $user_address;
$templateParams['titolo'] = "Build-it - Settings";
$templateParams['nome'] = 'settings-form.php';
$templateParams['js'] = array('./js/addImage.js', './js/settings-editors.js', './js/search.js');
if(isset($_SESSION['user_id'])) {
    $templateParams['permissions'] = $dbh->getUserPermissions($_SESSION['user_id']);
}

/* Shows and error if something went wrong */
if($msg_out == 1) {
    $templateParams['global-error'] = "Errore durante l'aggiornamento";
}
/* Shows success if everything went smoothe */
if($msg_out == 0) {
    $templateParams['global-success'] = "Cambiamento effettuato con successo";
}

/* Valid address required to make an order */
if(isset($_GET['address']) && $_GET['address'] == 1) {
    $templateParams['global-error'] = "Indirizzo valido richiesto per eseguire un ordine";
}

require 'templates/base.php';
?>