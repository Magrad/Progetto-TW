<?php 
require_once 'bootstrap.php';

$main = SITE_NAME . " - Home";

/* Checks if we are not currently in the home page saves the variable in session to be used later */
if(isset($_POST['title']) && $_POST['title'] != $main && isset($_POST['text'])) {
    $_SESSION['search'] = $_POST['text'];
}

/* Checks if the search bar contains text */
if(isset($_POST['search'])) {
    $search = $_POST['search'];

    if(strlen($search > 0))
        $result = $dbh->searchProduct($search);
    else 
        $result = $dbh->getProductsList();

    /* Checks the number of characters, if above 0 filters items in the main
       menu that mach the search text */
    if(count($result) > 0) {
        foreach($result as $item) {
            $discount = $item['discount'];
            $price = $discount > 0 ? $dbh->getProductDiscountedPrice($item['id']) : $item['price'];
            
            $whole = (int) $item['price'];
            $fraction = $item['price'] - $whole > 0 ? substr($item['price'], -2) : 0;
            $available = $item['quantity'] > 0 ? 1 : 0;

            $whole_discounted = (int)$price;
            $fraction_discounted = $price - $whole > 0 ? substr(number_format((float)$price, 2, '.', ''), -2) : 0;

            $out = "";
            $out = '<div class="card';
            if(!$available) {
                $out .= ' nAvailable"">';
            } else {
                $out .= '">';
            }
            $out .= '<div class="imgBx">
                        <a href="product.php?id=' . $item['id'] .'">';
            $out .= '       <img src="' . UPLOAD_DIR . $item['image'] . '" alt="Immagine '. $item['name'] .'">
                        </a>
                    </div>';
            if($discount > 0) {
                $out .= '<div class="discount">
                            <p>-' . $discount . '%</p>
                        </div>';
            }
                $out .= '<div class="contentBx">
                        <h3>' . $item['name'] . '</h3>';
            if($fraction > 0) {
                if($discount > 0) {
                    $out .= '<div class=item-price> 
                                <p class="price discounted">' . $whole .'.<small>' . $fraction . '</small></p>
                                <p class="price">' . $whole_discounted .'.<small>' . $fraction_discounted . '</small> €</p>
                            </div>';
                } else {
                    $out .= '<h2 class="price">' . $whole .'.<small>' . $fraction . '</small> €</h2>';
                }
            } else {
                if($discount > 0) {
                    $out .= '<div class=item-price> 
                                <h2 class="price discounted">' . $whole . ' </h2>
                                <h2 class="price">' . $whole_discounted . ' €</h2>
                            </div>';
                } else {
                    $out .= '<h2 class="price">' . $whole . ' €</h2>';
                }
            }
            if($available) {
                $out .= '<a href="main.php?buy=' . $item['id'] .'" class="buy">Buy Now</a>';
            } else {
                $out .= '<h2>Non Disponibile</h2>';
            }
            $out .= '</div>
                </div>';

            echo $out;
        }
    } else {
        echo'<h3 class="no-product">Nessun articolo nel magazzino</h3>';
    }
}

/* Checks if we are in the main page and if a text was saved then clears it */
if(isset($_POST['title']) && $_POST['title'] == $main && isset($_SESSION['search'])) {
    unset($_SESSION['search']);
}

?>