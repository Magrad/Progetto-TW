        <?php 
            $item;

            if(isset($templateParams['product']) && !empty($templateParams['product'])) {
                $item = $templateParams['product'];
                $discount = $item['discount'];
                $price = $discount > 0 ? $dbh->getProductDiscountedPrice($item['id']) : $item['price'];
                $whole = (int) $item['price'];
                $fraction = $item['price'] - $whole > 0 ? substr($item['price'], -2) : 0;
                $available = $item['quantity'] > 0 ? 1 : 0;

                $whole_discounted = (int)$price;
                $fraction_discounted = $price - $whole > 0 ? substr(number_format((float)$price, 2, '.', ''), -2) : 0;
            }
        ?>
        <div class="wrapper product-wrapper">
            <?php if(!empty($item)): ?>
            <div class="single-item-name">
                <h2><?php echo $item['name']?></h2>
            </div>
            <?php if($discount > 0): ?>
                <div class="discount single-item-discount">
                    <p>-<?php echo $discount; ?>%</p>
                </div>
            <?php endif; ?>
            <div class="single-item">
                <img src="<?php echo UPLOAD_DIR . $item['image']; ?>" alt="Immagine <?php echo $item['name']?>">
                <div class="product-info single-item-info">
                    <?php if($discount > 0): ?>
                        <div class=item-price> 
                            <h2>Prezzo: </h2>
                            <h2 class="discounted"><?=$whole?>.<small><?=$fraction?></small></h2>
                            <h2><?=$whole_discounted; ?>.<small><?=$fraction_discounted?></small> €</h2>
                        </div>
                    <?php else: ?>
                    <h2>Prezzo: <?php echo $whole; ?>.<?php echo $fraction; ?> €</h2>
                    <?php endif; ?>
                    <h2>Disponibilità: </h2>
                    <p><?php echo $item['quantity']; ?></p>
                    <h2>Descrizione: </h2>
                    <p><?php echo $item['description_short']; ?></p>
                </div>
            </div>
            <h2>Caratteristiche: </h2>
            <p><?php echo $item['description']; ?></p>
            <?php else: ?>
                <h2>Articolo non presente nel database</h2>
            <?php endif; ?>
        </div>