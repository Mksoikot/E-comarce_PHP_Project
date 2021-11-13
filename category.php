<?php
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

            <!--Hero Section-->
            <div class="hero-section hero-background">
                <h1 class="page-title">
                    <?php echo $category_name['ctg_name']; ?>
                </h1>
            </div>

            <!--Navigation section-->
            <div class="container">
                <nav class="biolife-nav">
                    <ul>
                        <li class="nav-item"><a href="index.php" class="permal-link">Home</a></li>
                        <li class="nav-item"><span class="current-page">
                        <?php echo $category_name['ctg_name']; ?>
                        </span></li>
                    </ul>
                </nav>
            </div>
            <div class="container">
                <div class="page-contain category-page no-sidebar">
                    <div class="container">
                        <div class="row">

                            <!-- Main content -->
                            <div id="main-content" class="main-content col-lg-12 col-md-12 col-sm-12 col-xs-12">


                                <div class="product-category grid-style">

                                    <div class="row">
                                        <ul class="products-list">
                                        <?php 
                                            foreach($pros as $pro){
                                        ?>
                                            <li class="product-item col-lg-3 col-md-3 col-sm-4 col-xs-6">
                                                <div class="contain-product layout-default">
                                                    <div class="product-thumb">
                                                        <a href="single_product.php?status=singleProduct&&id=<?php echo $pro['pdt_id']; ?>" class="link-to-product">
                                                            <img src="admin/upload/<?php echo $pro['pdt_image']; ?>" alt="dd"
                                                                width="270" height="270" class="product-thumnail">
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <b class="categories"><?php echo $pro['ctg_name']; ?></b>
                                                        <h4 class="product-title"><a href="single_product.php?status=singleProduct&&id=<?php echo $pro['pdt_id']; ?>" class="pr-name"><?php echo $pro['pdt_name']; ?></a></h4>
                                                        <div class="price">
                                                            <ins><span class="price-amount"><span
                                                                        class="currencySymbol">৳</span><?php echo $pro['pdt_price']; ?></span></ins>
                                                            <!-- <del><span class="price-amount"><span
                                                                        class="currencySymbol">৳</span>95.00</span></del> -->
                                                        </div>
                                                        <div class="shipping-info">
                                                            <p class="shipping-day">3-Day Shipping</p>
                                                            <p class="for-today">Pree Pickup Today</p>
                                                        </div>
                                                        <div class="slide-down-box">
                                                            <p class="message"><?php echo $pro['pdt_des']; ?></p>
                                                            <div class="buttons">
                                                                <a href="single_product.php?status=singleProduct&&id=<?php echo $pro['pdt_id']; ?>" class="btn wishlist-btn"><i
                                                                        class="fa fa-heart" aria-hidden="true"></i></a>
                                                                <a href="single_product.php?status=singleProduct&&id=<?php echo $pro['pdt_id']; ?>" class="btn add-to-cart-btn"><i
                                                                        class="fa fa-cart-arrow-down"
                                                                        aria-hidden="true"></i>add to cart</a>
                                                                <a href="single_product.php?status=singleProduct&&id=<?php echo $pro['pdt_id']; ?>" class="btn compare-btn"><i
                                                                        class="fa fa-eye" aria-hidden="true"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php } ?>
                                        </ul>
                                    </div>

                                    <div class="biolife-panigations-block">
                                        <ul class="panigation-contain">
                                            <li><span class="current-page">1</span></li>
                                            <li><a href="#" class="link-page">2</a></li>
                                            <li><a href="#" class="link-page">3</a></li>
                                            <li><span class="sep">....</span></li>
                                            <li><a href="#" class="link-page">20</a></li>
                                            <li><a href="#" class="link-page next"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
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