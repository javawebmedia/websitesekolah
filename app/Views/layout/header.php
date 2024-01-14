<!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<!--********************************
        Code Start From Here 
******************************** -->
<!--==============================
 Preloader
==============================-->
<!-- <div class="preloader ">
    <button class="as-btn style3 preloaderCls">Cancel Preloader </button>
    <div class="preloader-inner">
        <span class="loader"></span>
    </div>
</div> -->
<!--==============================
Sidemenu
============================== -->
<div class="sidemenu-wrapper d-none d-lg-block ">
    <div class="sidemenu-content">
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <div class="widget woocommerce widget_shopping_cart">
            <h3 class="widget_title">Shopping cart</h3>
            <div class="widget_shopping_cart_content">
                <ul class="woocommerce-mini-cart cart_list product_list_widget ">
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/cart/cart_1_1.jpg" alt="Cart Image">HTML5 Course</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>40.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/cart/cart_1_2.jpg" alt="Cart Image">JS ES6 Course</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>99.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/cart/cart_1_3.jpg" alt="Cart Image">PHP Course</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>56.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/cart/cart_1_4.jpg" alt="Cart Image">Python Course</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>23.00</span>
                        </span>
                    </li>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <a href="#" class="remove remove_from_cart_button"><i class="far fa-times"></i></a>
                        <a href="#"><img src="assets/img/cart/cart_1_5.jpg" alt="Cart Image">WordPress Course</a>
                        <span class="quantity">1 ×
                            <span class="woocommerce-Price-amount amount">
                                <span class="woocommerce-Price-currencySymbol">$</span>100.00</span>
                        </span>
                    </li>
                </ul>
                <p class="woocommerce-mini-cart__total total">
                    <strong>Subtotal:</strong>
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">$</span>318.00</span>
                </p>
                <p class="woocommerce-mini-cart__buttons buttons">
                    <a href="cart.php" class="as-btn wc-forward">View cart</a>
                    <a href="checkout.php" class="as-btn checkout wc-forward">Checkout</a>
                </p>
            </div>
        </div>
    </div>
</div>
<div class="popup-search-box d-none d-lg-block">
    <button class="searchClose"><i class="fal fa-times"></i></button>
    <form action="#">
        <input type="text" placeholder="What are you looking for?">
        <button type="submit"><i class="fal fa-search"></i></button>
    </form>
</div>
<!--==============================
Mobile Menu
============================== -->
<div class="as-menu-wrapper">
    <div class="as-menu-area text-center">
        <button class="as-menu-toggle"><i class="fal fa-times"></i></button>
        <div class="mobile-logo">
            <a href="<?php echo base_url() ?>">
                <img src="<?php echo $this->website->logo() ?>" alt="<?php echo $this->website->namaweb() ?>">
            </a>
        </div>
        <div class="as-mobile-menu">
            <ul>
                <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                <li><a href="<?php echo base_url('layanan') ?>">Layanan</a></li>
                <li><a href="<?php echo base_url('staff') ?>">Staff &amp; Team</a></li>
                <li><a href="<?php echo base_url('clients') ?>">Client</a></li>
                <li><a href="<?php echo base_url('kontak') ?>">Kontak</a></li>
            </ul>
        </div>
    </div>
</div>