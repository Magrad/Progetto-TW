        <?php 
        $CONST_NAME = SITE_NAME . " - Order";
        $nome = $templateParams['titolo'];
        if(isset($templateParams['ordine'])) $id = $templateParams['ordine']['id'];
        $tot = 0;
        $order_quantity = 0;
        $discount = 0;
        ?>        
        <div class="wrapper border cart-form-wrapper">
            <?php if($nome == $CONST_NAME): ?>
                <form action="./order.php" method="post">
                    <h2>Ordine #<?php echo (int)++$id; ?></h2>
            <?php else: ?>
                <h2>Carrello</h2>
            <?php endif; ?>
            <div class="list">
                <ul>
                    <?php if(isset($templateParams['articoli']) && count($templateParams['articoli']) > 0): ?>
                        <?php foreach($templateParams['articoli'] as $elemento): ?>
                        <?php 
                            $articolo = $elemento[0];
                            $quantity = $elemento[1];
                            $tot += $articolo['price'];
                            $order_quantity++;
                            $discount += $dbh->calculateItemSaving($articolo['id']);
                            $item_discount = $articolo['discount'];
                            $discounted_price = $dbh->getProductDiscountedPrice($articolo['id']);
                        ?>
                        <li>
                            <?php if($nome != $CONST_NAME):?>
                                <form action="./cart.php" method="post">
                            <?php endif; ?>
                                <div class="border product">
                                    <img src="<?php echo UPLOAD_DIR . $articolo['image']; ?>" alt="Immagine <?php echo $articolo['name']?>" class="lista-img">
                                    <div class="product-info">
                                        <p class="name"><?php echo $articolo['name']; ?></p>
                                    <?php if($item_discount > 0):?>
                                        <div class="item-price">
                                            <p class="price discounted"><?php echo $articolo['price'];?></p>
                                            <p class="price"><?php echo $discounted_price; ?>€</p>
                                        </div>
                                    <?php else: ?>
                                        <p class="price"><?php echo $articolo['price']; ?>€</p>
                                    <?php endif; ?>
                                    <?php if($nome == $CONST_NAME): ?>
                                        <input type="hidden" class="product-id" value="<?php echo $articolo['id']?>">
                                        <label for="qty-number" style="font-size: 0;">Quantità<input type="number" id="qty-number" class="qty-input submit" min="0" max="<?php echo $articolo['quantity']; ?>" onkeydown="return false" value=<?php echo $quantity; ?>></label>
                                    <?php else: ?>
                                        <input type="submit" class="submit" value="Rimuovi" id="<?php echo $articolo['id']; ?>" name="<?php echo $articolo['id']; ?>">
                                    <?php endif; ?>
                                    </div>
                                </div>
                            <?php if($nome != $CONST_NAME): ?>
                                </form>
                            <?php endif; ?>
                        </li>      
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h3>Nessun articolo selezionato</h3>
                    <?php endif; ?>
                </ul>
                <div class="border cart-total" id="cart">
                </div>
            </div>
            <?php if($nome == $CONST_NAME): ?>
                </form>
            <?php endif; ?>
        </div>