<header class="header-box">
    <!-- ヘッダーの上側 -->
    <div class="logo-box">
        <img class="header-logo" src="../../../img/syukatudotcom_logo_white.png" alt="就活.com">
    </div>
    <!-- ヘッダーの下側 -->
    <div class="header-bottom-box">
        <!--ヘッダーの下側の左側-->
        <div class="header-menu">
            <div class="each-menu"><a style="text-decoration:none;color:white;" href="index.php?agent_list_pagination=1">TOP</a></div>
            <div class="each-menu"><a style="text-decoration:none;color:white;" href="special_list_index.php">特集記事</a></div>
            <div class="each-menu"><a style="text-decoration:none;color:white;" href="help.php">ヘルプ</a></div>
            <div class="each-menu"><a style="text-decoration:none;color:white;" href="comparison.php">比較画面</a></div>
            <div class="each-menu agent-login-sp"><a style="text-decoration:none;color:white;" href="login.php">企業様のログインはこちら</a></div>
        </div>
        <!--ヘッダーの下側の右側-->
        <div class="header-cart-box">
            <a href="check_cart.php">
                <div class="header-cart-text">
                問い合わせリスト
                </div>
                <div class="header-cart">
                    <i class="fa-solid fa-envelope fa-2x mail-icon"></i>
                    <!--position:relative-->
                    
                    <div class="cart-count"><?php 
                    if(isset($_SESSION['apply_list'])){
                        echo count($_SESSION['apply_list']);
                    }else{
                        echo 0;
                    }
                        ?></div>
                    <!--position:absoluteでごり押し-->
                </div>
            </a>
        </div>
    </div>
</header>