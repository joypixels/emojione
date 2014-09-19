#![Emoji One Logo](http://git.emojione.com/assets/png/1F40C.png) Emoji One
> bringing you [emojione.com](http://emojione.com/) & [emoji.codes](http://emoji.codes/)

The web's first and only complete open source emoji set. It is 100% free and super easy to integrate.


## The Idea

To standardize emoji on the web through the use of common :shortnames:. 

When storing user inputted text in your database, say from a guestbook or through a CMS admin, you should always make sure you are storing text containing only :shortnames: and not Unicode emoji characters or emoji images. Then, when you are displaying that content to the user, you can convert it server-side with the PHP toolkit provided, or client-side using the Javascript toolkit which is also provided. Demos of this process using Javascript, jQuery, and PHP are included in the repo, and we have example code snippets below.


> **What Shortnames?**
> 
> [emoji.codes](http://emoji.codes/) has a complete list of shortnames as well as quick copy & search functions.


## Installation

The easiest, and preferred, method of installation is to use our CDN partner [jsDelivr](http://www.jsdelivr.com/). You can hotlink our CSS and JS files. The toolkits we've provided will use the emoji images hosted on jsDelivr by default. 

Quick installs can also be done using NPM (for the Javascript toolkit) or Composer (for the PHP toolkit).

#### NPM
```
> npm install emojione
```

#### Composer
```
 "require": { "emojione/emojione": "dev-master" }
```

Below there are some examples of how you will actually use the libraries to convert Unicode emoji characters to :shortnames: and :shortnames: to emoji images.

The basic flow is as follows:

* The user inputs their text using shortnames and/or standard Unicode characters.
* (a) Prior to form submission, any Unicode emoji characters are converted to :shortnames: with the Javascript toolkit
* (b) **OR** after posting, but before storing the text in your database, any Unicode emoji characters are converted to shortnames using the PHP toolkit.
* (a) When you pull the text out of your database, you can convert the :shortnames: to emoji images server-side using the PHP toolkit
* (b) **OR** after outputting, you can convert the :shortnames: to emoji images client-side using the Javascript toolkit.



## Javascript Example

Below is an example of a Javascript-only implemention of Emoji One. 

Include the Javascript toolkit
```html
<head>
	<!-- include via jsDelivr (or download and host locally if you prefer) -->
    <script src="//cdn.jsdelivr.net/emojione/1.1.0/lib/js/emojione.min.js" type="text/javascript"></script>
    
    <!-- basic rules for styling the emoji images -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/emojione/1.1.0/assets/css/emojione.min.css" type="text/css" media="all" />
    
     <script type="text/javascript">
       // #################################################
       // # Optional
       
       // default is PNG but you may also use SVG
       emojione.imageType = 'svg';
       
       // default is ignore ASCII smileys like :) but you can easily turn them on
       emojione.ascii = true;
       
       // default is jsDelivr but you can also change the paths 
       // if you want to host the images somewhere else
       emojione.imagePathPNG = './../images/png/';
       emojione.imagePathSVG = './../images/svg/';
       
       // #################################################
    </script>

</head>
```


##### On Input:
Before text is sent to your server, convert any Unicode emoji to shortnames:
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
<div id="myContent">Hello World! :smile:</div>

<script type="text/javascript">

  // get the standardized text
  var inputted = document.getElementById('myContent').innerHTML;
  
  // convert shortnames emoji images
  var converted = emojione.toImage(inputted);
  
  // update textarea with new text
  document.getElementById('myContent').innerHTML = converted;

</script>
```


## jQuery Examples

Below are some examples of things you can easily do with jQuery. It assumes that both our Javascript toolkit and jQuery are already included in your page.

##### Form Submissions

Automatically convert form fields containing Unicode emoji to :shortnames:
```html
<form id="myForm">
	<input type="text" id="myInput" name="myInput"/> 
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $("#myForm").on('submit',function() {
            var input = $('#myInput').val();
            var replaced = emojione.toShort(input);
            $('#myInput').val(replaced);
        });
    });
</script>
```

##### Automatic Conversion

Easily convert :shortnames: in any HTML element by applying an identifying class like this:
```html
<div class="emojione-convert">
    I hope you like this Emoji One! :thumbsup: 
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".emojione-convert").each(function() {
            var original = $(this).html();
            var converted = emojione.toImage(original);
            $(this).html(converted);
        });
    });
</script>
```


## PHP Example

Below is an example of a PHP only implemention of Emoji One. 

#### On Input 
```php
# include the PHP toolkit (if not autoloaded)
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
# include the PHP toolkit (if not autoloaded)
require('Emojione.class.php');

################################################ 
# Optional:
# default is PNG but you may also use SVG
Emojione::$imageType = 'svg';

# default is ignore ASCII smileys like :) but you can easily turn them on
Emojione::$ascii = true;

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

## Other Considerations
**Character Encoding &mdash; UTF-8**

If you're getting serious about implementing emoji into your website, you will want to consider your web stack's character encoding. You should make sure that all connection points are using the same encoding. There are a lot of options and configuration possibilies here, so you'll have to figure what works best for your own situation. 

A quick Google search will bring up a lot of information on how to get your entire web stack to use UTF-8, which is needed to properly handle Unicode emoji. 

To get you started, here's a nice guide: [UTF-8: The Secret of Character Encoding](http://htmlpurifier.org/docs/enduser-utf8.html).

## Information

### Bug reports

If you discover any bugs, feel free to create an issue on GitHub. We also welcome the open-source community to contribute to the project by forking it and issuing pull requests.

 *  https://github.com/emojione/issues


### Contact

If you have any questions, comments, or concerns you are welcome to contact us.

* [support@emojione.com](mailto:support@emojione.com)
* http://emojione.com
* https://twitter.com/emojione


### Alternatives
We sincerely hope that you choose to use Emoji One and support our project, but if you feel like it's not for you, please have a look at these possible alternatives:

* https://github.com/hassankhan/emojify.js
* https://github.com/Genshin/PhantomOpenEmoji
* https://github.com/iamcal/php-emoji
* https://github.com/node-modules/emoji
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
*  License: MIT
*  Complete Legal Terms: http://opensource.org/licenses/MIT
