<?php
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$products = array();
$subtotal = 0.00;

if ($products_in_cart) {
    
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $konekcija->prepare('SELECT * FROM proizvodi WHERE id IN (' . $array_to_question_marks . ')');
    $stmt->execute(array_keys($products_in_cart));
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($products as $product) {
        $subtotal += (float)$product['cena'] * (int)$products_in_cart[$product['id']];
    }
}

if (!isset($_SESSION['korisnik'])) {
    echo "<h4 class='text-body m-4'>To access the page, you need to <a href='index.php?page=login'>log in.</a></h4>";
} else {
?>
<body>
    <div class="container">
        <div class='border-start border-5 border-primary ps-5 mb-5'>
            <h1 class='display-5 text-uppercase mb-0'>Cart</h1>
        </div>
        <form action="" method="post">
            <table class="timetable_sub" id="cart" style="font-variant:normal;">
                <thead>
                    <tr>
                        <td colspan="3">Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="5" style="text-align:center;">You have no products added in your Shopping Cart</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td class="img">
                                    <a href="index.php?page=details&id=<?=$product['id']?>">
                                        <img src="<?=$product['slika']?>" width="50" height="50" alt="<?=$product['naziv']?>">
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?page=details&id=<?=$product['id']?>"><?=$product['naziv']?></a>
                                    <br>
                                </td>
                                <td>
                                    <a href="index.php?page=cart&remove=<?=$product['id']?>" class="remove">Remove</a>
                                </td>
                                <td class="price">&dollar;<?=$product['cena']?></td>
                                <td class="quantity">
                                    <p name="quantity-<?=$product['id']?>"><?=$products_in_cart[$product['id']]?></p>
                                </td>
                                <td class="price">&dollar;<?=$product['cena'] * $products_in_cart[$product['id']]?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <div class="timetable_sub" colspan="5" style="text-align:right;">
                <span class="text">Subtotal</span>
                <span class="price">&dollar;<?=$subtotal?></span>
            </div>
            <div class="buttons">
                <button type="submit" name="clear" class="btn" style="background-color: #7AB730;">
                    <a style="color:white;" href="index.php?page=cart&clearCart=1" class="remove">Clear Cart</a>
                </button>
                <input type='button' id='order' value='Order' name='order' class="btn" style="background-color: #7AB730; color:white;">

            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
      <script src="lib/easing/easing.min.js"></script>
      <script src="lib/waypoints/waypoints.min.js"></script>
      <script src="lib/owlcarousel/owl.carousel.min.js"></script>
      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script src="js/main.js"></script>


</body>
</html>
<?php
}


if (isset($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    unset($_SESSION['cart'][$_GET['remove']]);
    echo '<script>window.location.href = "index.php?page=cart";</script>';
    exit(); 
}

if (isset($_GET['clearCart']) && isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
    echo '<script>window.location.href = "index.php?page=cart";</script>';
    exit();
}
?>
