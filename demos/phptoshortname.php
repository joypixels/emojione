<?php
# include the PHP library (if not autoloaded)
require('./../lib/php/Emojione.class.php');

################################################
# Optional:
# default is PNG but you may also use SVG
Emojione::$imageType = 'svg';

# default is ignore ASCII smileys like :) but you can easily turn them on
Emojione::$ascii = true;

# if you want to host the images somewhere else
# you can easily change the default paths
Emojione::$imagePathPNG = './../assets/png/';
Emojione::$imagePathSVG = './../assets/svg/';
################################################

?><!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>PHP: Convert Unicodes to Shortnames - Emoji One Labs</title>

  <!-- Emoji One CSS: -->
  <link rel="stylesheet" href="./../assets/css/emojione.min.css" type="text/css" media="all" />

  <!-- jQuery: -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <!-- Demos Stylesheet: -->
  <link rel="stylesheet" href="styles/demos.css"/>

  <!-- Typekit: -->
  <script type="text/javascript" src="//use.typekit.net/ivu8ilu.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>

  <!-- Syntax Highlighting -->
  <script type="text/javascript" src="scripts/shCore.js"></script>
  <script type="text/javascript" src="scripts/shBrushJScript.js"></script>
  <script type="text/javascript" src="scripts/shBrushCss.js"></script>
  <script type="text/javascript" src="scripts/shBrushPhp.js"></script>
  <script type="text/javascript">SyntaxHighlighter.all();</script>
  <link rel="stylesheet" href="styles/shCoreRDark.css"/>

</head>
<body>

<!-- Masthead -->
<header class="masthead">
  <div class="container">
    <h1 class="masthead-title">Emoji One Labs</h1>
  </div>
</header>

<!-- Breadcrum Navigation -->
<nav class="breadcrumbs">
  <div class="container">
    <a class="breadcrumb-item top-level" href="index.html">All Demos</a> &rsaquo;
    <a href="index.html#php">PHP</a> &rsaquo;
    <a class="breadcrumb-item active" href="phptoshortname.php">Convert Unicodes to Shortnames</a>
  </div>
</nav>

<!-- Page: -->
<main>

  <div class="container">

    <h1>PHP: Convert Unicodes to Shortnames</h1>

    <p>Convert Emoji Unicode characters to :shortnames:. You can also try inputting an emoji from a mobile device here</p>

    <div class="clearfix">
      <div class="column-1-2 input">
        <h3>Input:</h3>
        <form method="post" action="phptoshortname.php#demo3">
          <input type="text" id="demo3-input" name="demo3-input" value="Hello world! &#x1f604;"/>
          <input type="submit" value="Convert"/>
        </form>
      </div>
      <div class="column-1-2 output">
        <h3>Output:</h3>
        <p>
          <?php
          if(isset($_POST['demo3-input'])) {
            echo Emojione::toShort($_POST['demo3-input']);
          }
          ?>
        </p>
      </div>
    </div>



    <h3>PHP Snippet:</h3>
        <pre class="brush: php">
&lt;?php
if(isset($_POST['demo3-input'])) {
  echo Emojione::toShort($_POST['demo3-input']);
}
?&gt;
        </pre>

  </div>

</main>

<footer class="demo-footer">
  <div class="container">
    <small>&copy; Copyright 2014 Ranks.com.</small>
    <small>Emoji One artwork is licensed under the <a href="https://creativecommons.org/licenses/by/4.0/legalcode">CC-BY-SA-4.0</a> License</small>
    <small>Emoji One demos, documentation, scripts, stylesheets and all other non-artwork is licensed under the <a
          href="http://opensource.org/licenses/MIT">MIT</a> License</small>
  </div>
</footer>

</body>
</html>