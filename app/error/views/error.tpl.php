<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo CONFIG_TITLE; ?> | 404 Error</title>

    <link href="<?php echo CONFIG_PATH_PUBLIC; ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo CONFIG_PATH_PUBLIC; ?>/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo CONFIG_PATH_PUBLIC; ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo CONFIG_PATH_PUBLIC; ?>/css/style.css" rel="stylesheet">

    <style type="text/css">
        *            { margin:0px; padding:0px; border:0px; }
        body         { background-color:#000; overflow: hidden; }
        #bg-erro     { width:100%; min-height:1800px;  float:left; overflow:hidden;}
        #centro-erro { width:100%; max-width:492px; margin:150px auto; box-shadow: 1px 1px 3px 3px rgba(0,0,0,.2); }
    </style>

</head>

<body class="gray-bg">


        <div id="bg-erro">
            <div id="centro-erro">
                <a href="<?php echo CONFIG_PATH; ?>/">
                    <img src="<?php echo CONFIG_PATH_PUBLIC; ?>/img/conteudo-erro.jpg" width="100%" />
                </a>
            </div>
        </div>

<!--     <div class="middle-box text-center animated fadeInDown">
        <h1>404</h1>
        <h3 class="font-bold">Page Not Found</h3>

        <div class="error-desc">
            Sorry, but the page you are looking for has note been found. Try checking the URL for error, then hit the refresh button on your browser or try found something else in our app.
        </div>
    </div> -->

    <!-- Mainly scripts -->
    <script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo CONFIG_PATH_PUBLIC; ?>/js/bootstrap.min.js"></script>

</body>

</html>
