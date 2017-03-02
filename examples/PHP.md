#EmojiOne

##**PHP Implementation Examples**

The following PHP code snippets demonstrate common usages of EmojiOne within your project.

----------

##.shortnameToImage($str)
*Convert Shortnames to Images*

If you've chosen to unify your inputted text so that it contains only shortnames then this is the function (or its matching Javascript function) you will want to use to convert the shortnames images when displaying it to the client.

**PHP**
```php
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