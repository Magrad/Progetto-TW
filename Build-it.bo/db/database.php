<?php
class DatabaseHelper{
    private $db;

    /* Create a connection to the MySQLi server*/
    public function __construct($servername, $username, $password, $dbname, $port){
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }        
    }
    
    /* Checks if an email exists for authentication */
    public function authentication($email) {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $msg = "";

        if($result->num_rows == 1) {
            return array(0,$result->fetch_all(MYSQLI_ASSOC));
        }
        
        return array(1, "Username o Password errati");
    }

    /* Checks if an email is already present inside the database */
    public function isEmailAvailable($email) {
        $stmt = $this->db->prepare("SELECT email FROM accounts WHERE email=?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            return 1;
        }

        return 0;
    }

    /* Creates a new account in the database */
    public function createNewAccount($username, $password, $email) {
        $permissions = 0;
        $stmt = $this->db->prepare("INSERT INTO accounts (username, password, email, permissions) VALUES (?, ?, ?, $permissions)");
        $stmt->bind_param('sss', $username, $password, $email);
        return $stmt->execute();
    }

    /* Gets all of the informations associated to an account */
    public function getUserInformations($id, $email) {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE id=? AND email=?");
        $stmt->bind_param('is', $id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);        
    }

    /* Gets the email of an account by its ID */
    public function getUserEmail($id) {
        $stmt = $this->db->prepare("SELECT email FROM accounts WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets the user permissions by its ID */
    public function getUserPermissions($id) {
        $stmt = $this->db->prepare("SELECT permissions FROM accounts WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Updates the account image */
    public function changeAccountImage($id, $img) {
        $stmt = $this->db->prepare("UPDATE accounts SET image = ? WHERE id = ?");
        $stmt->bind_param('si', $img, $id);

        return $stmt->execute();;
    }

    /* Updates the account username */
    public function changeAccountUsername($id, $username) {
        $stmt = $this->db->prepare("UPDATE accounts SET username = ? WHERE id = ?");
        $stmt->bind_param('si', $username, $id);

        return $stmt->execute();
    }

    /* Updates the account fullname */
    public function changeAccountFullname($id, $fullname) {
        $stmt = $this->db->prepare("UPDATE accounts SET fullname = ? WHERE id = ?");
        $stmt->bind_param('si', $fullname, $id);
        
        return $stmt->execute();
    }

    /* Updates the account email */
    public function changeAccountEmail($id, $email) {
        $stmt = $this->db->prepare("UPDATE accounts SET email = ? WHERE id = ?");
        $stmt->bind_param('si', $email, $id);
        
        return $stmt->execute();
    }

    /* Updates the account address */
    public function changeAccountAddress($id, $address) {
        $stmt = $this->db->prepare("UPDATE accounts SET address = ? WHERE id = ?");
        $stmt->bind_param('si', $address, $id);
        
        return $stmt->execute();
    }

    /* Updates the account password */
    public function changeAccountPassword($id, $password) {
        $stmt = $this->db->prepare("UPDATE accounts SET password = ? WHERE id = ?");
        $stmt->bind_param('si', $password, $id);
        
        return $stmt->execute();
    }

    /* Checks for products in the database that contains a specific keyword 
       in the description, description_short field or in the name */
    public function searchProduct($search) {
        $search = "%$search%";
        $stmt = $this->db->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ? OR description_short LIKE ?");
        $stmt->bind_param('sss', $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Creates a new product in the database */
    public function addProduct($name, $quantity, $description, $description_short, $price, $discount, $img) {
        $stmt = $this->db->prepare("INSERT INTO products (name, quantity, description, description_short, price, discount, image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sissdis', $name, $quantity, $description, $description_short, $price, $discount, $img);
        return $stmt->execute();
    }

    /* Checks if a product's name is already in the database */
    public function isProductNameFree($name) {
        $stmt = $this->db->prepare("SELECT name FROM products WHERE name=?");
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            return 1;
        }

        return 0;
    }

    /* Gets all the products in the database */
    public function getProductsList() {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY (SELECT CASE WHEN quantity > 0 THEN 1 ELSE 0 END AS stock) DESC");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets a single product by its ID */
    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets a single product name by its ID */
    public function getProductName($id) {
        $stmt = $this->db->prepare("SELECT name FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets a single product quantity by its ID */
    public function getProductQuantity($id) {
        $stmt = $this->db->prepare("SELECT quantity FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets a single product price by its ID */
    public function getProductPrice($id) {
        $stmt = $this->db->prepare("SELECT price, discount FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets a single product discount by its ID */
    public function getProductDiscountedPrice($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_all(MYSQLI_ASSOC)[0];

        $price = $item['price'];
        $discount = $item['discount'];

        return $price * (1 - ($discount / 100));
    }

    /* Calculates how much is an user saving per product */
    public function calculateItemSaving($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_all(MYSQLI_ASSOC)[0];

        $price = $item['price'];
        $discount = $item['discount'];

        return $price - $price * (1 - ($discount / 100));
    }

    /* Updates a product */
    public function updateProduct($id, $name, $quantity, $description, $description_short, $price, $discount, $img) {
        $stmt = $this->db->prepare("UPDATE products SET name=?, quantity=?, description=?, description_short=?, price=?, discount=?, image=? where id=?");
        $stmt->bind_param('sissdisi', $name, $quantity, $description, $description_short, $price, $discount, $img, $id);

        return $stmt->execute();
    }

    /* Reduces by one the quantity of a product */
    public function reduceProductQuantity($id) {
        $stmt = $this->db->prepare("SELECT quantity FROM products WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        $quantity = $result->fetch_all(MYSQLI_ASSOC)[0]['quantity'];
        $quantity--;

        $stmt = $this->db->prepare("UPDATE products SET quantity=? WHERE id=?");
        $stmt->bind_param('ii', $quantity, $id);

        return $stmt->execute();
    }

    /* Removes a product from the database */
    public function removeProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param('i', $id);

        return $stmt->execute();
    }

    /* Creates a list of information per product required to create an order */
    public function addNewProductsList($id_order, $id_product, $quantity, $price) {
        $stmt = $this->db->prepare("INSERT INTO `products_list` (id_order, id_product, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiid', $id_order, $id_product, $quantity, $price);
        return $stmt->execute();
    }

    /* Gets all of the products in an order by the order ID */
    public function getOrderProductsList($id) {
        $stmt = $this->db->prepare("SELECT * FROM `products_list` WHERE id_order=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets all of the orders made by an user */
    public function getUserOrders($user_id) {
        $stmt = $this->db->prepare("SELECT * FROM `orders` WHERE id_user=?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets all of the products in an order by the order_id */
    public function getOrderProductsListByOrder($order_id) {
        $stmt = $this->db->prepare("SELECT * FROM `products_list` WHERE id_order=?");
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Adds a new order made by an user */
    public function addNewOrder($total_price, $comments, $id_user, $buy_date) {
        if($comments == "") $comments = NULL;
        $id_shipping = rand(0, 2);
        if($id_shipping == 0) {
            $delivery_date = date("Y-m-d H:i:s a", strtotime("+30 seconds"));
        } else {
            $delivery_date = $id_shipping == 1 ? date("Y-m-d H:i:s a", strtotime("+1 minutes")) : date("Y-m-d H:i:s a", strtotime("+2 minutes"));
        }

        $stmt = $this->db->prepare("INSERT INTO `orders` (id_shipping, total_price, comments, id_user, buy_date, delivery_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('idsiss', $id_shipping, $total_price, $comments, $id_user, $buy_date, $delivery_date);
        return $stmt->execute();
    }

    /* Gets the ID of the last order made */
    public function getNewOrderId() {
        $stmt = $this->db->prepare("SELECT ifnull(MAX(id), '0') as id FROM orders");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC)[0];
    }

    /* Creates an admin notification */
    public function addAdminNotification($id_product) {
        $permissions = 1;
        $text = "Esaurita disponibilità prodotto: ";
        $seen = 0;

        $stmt = $this->db->prepare("INSERT INTO notifications (permissions, id_product, text, seen) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iisi', $permissions, $id_product, $text, $seen);
        return $stmt->execute();
    }

    /* Checks if an admin notification is already in the database by id_product*/
    public function adminNotificationAlreadyExists($id_product) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE id_product = ?");
        $stmt->bind_param('i', $id_product);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 0) {
            return 0;
        }

        return 1;
    }

    /* Creates a notification of an user */
    public function addUserNotification($id_user, $id_order, $order_step) {
        $permissions = 0;
        $text = "Ordine in elaborazione";
        $seen = 0;

        $stmt = $this->db->prepare("INSERT INTO notifications (permissions, id_user, id_order, order_step, text, seen) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('iiiisi', $permissions, $id_user, $id_order, $order_step, $text, $seen);
        return $stmt->execute();
    }

    /* Checks if a notification already exists for an user */
    public function userNotificationAlreadyExists($user_id, $id_order) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE id_user = ? AND id_order = ?");
        $stmt->bind_param('ii', $user_id, $id_order);
        $stmt->execute();      
        $result = $stmt->get_result();

        if($result->num_rows == 0) {    
            return 0;
        }

        return 1;
    }

    /* Updates an user notification based on its id_order */
    public function updateUserNotification($id_order, $order_step, $changed) {
        $text = "";
        
        if($order_step == 1) {
            $text = "Ordine pronto per essere spedito";
        } else {
            $text = $order_step == 2 ? "Ordine spedito" : "Ordine consegnato"; 
        }

        if(!$changed) {
            $stmt = $this->db->prepare("UPDATE notifications SET order_step = ?, text = ? WHERE id_order = ?");
            $stmt->bind_param('isi', $order_step, $text, $id_order);
        } else {
            $stmt = $this->db->prepare("UPDATE notifications SET order_step = ?, text = ?, seen = 0 WHERE id_order = ?");
            $stmt->bind_param('isi', $order_step, $text, $id_order);
        }

        return $stmt->execute();
    }

    /* Gets the step of an order by its order id */
    public function getStepUserNotifications($id_order) {
        $stmt = $this->db->prepare("SELECT order_step FROM notifications WHERE id_order = ?");
        $stmt->bind_param('i', $id_order);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Gets all of the admin notifications */
    public function getAdminNotifications() {
        $stmt = $this->db->prepare("SELECT id_product, text FROM notifications WHERE permissions = 1 AND seen = 0");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Updates the seen state of an admin notification */
    public function checkAdminNotifications($id_product) {
        $has_been_seen = 1;
        $stmt = $this->db->prepare("UPDATE notifications SET seen = ? WHERE id_product = ?");
        $stmt->bind_param('ii', $has_been_seen, $id_product);

        return $stmt->execute();
    }

    /* Updates the seen state of an admin notification */
    public function uncheckAdminNotifications($id_product) {
        $has_been_seen = 0;
        $stmt = $this->db->prepare("UPDATE notifications SET seen = ? WHERE id_product = ?");
        $stmt->bind_param('ii', $has_been_seen, $id_product);

        return $stmt->execute();
    }

    /* Gets all of the user norifications */
    public function getUserNotifications($id_user) {
        $stmt = $this->db->prepare("SELECT * FROM notifications WHERE id_user = ? AND seen = 0");
        $stmt->bind_param('i', $id_user);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /* Updates the seen state of an user notification */
    public function checkUserNotifications($id_order, $order_step) {
        $has_been_seen = 1;
        $stmt = $this->db->prepare("UPDATE notifications SET seen = ? WHERE id_order = ? AND order_step = ?");
        $stmt->bind_param('iii', $has_been_seen, $id_order, $order_step);

        return $stmt->execute();
    }
}
?>