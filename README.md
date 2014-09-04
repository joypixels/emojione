#![Emoji One Logo](http://git.emojione.com/assets/png/1F40C.png) Emoji One 
> bringing you [emojione.com](http://emojione.com/) & [emoji.codes](http://emoji.codes.com/)

The web's first and only complete open source emoji set. It is 100% free and super easy to integrate.


## The Idea

To standardize emojis on the web through the use of common :shortnames:. 

User inputted :shortnames: should be stored as-is and then replaced with the matching emoji images when outputting client side. Likewise, Unicode emojis inputted (mainly from mobiles and tablets) should be converted to their corresponding :shortname: before storing in your database.

This allows you to quickly add emoji support to your forums, guestbooks, blogs, and other web applications. 

We've provided simple Javascript and PHP libraries for converting :shortnames: to emoji images, and Unicode emojis to :shortnames:. See below for usage instructions.

> **What Shortnames?**
> 
> [emoji.codes](http://emoji.codes/) has a complete list of shortnames as well as quick copy & search functions.


## Implementation

There are a couple different ways to implement Emoji One on your website. To make things as easy as possible, we've chosen to host our emoji images and Javascript library on jsDelivr. This makes it so that you never have to worry about updating the emoji images locally, because when we do updates, we'll simply push them to jsDelivr and they'll be updated on your applications.

We recommend using the PHP library for most custom applications, but implementation is completely up to you. You may use only the Javascript or PHP library or a mixture of both. Whatever you decide, we recommend that when you store user-inputted text, you make sure to store only the :shortnames:. The flow is as follows:

1. The user inputs their text using shortnames and/or standard Unicode characters.
2. Prior to form submission, the inputted text is converted to shortnames with the Javascript library **OR** after posting but before storing the text in your database, the text is converted to shortnames using the PHP library.
3. When you pull the text out of your database, you can convert the :shortnames: to images prior to output using the PHP library **OR** after outputting, you can use the Javascript library to convert the :shortnames: to images.



## Javascript Example

Below is an example of a Javascript-only implemention of Emoji One. 

Include the Javascript library
```html
<head>
	<!-- include via jsDelivr (or download and host locally if you prefer) -->
    <script src="//cdn.jsdelivr.net/emojione/1.0.3/lib/js/emojione.min.js" type="text/javascript"></script>
    
    <!-- basic rules for styling the emoji images -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/emojione/1.0.3/assets/css/emojione.min.css" type="text/css" media="all" />
    
     <script type="text/javascript">
       // #################################################
       // # Optional
       
       // default is PNG but you may also use SVG
       emojione.imageType = 'svg';
       
       // default is jsDelivr but you can also change the paths 
       // if you want to host the images somewhere else
       emojione.imagePathPNG = './../images/png/';
       emojione.imagePathSVG = './../images/svg/';
       
       // #################################################
    </script>

</head>
```


##### On Input:
Before text is sent to your server, convert any Unicode emojis to shortnames:
```html
<form onsubmit="convert();">
	<textarea id="myTextarea">Hello World! 😄</textarea>
</form>

<script type="text/javascript">

  function convert() {
    // get the inputted text
    var inputted = document.getElementById('myTextarea').value;
    
    // convert to shortnames to standardize the text
    var converted = emojione.toShort(inputted);
  
    // update textarea with new text
    document.getElementById('myTextarea').innerHTML = converted;
  }

</script>
```



##### On Output:

```html
<textarea id="myTextarea">Hello World! :smile:</textarea>

<script type="text/javascript">

  // get the standardized text
  var inputted = document.getElementById('myTextarea').value;
  
  // convert shortnames emoji images
  var converted = emojione.toImage(inputted);
  
  // update textarea with new text
  document.getElementById('myTextarea').innerHTML = converted;

</script>
```


## PHP Example

Below is an example of a PHP only implemention of Emoji One. 

#### On Input 
```php
# include the PHP library (if not autoloaded)
require('Emojione.class.php');
  
# $string would normally be text submitted from a form
$string = 'Hello world! 😄';

# convert text to shortnames
$convertedString =  Emojione::toShort($string); 

###

# This is where you'd now store the standardized text in your database

###
```


#### On Output 
```php
# include the PHP library (if not autoloaded)
require('Emojione.class.php');

################################################ 
# Optional:
# default is PNG but you may also use SVG
Emojione::$imageType = 'svg';

# default is jsDelivr but you can also change the paths
# if you want to host the iamges somewhere else
Emojione::$imagePathPNG = './../images/png/';
Emojione::$imagePathSVG = './../images/svg/';
################################################ 

# $string would normally standardized text retrieve from your database
$string = 'Hello world! :smile:';

# convert shortnames to images
$convertedString =  Emojione::toImage($string); 

###

# This is where you'd now output the converted text to the browser

###
```

## Considerations
**Character Encoding &mdash; UTF-8**

If you're getting serious about implementing emojis into your website, you will want to consider your web stack's character encoding. You should make sure that all connection points are using the same encoding. There's a lot of options and configuration possibilies here, so you'll have to figure what works best depending on your own situation. 

A quick Google search will bring up a lot of information on how to get your entire web stack to use UTF-8, which is needed to properly handle Unicode emojis. 

To get you started, here's a nice guide: [UTF-8: The Secret of Character Encoding](http://htmlpurifier.org/docs/enduser-utf8.html).

## Information

### Contact

If you have any questions, comments, or concerns you are welcome to contact us.

* [support@emojione.com](mailto:support@emojione.com)
* http://emojione.com
* https://twitter.com/emojione
* https://facebook.com/emojione

### Bug reports

If you discover any bugs, feel free to create an issue on GitHub. We also welcome the open-source community to contribute to the project by forking it and issuing pull requests.

 *  https://github.com/emojione/issues

### Alternatives
We sincerely hope that you choose to use Emoji One and support our project, but if you feel like it's not for you please have a look at these possible alternatives:

* https://github.com/hassankhan/emojify.js
* https://github.com/node-modules/emoji
* https://github.com/iamcal/php-emoji
* https://github.com/Genshin/PhantomOpenEmoji
* https://github.com/steveklabnik/emoji
* https://github.com/rockerhieu/emojicon


## Licenses

#### Emoji One Artwork

*  Applies to all PNG and SVG files as well as any adaptations made.
*  License: Creative Commons Attribution-ShareAlike 4.0 International
*  Human Readable License: http://creativecommons.org/licenses/by-sa/4.0/
*  Complete Legal Terms: http://creativecommons.org/licenses/by-sa/4.0/legalcode


#### Emoji One Non-Artwork

*  Applies to the Javascript, JSON, PHP, CSS, HTML files, and everything else not covered under the artwork license above.
*  License: GPL v2 or later
*  Complete Legal Terms: http://www.gnu.org/licenses/gpl-2.0.html
