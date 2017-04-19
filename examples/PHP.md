# EmojiOne

## **PHP Implementation Examples**

The following PHP code snippets demonstrate common usages of EmojiOne within your project.

----------

## shortnameToImage($str)
*Convert Shortnames to Images*

If you've chosen to unify your inputted text so that it contains only shortnames then this is the function (or its matching Javascript function) you will want to use to convert the shortnames images when displaying it to the client.

**PHP Snippet**
```php
namespace Emojione;

// include the PHP library (if not autoloaded)
require('./../lib/php/autoload.php');

$client = new Client(new Ruleset());

// ###############################################
// if you want to host the images somewhere else
// you can easily change the default paths
$client->imagePathPNG = './../assets/png/'; // defaults to jsdelivr's free CDN
// ###############################################

if(isset($_POST['inputText'])) {
	echo $client->shortnameToImage($_POST['inputText']);
}
```

----------

## toImage($str)
*Convert Native Unicode Emoji and Shortnames Directly to Images*

This function is simply a shorthand for **unicodeToImage($str)** and **shortnameToImage($str)**. First it will convert native unicode emoji directly to images and then convert any shortnames to images. This function can be useful to take mixed input and convert it directly to images if, for example, you have native unicode emoji stored in your database alongside shortnames.

**PHP Snippet**
```php
namespace Emojione;

// include the PHP library (if not autoloaded)
require('./../lib/php/autoload.php');

$client = new Client(new Ruleset());

// ###############################################
// if you want to host the images somewhere else
// you can easily change the default paths
$client->imagePathPNG = './../assets/png/'; // defaults to jsdelivr's free CDN
// ###############################################

if(isset($_POST['inputText'])) {
	echo $client->toImage($_POST['inputText']);
}
```

----------

## toShort($str)
*Convert Native Unicode Emoji to Shortnames*

Our recommendation is to unify all user inputted text by converting native unicode emoji, such as those inputted by mobile devices, to their corresponding shortnames. This demo shows you how to use the **toShort($str)** PHP function provided in our toolkit to do just that.

**PHP Snippet**
```php
namespace Emojione;

// include the PHP library (if not autoloaded)
require('./../lib/php/autoload.php');

$client = new Client(new Ruleset());

if(isset($_POST['inputText'])) {
  echo $client->toShort($_POST['inputText']);
}
```

----------

## unicodeToImage($str)
*Convert Native Unicode Emoji Directly to Images*

If you have native unicode emoji characters that you want to convert directly to images, you can use this function. It should be noted that once your input text has been converted to images it cannot be converted back using the provided functions.

>For that reason, we recommend only converting input text to images when it's ready to display to the client. The better alternative, in our opinion, is to convert native unicode emoji to their corresponding shortname using **toShort($str)** for database storage.

**PHP Snippet**
```php
namespace Emojione;

// include the PHP library (if not autoloaded)
require('./../lib/php/autoload.php');

$client = new Client(new Ruleset());

// ###############################################
// if you want to host the images somewhere else
// you can easily change the default paths
$client->imagePathPNG = './../assets/png/'; // defaults to jsdelivr's free CDN
// ###############################################

if(isset($_POST['inputText'])) {
	echo $client->unicodeToImage($_POST['inputText']);
}
```

----------

## shortnameToUnicode($str)
*Convert Shortnames to Native Unicode*

If you'd like to convert shortnames back to native unicode emoji characters, you can use this function.

**PHP Snippet**
```php
namespace Emojione;

// include the PHP library (if not autoloaded)
require('./../lib/php/autoload.php');

$client = new Client(new Ruleset());

if(isset($_POST['inputText'])) {
	echo $client->shortnameToUnicode($_POST['inputText']);
}
```