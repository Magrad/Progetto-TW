        <?php
            $present = isset($templateParams['articolo']);
            if($present && empty($templateParams['articolo'])) {
                header("Location: list-objects.php?success=1");
            }
            $articolo = $present ? $templateParams['articolo'][0] : NULL;
            $remove = "";
            if(isset($_GET['action']) && $_GET['action'] == 2) $remove = $_GET['action'];
        ?>
        <div class="wrapper items-manager">
            <form action="./items-manager.php<?php if(isset($_GET['action']) && isset($_GET['id'])) echo "?action=" . $_GET['action'] . "&id=" . $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                <h2>Gestisci Articolo</h2>
                <div class="fields">
                    <div class="nome-articolo">
                        <label for="nome-articolo">Nome</label>
                        <input type="text" id="nome-articolo" name="nome-articolo"
                        <?php if(!$present) echo "placeholder=\"Nome\""; 
                              else echo "value=\"" . $articolo['name'] . "\"";
                        ?> <?php if(!empty($remove)) echo "readonly"?>/>
                    </div>
                    <div class="quantita-articolo">
                        <label for="quantita-articolo">Quantità</label><input type="number" min="0" id="quantita-articolo" name="quantita-articolo" 
                            <?php if(!$present) echo "placeholder=\"0\""; 
                                  else echo "value=\"" . $articolo['quantity'] . "\"";
                            ?> <?php if(!empty($remove)) echo "readonly"?>/>
                    </div>
                    <div class="descrizione_breve-articolo">
                        <label for="descrizione_breve-articolo">Descrizione Breve</label>
                        <textarea id="descrizione_breve-articolo" name="descrizione_breve-articolo" <?php if(!$present) echo "placeholder=\"Descrizione\""; ?> <?php if(!empty($remove)) echo "readonly"?>><?php if($present) echo $articolo['description_short']; ?></textarea>
                    </div>
                </div>
                <div class="descrizione-articolo">
                    <label for="descrizione-articolo">Descrizione</label>
                    <textarea id="descrizione-articolo" name="descrizione-articolo" <?php if(!$present) echo "placeholder=\"Descrizione\""; ?> <?php if(!empty($remove)) echo "readonly"?>><?php if($present) echo $articolo['description']; ?></textarea>
                </div>
                <div class="prezzo-articolo">
                    <label for="prezzo-articolo">Prezzo</label>
                    <input type="number" step="0.01" min="0" id="prezzo-articolo" name="prezzo-articolo"
                    <?php if(!$present) echo "placeholder=\"€\""; 
                          else echo "value=\"" . $articolo['price'] . "\"";
                    ?> <?php if(!empty($remove)) echo "readonly"?>/>
                </div>
                <div class="sconto-articolo">
                    <label for="sconto-articolo">Sconto</label>
                    <input type="number" min="0" id="sconto-articolo" name="sconto-articolo"
                    <?php if(!$present) echo "placeholder=\"10%\""; 
                          else echo "value=\"" . $articolo['discount'] . "\"";
                    ?> <?php if(!empty($remove)) echo "readonly"?>/>
                </div>
                <div class="immagine-articolo">
                    <p>Immagine</p>
                    <img src="<?php if(!isset($articolo['image'])) {
                                        echo "./themes/imgs/item-placeholder.png";
                                    } else {
                                        echo UPLOAD_DIR . $articolo['image'];
                                    }
                        ?>" alt="Immagine articolo" class="img-articolo">
                        <label for="upload" id="upload-btn" <?php if(!empty($remove)) echo 'style="display: none"'?>>
                            <img src="./themes/imgs/upload.png" alt="">
                            <span id="text">Seleziona file</span>
                        </label>
                        <input type="file" name="upload" id="upload"/>
                </div>
                <input class="submit" type="submit" value="<?php
                        if(!isset($_GET['action'])) echo "Aggiungi";
                        if(isset($_GET['action']) && $_GET['action'] == 1) echo "Aggiorna";
                        if(isset($_GET['action']) && $_GET['action'] == 2) echo "Elimina";
                    ?>" id="upload-element" name="upload-element">
                <a href="./list-objects.php" class="a-submit">Indietro</a>
            </form>
        </div>