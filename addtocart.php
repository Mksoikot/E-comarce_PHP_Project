<?php
session_start();
    require_once "admin/class/adminBack.php";
    $obj = new adminBack();
    $ctg = $obj->published_display_category();
    $ctgdatas = array();
    while($data = mysqli_fetch_assoc($ctg)){
        $ctgdatas[] = $data;
    }
    if(isset($_GET['status'])){
        $catId = $_GET['id'];
        if($_GET['status']== 'catView'){
            $proData = $obj->product_by_category($catId);
            $pros = array();
            while($proDatas = mysqli_fetch_assoc($proData)){
                $pros[]= $proDatas;
            }
        }
    }
    if(isset($_GET['status'])){
        $catId = $_GET['id'];
        if($_GET['status']== 'catView'){
            $category_name = $obj->ctg_by_id($catId);
            }
        }

        if(isset($_POST['addtocart'])){
            if(isset($_SESSION['cart'])){
                $product_name = array_column($_SESSION['cart'],'pdt_name');
                if(in_array($_POST['pdt_name'],$product_name)){
                    echo "
                        <script>
                        alert('This product Already Added!');
                        </script>
                    ";
                }
               else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count]=array(
                    'pdt_name'=> $_POST['pdt_name'],
                    'pdt_image'=> $_POST['pdt_image'],
                    'pdt_price'=> $_POST['pdt_price'],
                    'quantity'=> 1,
                );
               }
            }
            else {
                $_SESSION['cart'][0]=array(
                    'pdt_name'=> $_POST['pdt_name'],
                    'pdt_image'=> $_POST['pdt_image'],
                    'pdt_price'=> $_POST['pdt_price'],
                    'quantity'=> 1,
                );
            }
        }
        if(isset($_POST['remove_product'])){
            
        }
?>
<?php
    require_once "includes/head.php";
?>

<body class="biolife-body">

    <?php
    require_once "includes/preloader.php";
?>

    <!-- HEADER -->
    <header id="header" class="header-area style-01 layout-03">
        <?php require_once "includes/header_top.php"; ?>
        <?php require_once "includes/header_middle.php"; ?>
        <?php require_once "includes/header_bottom.php"; ?>
    </header>

    <!-- Page Contain -->
    <div class="page-contain">

        <!-- Main content -->
        <div id="main-content" class="main-content">
            <div class="container">
                <br>
                <!--Cart Table-->
                <div class="shopping-cart-container">
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <h3 class="box-title">Your cart items</h3>
                            <form class="shopping-cart-form" action="#" method="post">
                                <table class="shop_table cart-form">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product Name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Remove</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(isset($_SESSION['cart'])){foreach($_SESSION['cart'] as $key=>$value){ ?>
                                        <tr class="cart_item">
                                            <td class="product-thumbnail" data-title="Product Name">
                                                <a class="prd-thumb" href="#">
                                                    <figure><img width="113" height="113"
                                                            src="admin/upload/<?php echo $value['pdt_image']; ?>"
                                                            alt="shipping cart"></figure>
                                                </a>
                                                <a class="prd-name" href="#"><?php echo $value['pdt_name']; ?></a>
                                                <!-- <div class="action">
                                                    <a href="#" class="edit"><i class="fa fa-pencil"
                                                            aria-hidden="true"></i></a>
                                                    <a href="#" class="remove"><i class="fa fa-trash-o"
                                                            aria-hidden="true"></i></a>
                                                </div> -->
                                            </td>
                                            <td class="product-price" data-title="Price">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span
                                                                class="currencySymbol">৳</span><?php echo $value['pdt_price']; ?></span></ins>
                                                    <!-- <del><span class="price-amount"><span
                                                                class="currencySymbol">£</span>95.00</span></del> -->
                                                </div>
                                            </td>
                                            <td class="product-quantity" data-title="Quantity">
                                                <form action="" method="POST">
                                                    <input type="hidden" name="remove_product_name" value="<?php echo $value['pdt_name']; ?>">
                                                    <input type="submit" value="Remove" name="remove_product" class="btn btn-warning">
                                                </form>
                                            </td>
                                            <td class="product-subtotal" data-title="Total">
                                                <div class="price price-contain">
                                                    <ins><span class="price-amount"><span
                                                                class="currencySymbol">£</span>85.00</span></ins>
                                                    <del><span class="price-amount"><span
                                                                class="currencySymbol">£</span>95.00</span></del>
                                                </div>
                                            </td>
                                        </tr>
                                            <?php }}else{
                                                echo "Your Product Is Now Empty!";
                                            } ?>
                                        <tr class="cart_item wrap-buttons">
                                            <td class="wrap-btn-control" colspan="4">
                                                <a class="btn back-to-shop">Back to Shop</a>
                                                <button class="btn btn-update" type="submit" disabled>update</button>
                                                <button class="btn btn-clear" type="reset">clear all</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div class="shpcart-subtotal-block">
                                <div class="subtotal-line">
                                    <b class="stt-name">Subtotal <span class="sub">(2ittems)</span></b>
                                    <span class="stt-price">£170.00</span>
                                </div>
                                <div class="subtotal-line">
                                    <b class="stt-name">Shipping</b>
                                    <span class="stt-price">£0.00</span>
                                </div>
                                <div class="tax-fee">
                                    <p class="title">Est. Taxes & Fees</p>
                                    <p class="desc">Based on 56789</p>
                                </div>
                                <div class="btn-checkout">
                                    <a href="#" class="btn checkout">Check out</a>
                                </div>
                                <div class="biolife-progress-bar">
                                    <table>
                                        <tr>
                                            <td class="first-position">
                                                <span class="index">$0</span>
                                            </td>
                                            <td class="mid-position">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 25%"
                                                        aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </td>
                                            <td class="last-position">
                                                <span class="index">$99</span>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about
                                    shipping and pickup</p>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php require_once "includes/footer.php"; ?>

    <!--Footer For Mobile-->
    <?php require_once "includes/mobile_footer.php"; ?>


    <?php require_once "includes/mobile_global_block.php"; ?>



    <!--Quickview Popup-->
    <div id="biolife-quickview-block" class="biolife-quickview-block">
        <div class="quickview-container">
            <a href="#" class="btn-close-quickview" data-object="open-quickview-block"><span
                    class="biolife-icon icon-close-menu"></span></a>
            <div class="biolife-quickview-inner">
                <div class="media">
                    <ul class="biolife-carousel quickview-for"
                        data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".quickview-nav"}'>
                        <li><img src="assets/images/details-product/detail_01.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_02.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_03.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_04.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_05.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_06.jpg" alt="" width="500" height="500"></li>
                        <li><img src="assets/images/details-product/detail_07.jpg" alt="" width="500" height="500"></li>
                    </ul>
                    <ul class="biolife-carousel quickview-nav"
                        data-slick='{"arrows":true,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":3,"slidesToScroll":1,"asNavFor":".quickview-for"}'>
                        <li><img src="assets/images/details-product/thumb_01.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_02.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_03.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_04.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_05.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_06.jpg" alt="" width="88" height="88"></li>
                        <li><img src="assets/images/details-product/thumb_07.jpg" alt="" width="88" height="88"></li>
                    </ul>
                </div>
                <div class="product-attribute">
                    <h4 class="title"><a href="#" class="pr-name">National Fresh Fruit</a></h4>
                    <div class="rating">
                        <p class="star-rating"><span class="width-80percent"></span></p>
                    </div>

                    <div class="price price-contain">
                        <ins><span class="price-amount"><span class="currencySymbol">£</span>85.00</span></ins>
                        <del><span class="price-amount"><span class="currencySymbol">£</span>95.00</span></del>
                    </div>
                    <p class="excerpt">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel maximus
                        lacus. Duis ut mauris eget justo dictum tempus sed vel tellus.</p>
                    <div class="from-cart">
                        <div class="qty-input">
                            <input type="text" name="qty12554" value="1" data-max_value="20" data-min_value="1"
                                data-step="1">
                            <a href="#" class="qty-btn btn-up"><i class="fa fa-caret-up" aria-hidden="true"></i></a>
                            <a href="#" class="qty-btn btn-down"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
                        </div>
                        <div class="buttons">
                            <a href="#" class="btn add-to-cart-btn btn-bold">add to cart</a>
                        </div>
                    </div>

                    <div class="product-meta">
                        <div class="product-atts">
                            <div class="product-atts-item">
                                <b class="meta-title">Categories:</b>
                                <ul class="meta-list">
                                    <li><a href="#" class="meta-link">Milk & Cream</a></li>
                                    <li><a href="#" class="meta-link">Fresh Meat</a></li>
                                    <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                                </ul>
                            </div>
                            <div class="product-atts-item">
                                <b class="meta-title">Tags:</b>
                                <ul class="meta-list">
                                    <li><a href="#" class="meta-link">food theme</a></li>
                                    <li><a href="#" class="meta-link">organic food</a></li>
                                    <li><a href="#" class="meta-link">organic theme</a></li>
                                </ul>
                            </div>
                            <div class="product-atts-item">
                                <b class="meta-title">Brand:</b>
                                <ul class="meta-list">
                                    <li><a href="#" class="meta-link">Fresh Fruit</a></li>
                                </ul>
                            </div>
                        </div>
                        <span class="sku">SKU: N/A</span>
                        <div class="biolife-social inline add-title">
                            <span class="fr-title">Share:</span>
                            <ul class="socials">
                                <li><a href="#" title="twitter" class="socail-btn"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" title="facebook" class="socail-btn"><i class="fa fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" title="pinterest" class="socail-btn"><i class="fa fa-pinterest"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" title="youtube" class="socail-btn"><i class="fa fa-youtube"
                                            aria-hidden="true"></i></a></li>
                                <li><a href="#" title="instagram" class="socail-btn"><i class="fa fa-instagram"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Top Button -->
    <a class="btn-scroll-top"><i class="biolife-icon icon-left-arrow"></i></a>

    <?php require_once "includes/scripts.php"; ?>
</body>

</html>