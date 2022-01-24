        <div class="wrapper settings-wrapper">
            <div class="change-image">
                <img src="<?php if(!isset($templateParams['image'])) {
                                echo "./themes/imgs/user-image.png";
                            } else {
                                echo UPLOAD_DIR . $templateParams['image'];
                            }
                ?>" alt="Avatar utente" class="settings-avatar" id="avatar">
                <form action="settings.php" method="post" enctype="multipart/form-data">
                    <label for="upload" id="upload-btn">
                        <img src="./themes/imgs/upload.png" alt="">
                        <span id="text">Seleziona file</span>
                    </label>
                    <input type="file" name="image" id="upload"/>
                    <input class="submit img-submit" type="submit" value="Invia" style="display: none" id="upload-input" name="image-upload">
                </form>
            </div>
            <div class="border-title change-username-container">
                <p class="title"><span>username</span></p>
                <div class="change-username">
                    <h2 class="settings-name"><?php echo $templateParams['username']; ?></h2>
                    <p class="change" id="change-username"></p>
                </div>
                <form action="settings.php" method="post" id="change-username-editor" style="display: none">
                    <label for="username" class="hidden-label-input">Username<input type="text" name="username" id="username" placeholder="<?php echo $templateParams['username']; ?>"></label>
                    <label for="submit-username" class="hidden-label-submit">Invia username<input class="submit" id="submit-username" type="submit" value="Invia"></label>
                </form>
            </div>
            <div class="border-title change-fullname-container">
                <p class="title"><span>nome</span></p>
                <div class="change-fullname">
                    <h3 class="settings-fullname">
                        <?php if(isset($templateParams['fullname'])) {
                                echo $templateParams['fullname'];
                            } else {
                                echo "Aggiungi Nome-Cognome";
                            }
                        ?>
                    </h3>
                    <p class="change" id="change-fullname"></p>
                </div>
                <form action="settings.php" method="post" id="change-fullname-editor" style="display: none">
                        <label for="fullname" class="hidden-label-input">Nome<input type="text" name="fullname" id="fullname" placeholder=
                            <?php if(isset($templateParams['fullname'])) {
                                echo "\"".$templateParams['fullname']."\"";
                            } else {
                                echo "\"Nome Cognome\"";
                            } 
                        ?>></label>
                        <label for="submit-fullname" class="hidden-label-submit">Invia nome<input class="submit" id="submit-fullname" type="submit" value="Invia"></label>
                </form>
            </div>
            <div class="border-title change-email-container">
                <p class="title"><span>email</span></p>
                <div class="change-email">
                    <p class="settings-email"><?php echo $templateParams['email']; ?></p>
                    <p class="change" id="change-email"></p>
                </div>
                <form action="settings.php" method="post" id="change-email-editor" style="display: none">
                    <label for="email" class="hidden-label-input">Email<input type="text" name="email" placeholder="<?php echo $templateParams['email']; ?>" id="email"></label>
                    <label for="submit-email" class="hidden-label-submit">Invia email<input class="submit" id="submit-email" type="submit" value="Invia"></label>
                </form>
            </div>
            <div class="border-title change-address-container">
                <p class="title"><span>indirizzo</span></p>
                <div class="change-address">
                    <p class="settings-address">
                        <?php if(isset($templateParams['address']) && !empty($templateParams['address'])) {
                                echo $templateParams['address'];
                            } else {
                                echo "Aggiungi Indirizzo";
                            }
                        ?>
                    </p>
                    <p class="change" id="change-address"></p>
                </div>
                <form action="settings.php" method="post" id="change-address-editor" style="display: none">
                        <label for="address" class="hidden-label-input">Indirizzo<input type="text" name="address" id="address" placeholder=
                            <?php if(isset($templateParams['address'])) {
                                echo "\"".$templateParams['address']."\"";
                            } else {
                                echo "\"Via, Civico\"";
                            } 
                        ?>></label>
                        <label for="submit-address" class="hidden-label-submit">Invia indirizzo<input class="submit" id="submit-address" type="submit" value="Invia"></label>
                </form>
            </div>
            <div class="border-title change-password-container">
                <p class="title"><span>password</span></p>
                <div class="change-password">
                    <p class="settings-password">Cambia Password</p>
                    <p class="change" id="change-password"></p>
                </div>
                <form action="settings.php" method="post" id="change-password-editor" style="display: none">
                    <div class="div-box">
                        <label for="password" style="font-size: 0;">Password<input type="password" name="password" placeholder="Password" id="password"></label>
                    </div>
                    <div class="div-box">
                        <label for="verify-password" style="font-size: 0;">Verifica password<input type="password" name="verify-password" placeholder="Conferma Password" id="verify-password"></label>
                    </div>
                    <label for="submit-password" style="font-size: 0;">Invia Password<input class="submit" id="submit-password" type="submit" name="submit" value="Conferma"></label>
                </form>
            </div>
        </div>