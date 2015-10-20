<?php
namespace Emojione;

# include the PHP library (if not autoloaded)
require('./../lib/php/autoload.php');

$client = new Client(new Ruleset());

################################################
# Optional:
# default is PNG but you may also use SVG
$client->imageType = 'svg';

# default is ignore ASCII smileys like :) but you can easily turn them on
$client->ascii = true;

# if you want to host the images somewhere else
# you can easily change the default paths
$client->imagePathPNG = './../assets/png/';
$client->imagePathSVG = './../assets/svg/';
################################################
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>::shortnameToImage($str) - PHP - Emoji One Labs</title>

  <!-- Emoji One CSS: -->
  <link rel="stylesheet" href="./../assets/css/emojione.min.css" type="text/css" media="all" />

  <!-- jQuery: -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

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
    <h1 class="masthead-title">Emoji One Labs</h1><span class="version">version <span>1.5.1</span></span>
  </div>
</header>

<!-- Breadcrum Navigation -->
<nav class="breadcrumbs">
  <div class="container">
    <a class="breadcrumb-item top-level" href="index.html">All Demos</a> &rsaquo;
    <a href="index.html#php">PHP</a> &rsaquo;
    <a class="breadcrumb-item active" href="./phpshortnametoimage.php">shortnameToImage($str)</a>
  </div>
</nav>

<!-- Page: -->
<main>

  <div class="container" id="output">

      <h1>shortnameToImage($str)</h1>
      <h2>convert shortnames to images</h2>

      <p>If you've chosen to unify your inputted text so that it contains only shortnames then this is the function (or its matching Javascript function) you will want to use to convert the shortnames images when displaying it to the client.</p>

      <p>Feel free to enter other shortnames in the input below to test the conversion process. For a complete list of emoji and their shortnames check out <a href="http://emoji.codes/" target="_blank">emoji.codes</a>.</p>

      <p class="notice"><strong>Note: </strong> Once you start dealing with native unicode characters server side, it's important to ensure that your web stack is set up to handle UTF-8 character encoding. That is outside of the scope of our demos, but a quick <a href="http://lmgtfy.com/?q=web+stack+utf-8" target="_blank">Google Search</a> will guide you in the right direction.</p>

      <div class="clearfix">
      <div class="column-1-2 input">
        <h3>Input:</h3>
        <form method="post" action="phpshortnametoimage.php#output">
          <input type="text" id="inputText" name="inputText" value="<?php echo (isset($_POST['inputText'])) ? $_POST['inputText'] : 'Hello world! :smile:'; ?>"/>
          <input type="submit" value="Convert"/>
        </form>
      </div>
      <div class="column-1-2 output">
        <h3>Output:</h3>
        <p>
          <?php
          if(isset($_POST['inputText'])) {
            echo $client->shortnameToImage($_POST['inputText']);
          }
          ?>
        </p>
      </div>
    </div>

    <h3>PHP Snippet:</h3>
      <div class="new-version">As of version 1.4.1 this library method has new syntax.</div>
        <pre class="brush: php">
&lt;?php
    // include the PHP library (if not autoloaded)
    require('./../lib/php/autoload.php');

    $client = new Client(new Ruleset());

    // ###############################################
    // Optional:
    // default is PNG but you may also use SVG
    $client->imageType = 'svg'; // or png (default)

    // if you want to host the images somewhere else
    // you can easily change the default paths
    $client->imagePathPNG = './../assets/png/'; // defaults to jsdelivr's free CDN
    $client->imagePathSVG = './../assets/svg/'; // defaults to jsdelivr's free CDN
    // ###############################################

    if(isset($_POST['inputText'])) {
    echo $client->shortnameToImage($_POST['inputText']);
    }
?&gt;
        </pre>
      <p>&nbsp;</p>
      <div class="deprecated">As of version 1.4.1 the following implementation has been deprecated. It's included in the library for backwards compatibility but will be removed at a later date.</div>
      <pre class="brush: php">
&lt;?php
    // include the PHP library (if not autoloaded)
    require('./../lib/php/autoload.php');

    // ###############################################
    // Optional:
    // default is PNG but you may also use SVG
    Emojione\Emojione::$imageType = 'svg'; // or png (default)

    // if you want to host the images somewhere else
    // you can easily change the default paths
    Emojione\Emojione::$imagePathPNG = './../assets/png/'; // defaults to jsdelivr's free CDN
    Emojione\Emojione::$imagePathSVG = './../assets/svg/'; // defaults to jsdelivr's free CDN
    // ###############################################

    if(isset($_POST['inputText'])) {
    echo Emojione\Emojione::shortnameToImage($_POST['inputText']);
    }
?&gt;
      </pre>
  </div>

</main>

<footer class="demo-footer">
  <div class="container">
    <small>&copy; Copyright 2014-2015 Ranks.com.</small>
    <small>Emoji One artwork is licensed under the <a href="https://creativecommons.org/licenses/by/4.0/legalcode">CC-BY-SA-4.0</a> License</small>
    <small>Emoji One demos, documentation, scripts, stylesheets and all other non-artwork is licensed under the <a
          href="http://opensource.org/licenses/MIT">MIT</a> License</small>
  </div>
</footer>

</body>
</html>
