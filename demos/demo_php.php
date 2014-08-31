<?php
require('./../lib/php/Emojione.class.php');

// 'svg' or 'png'
Emojione::$imageType = 'svg';

// defaults to cdnjs but we can use local images too:
Emojione::$imagePathPNG = './../images/png/';
Emojione::$imagePathSVG = './../images/svg/';

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>emojione - demo</title>
    <link rel="stylesheet" href="../css/emojione.min.css" type="text/css" media="all" />
    <style type="text/css">
        main {
            border: solid 1px #000000;
            width: 780px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px 50px 50px 50px;
        }
        div {
            background-color: #EEEEEE;
            padding: 5px 20px 25px 20px;
            margin-bottom:50px;
        }
    </style>
</head>
<body>
<main>

    <h1>emojione demos</h1>

    <div id="demo5">
        <h3>PHP - Shortcode -> Image</h3>

        Input:<br/>
        <form method="post" action="index.php#demo5">
            <input type="text" id="demo5-input" name="demo5-input" size="50" value="Hello world! :smile: "/> <input type="submit" value="Convert"/>
        </form>
        <br />
        <br />

        Output:<br />
        <span id="demo5-output">
            <?php
            if(isset($_POST['demo5-input'])) {
                echo Emojione::toImage($_POST['demo5-input']);
            }
            ?>
        </span>
    </div>

    <div id="demo6">
        <h3>PHP - Unicode -> Image</h3>

        Input:<br/>
        <form method="post" action="index.php#demo6">
            <input type="text" id="demo6-input" name="demo6-input" size="50" value="Hello world! &#x1f604;"/> <input type="submit" value="Convert"/>
        </form>
        <br />
        <small>you can also try inputting an emoji from a mobile device here</small><br /><br />

        Output:<br />
        <span id="demo6-output">
            <?php
            if(isset($_POST['demo6-input'])) {
                echo Emojione::unicodeToImage($_POST['demo6-input']);
            }
            ?>
        </span>
    </div>

    <div id="demo7">
        <h3>PHP - Unicode -> Shortcode</h3>

        Input:<br/>
        <form method="post" action="index.php#demo7">
            <input type="text" id="demo7-input" name="demo7-input" size="50" value="Hello world! &#x1f604;"/> <input type="submit" value="Convert"/>
        </form>
        <br />
        <small>you can also try inputting an emoji from a mobile device here</small><br /><br />

        Output:<br />
        <span id="demo7-output">
            <?php
            if(isset($_POST['demo7-input'])) {
                echo Emojione::toShort($_POST['demo7-input']);
            }
            ?>
        </span>
    </div>


    <div id="demo8">
        <h3>PHP - Shortcode + Unicode -> Image</h3>

        Input:<br/>
        <form method="post" action="index.php#demo8">
            <input type="text" id="demo8-input" name="demo8-input" size="50" value="Hello world! :smile: &#x1f604;"/> <input type="submit" value="Convert"/>
        </form>
        <br />
        <small>you can also try inputting an emoji from a mobile device here</small><br /><br />

        Output:<br />
        <span id="demo8-output">
            <?php
            if(isset($_POST['demo8-input'])) {
                echo Emojione::toImage($_POST['demo8-input']);
            }
            ?>
        </span>
    </div>

</main>
</body>
</html>