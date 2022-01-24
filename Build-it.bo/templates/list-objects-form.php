
        <div class="wrapper list-objects-wrapper">
            <h2>Lista Articoli</h2>
            <div class="list">
                <?php if(isset($templateParams['articoli'])): ?>
                    <ul>
                    <?php foreach($templateParams['articoli'] as $articolo): ?>
                        <li>
                        <div class="border articolo">
                            <img src="<?php echo UPLOAD_DIR . $articolo['image']; ?>" alt="Immagine <?php echo $articolo['name']?>" class="lista-img">
                            <table>
                                <tr>
                                    <th id="id">Id</th><th id="nome">Nome</th><th id="azione">Azione</th>
                                </tr>
                                <tr>
                                    <td id="<?php echo $articolo['id']?>"><p class="lista-id"><?php echo $articolo['id']?></p></td>
                                    <td headers="nome <?php echo $articolo['name']?>"><p class="lista-nome"><?php echo $articolo['name']?></p></td>
                                    <td headers="azione <?php echo $articolo['name']?>">
                                        <a href="items-manager.php?action=1&id=<?php echo $articolo['id']; ?>">Modifica</a>
                                        <a href="items-manager.php?action=2&id=<?php echo $articolo['id']; ?>">Elimina</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        </li>      
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            <a href="./items-manager.php" class="a-submit">Aggiungi Articolo</a>
        </div>