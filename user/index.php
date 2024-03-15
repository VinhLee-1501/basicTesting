<?php
ob_start();
session_start();
//if (isset($_SESSION['member'])) {
//    echo 'hello';
//}
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

        <title>E-SHOP HTML Template</title>
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT"
              crossorigin="anonymous">

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="contents/css/bootstrap.min.css"/>

        <!-- Slick -->
        <link type="text/css" rel="stylesheet" href="contents/css/slick.css"/>
        <link type="text/css" rel="stylesheet" href="contents/css/slick-theme.css"/>

        <!-- nouislider -->
        <link type="text/css" rel="stylesheet" href="contents/css/nouislider.min.css"/>

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="contents/css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="contents/css/style.css"/>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-- [if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif] -->

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,700" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>


        <link rel="stylesheet" href="contact-form-06/css/style.css"/>
    </head>

    <body>

    <?php

    include '../admin/assets/include/pdo.php';
    include '../admin/page/product/product.php';
    include '../admin/page/categories/category.php';
    include '../admin/page/order/orders.php';
    include '../admin/page/comment/comment.php';
    include '../admin/page/users/user.php';
    include '../admin/page/promotion/promotions.php';
    include 'PHPMailer/forgot.php';

    include("components/header.php");
    include("components/nav.php");
    //include("contact-form-06/php/sendEmail.php");

    if (isset($_GET['page'])) {
        switch ($_GET['page']) {
            case 'products':
                require_once 'products.php';
                break;
            case 'blank':
                require_once 'blank.php';
                break;
            case 'checkout':
                require_once 'checkout.php';
                break;

            case 'productPage':
                include 'productPage.php';
                break;
            case 'contact':
                require_once 'contact.php';
                break;
            case 'login':
                require_once 'login.php';
                break;
            case'register':
                require_once 'register.php';
                break;
            case 'policy':
                require_once 'policy.php';
                break;
            case 'profile':
                require_once 'profile.php';
                break;
            case 'cart':
                require_once 'giohang.php';
                break;
            case 'blank':
                require_once 'blank.php';
                break;
            case 'pay':
                require_once 'pay.php';
                break;
            case 'cancellation':
                require_once 'components/cancellation.php';
                break;
            case 'forgotPass':
                require_once 'forgotPass.php';
                break;
            case 'codePass':
                require_once 'codePass.php';
                break;
            case 'resetPass':
                require_once 'resetPass.php';
                break;
            case 'logout':

                session_start();
                $_SESSION = array();
                session_destroy();
                header('Location: ?page=login');
                break;
            default:
                require_once 'index.php';
                break;
        }
    } else {
        require_once 'index.php';
        include("components/home.php");
        include("components/categories.php");
//    include("components/dealday.php");
        include("components/products.php");
        include("components/end.php");


    }
    include("components/footer.php");


    ?>

    <!-- jQuery Plugins -->
    <script src="contents/js/jquery.min.js"></script>
    <script src="contents/js/bootstrap.min.js"></script>
    <script src="contents/js/slick.min.js"></script>
    <script src="contents/js/nouislider.min.js"></script>
    <script src="contents/js/jquery.zoom.min.js"></script>
    <script src="contents/js/main.js"></script>

    <!--Map-->

    <script src="contact-form-06/js/jquery.min.js"></script>
    <script src="contact-form-06/js/popper.js"></script>
    <script src="contact-form-06/js/bootstrap.min.js"></script>
    <script src="contact-form-06/js/jquery.validate.min.js"></script>
    <script src="contact-form-06/js/main.js"></script>

    <!--ChatBox-->
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger
            intent="WELCOME"
            chat-title="ChatBox-DuAn1"
            agent-id="057c2518-fee9-4580-abc8-f5e4ffe28aaa"
            language-code="vi"
    ></df-messenger>
    </body>

    </html>
<?
ob_end_flush();
?>