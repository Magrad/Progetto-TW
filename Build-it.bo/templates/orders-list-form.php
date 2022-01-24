        <div class="wrapper orders-list-wrapper">
            <h1>Lista Ordini: </h1>
            <?php
                if(isset($templateParams['orders']) && count($templateParams['orders']) > 0):
                    $orders = $templateParams['orders'];

                    foreach($orders as $order):
            ?>
                    <div class="border order">
                        <div class="details" id="details-<?php echo $order['id']?>">
                            <div class="order-id">
                                <h1>order <span>#<?php echo $order['id']?></span></h1>
                            </div>
                            <div class="date">
                                <p id="bought-<?php echo $order['id']?>" hidden><?php echo $order['buy_date']; ?></p>
                                <p>Expected Arrival:</p><p id="delivery-<?php echo $order['id']?>"><?php echo $order['delivery_date']; ?></p>
                                <p>USPS:</p> <span>#<?php 
                                    if($order['id_shipping'] == 0) {
                                        echo "Veloce";
                                    } else if( $order['id_shipping'] == 1 ) {
                                        echo "Base";
                                    } else {
                                        echo "Lento";
                                    }
                                ?></span>
                            </div>
                        </div>
                        <?php 
                        require_once 'bootstrap.php';

                        $lists = $dbh->getOrderProductsListByOrder($order['id']);

                        foreach($lists as $list):
                            $item = $dbh->getProductById($list['id_product'])[0];
                            $discount = $item['discount'];
                            $discount_price = $dbh->getProductDiscountedPrice($item['id']);
                        ?>
                            <div class="border item" id="items-<?php echo $order['id']?>">
                                
                                    <img src="<?php echo UPLOAD_DIR . $item['image']; ?>" alt="Immagine <?php echo $item['name']?>" class="lista-img">
                                
                                <div class="item-info">
                                    <div>
                                        <h2>Nome:</h2>
                                        <p class="name"><?php echo $item['name']; ?></p>
                                    </div>
                                    <div>
                                        <h2>Prezzo:</h2>
                                        <?php if($discount > 0): ?>
                                            <div class="item-price">
                                                <p class="price discounted"><?php echo $item['price']; ?></p>
                                                <p class="price"><?php echo $discount_price; ?> €</p>
                                            </div>
                                        <?php else: ?>
                                            <p class="price"><?php echo $item['price']; ?>€</p>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <h2>Quantità:</h2>
                                        <p class="qty"><?php echo $list['quantity']; ?></p>
                                    </div>
                                    <div>
                                        <h2>Prezzo Totale:</h2>
                                        <p class="qty"><?php echo $list['price']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        <div class="track" id="track-<?php echo $order['id']?>" style="display: none">
                            <ul class="text-center progress">
                                <li class="" id="<?php echo $order['id']?>-1">
                                    <div class="status-list">
                                        <img src="./themes/imgs/engineering.png" alt="Immagine ordine processato">
                                        <p>Ordine <br> Processato</p>
                                    </div>
                                </li>
                                <li class="" id="<?php echo $order['id']?>-2">
                                    <div class="status-list">
                                        <img src="./themes/imgs/package-box.png" alt="Immagine ordine spedito">
                                        <p>Ordine <br> Spedito</p>
                                    </div>
                                </li>
                                <li class="" id="<?php echo $order['id']?>-3">
                                    <div class="status-list">
                                        <img src="./themes/imgs/truck.png" alt="Immagine ordine in consegna">
                                        <p>Ordine <br> In transito</p>
                                    </div>
                                </li>
                                <li class="" id="<?php echo $order['id']?>-4">
                                    <div class="status-list">
                                        <img src="./themes/imgs/home.png" alt="Immagine ordine consegnato">
                                        <p>Ordine <br> Consegnato</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <p class="show-more" id="<?php echo $order['id']?>"></p>
                    </div>
                    <?php endforeach; ?>
            <?php else: ?>
                <h3>Nessun ordire eseguito da questo account</h3>
            <?php endif; ?>
        </div>