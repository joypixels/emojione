<?php
# include the PHP library (if not autoloaded)
require('./../lib/php/Emojione.class.php');

################################################
# Optional:
# default is PNG but you may also use SVG
Emojione::$imageType = 'svg';

# default is cdnjs but you can also change the paths
# if you want to host the iamges somewhere else
Emojione::$imagePathPNG = './../images/png/';
Emojione::$imagePathSVG = './../images/svg/';
################################################

?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Demo &mdash; Emojione.com</title>
    <link rel="stylesheet" href="../css/emojione.min.css" type="text/css" media="all" />

    <style type="text/css">
        html,body {
            font-family:sans-serif;
            background-color: #333333;
        }
        #logo {
            background: url("http://www.emojione.com/images/emojione.png") no-repeat scroll center center rgba(0, 0, 0, 0);
            height: 141px;
            margin: 0 auto;
            text-indent: -9999em;
            width: 247px;
        }
        main {
            background-color: #FFFFFF;
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
<h1 id="logo">Emojione</h1>
<main>

    <h2>PHP Demos</h2>

    <div id="demo3">
        <h3>Demo #3</h3>
        <p>Convert Unicode emoji characters to shortnames.</p>

        <b>Input:</b><br/>
        <form method="post" action="demo_php.php#demo3">
            <input type="text" id="demo3-input" name="demo3-input" size="50" value="Hello world! &#x1f604;"/> <input type="submit" value="Convert"/>
        </form>
        <br />
        <small>you can also try inputting an emoji from a mobile device here</small><br /><br />

        <br/>
        <b>Output:</b><br />
        <span id="demo3-output">
            <?php
            if(isset($_POST['demo3-input'])) {
                echo Emojione::toShort($_POST['demo3-input']);
            }
            ?>
        </span>

        <br />
        <br />
        <br />
        <b>Code:</b>
        <pre>
&lt;?php
if(isset($_POST['demo3-input'])) {
    echo Emojione::toShort($_POST['demo3-input']);
}
?&gt;
        </pre>
    </div>


    <div id="demo4">
        <h3>Demo #4</h3>
        <p>Convert Unicode emoji characters and/or shortnames to images.</p>

        <b>Input:</b><br/>
        <form method="post" action="demo_php.php#demo4">
            <input type="text" id="demo4-input" name="demo4-input" size="50" value="Hello world! :smile: &#x1f604;"/> <input type="submit" value="Convert"/>
        </form>
        <br />
        <small>you can also try inputting an emoji from a mobile device here</small><br /><br />

        <br/>
        <b>Output:</b><br />
        <span id="demo4-output">
            <?php
            if(isset($_POST['demo4-input'])) {
                echo Emojione::toImage($_POST['demo4-input']);
            }
            ?>
        </span>

        <br />
        <br />
        <br />
        <b>Code:</b>
        <pre>
&lt;?php
if(isset($_POST['demo4-input'])) {
    echo Emojione::toImage($_POST['demo4-input']);
}
?&gt;
        </pre>
    </div>

</main>
</body>
</html>