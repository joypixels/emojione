#![Emoji One Logo](http://git.emojione.com/assets/logo.png) Emoji One [![Build Status](https://travis-ci.org/Ranks/emojione.svg?branch=master)](https://travis-ci.org/Ranks/emojione)
> bringing you [emojione.com](http://emojione.com/) & [emoji.codes](http://emoji.codes/)

The web's first and only complete open source emoji set. It is 100% free and super easy to integrate.



## The Idea

To standardize emoji on the web through the use of common :shortnames:.

When storing user inputted text in your database, say from a guestbook or through a CMS admin, you should always make sure you are storing text containing only :shortnames: and not Unicode emoji characters or emoji images. Then, when you are displaying that content to the user, you can convert it server-side with the PHP toolkit provided, or client-side using the Javascript toolkit which is also provided. Demos of this process using Javascript, jQuery, and PHP are included in the repo, and we have example code snippets below.


#### _What are Shortnames?_

 Shortnames are semi-standardized human-readable identifiers for each emoji icon. Many online web applications will accept these shortnames as alternatives for the actual unicode character. We've compiled the full list over at [emoji.codes](http://emoji.codes/) with quick copy & search functions.




## Installation

We've teamed up with [JSDelivr](http://www.jsdelivr.com/#!emojione) to provide a simple way to install these emoji on any javascript-enabled website. Add the following script and stylesheet links to the head of your webpage:

```
<script src="//cdn.jsdelivr.net/emojione/2.2.6/lib/js/emojione.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/emojione/2.2.6/assets/css/emojione.min.css"/>
```

Alternatively, CDNjs is also available as a [CDN Host for Emoji One](https://cdnjs.com/libraries/emojione).

Quick installs can also be done using NPM and Bower (for the Javascript toolkit) or Composer (for the PHP toolkit).

#### NPM
```
> npm install emojione
```

#### Bower
```
> bower install emojione
```


#### Composer
```
$ composer require emojione/emojione
```

#### Meteor
```
meteor add emojione:emojione
```


## Usage Examples

Below there are some examples of how you will actually use the libraries to convert Unicode emoji characters to :shortnames: and :shortnames: to emoji images.


### Javascript Conversion


**[.toShort\(str\)](http://git.emojione.com/demos/latest/jstoshort.html)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[.shortnameToImage\(str\)](http://git.emojione.com/demos/latest/jsshortnametoimage.html)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to Emoji One images. (when displaying the unified input to clients)

**[.unicodeToImage\(str\)](http://git.emojione.com/demos/latest/jsunicodetoimage.html)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to Emoji One images. (would be great for a live editor preview)

**[.toImage\(str\)](http://git.emojione.com/demos/latest/jstoimage.html)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into Emoji One images for display.


### PHP Conversion

##### As of version 1.4.1 this library syntax has changed.

**[toShort\($str\)](http://git.emojione.com/demos/latest/phptoshort.php)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[shortnameToImage\($str\)](http://git.emojione.com/demos/latest/phpshortnametoimage.php)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to Emoji One images. (when displaying the unified input to clients)

**[unicodeToImage\($str\)](http://git.emojione.com/demos/latest/phpunicodetoimage.php)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to Emoji One images. (would be great for a live editor preview)

**[toImage\($str\)](http://git.emojione.com/demos/latest/phptoimage.php)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into Emoji One images for display.


##### Note: As of version 1.4.1 the following implementation has been deprecated. It's included in the library for backwards compatibility but will be removed at a later date.

**[::toShort\($str\)](http://git.emojione.com/demos/1.4.0/phptoshort.php)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[::shortnameToImage\($str\)](http://git.emojione.com/demos/1.4.0/phpshortnametoimage.php)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to Emoji One images. (when displaying the unified input to clients)

**[::unicodeToImage\($str\)](http://git.emojione.com/demos/1.4.0/phpunicodetoimage.php)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to Emoji One images. (would be great for a live editor preview)

**[::toImage\($str\)](http://git.emojione.com/demos/1.4.0/phptoimage.php)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into Emoji One images for display.

### Meteor Conversion

#### Template helpers

```handlebars
My emoji {{> emojione ':beers:'}} text.
```

Or

```handlebars
{{#emojione}}My emoji :beers: text.{{/emojione}}
```

### Extras

**[shortnameToUnicode(str)](http://git.emojione.com/demos/latest/shortnametounicode.html)**

Change from shortnames to native unicode emoji.

**[Shortname Autocomplete](http://git.emojione.com/demos/latest/autocomplete.html)**

Easily add shortname autocomplete functionality to any text input on your page.

**[ASCII Smiley Conversion](http://git.emojione.com/demos/latest/ascii-smileys.html)**

With one quick step you can start converting common ASCII smileys to their corresponding images.

**[Alternate Alt Tags](http://git.emojione.com/demos/latest/alternate-alt-tags.html)**

Change from the native unicode emoji in the resulting alt tags to their shortnames instead.

**[Live Preview Box](http://git.emojione.com/demos/latest/live-preview.html)**

Display converted Emoji in a preview box as the user is typing.

**[Conversion HTML Class](http://git.emojione.com/demos/latest/class-convert.html)**

Stick a class of .emojione-convert on any HTML element and automatically convert native unicode emoji and/or shortnames to images after page load.

**[Convert on Form Submission](http://git.emojione.com/demos/latest/convert-on-submit.html)**

Converts unicode input to shortnames once the user submits the form.

**[Sprites (PNG)](http://git.emojione.com/demos/latest/sprites-png.html)**

With an additional CSS file you can use Emoji One as resizable PNG sprites (up to 64x64).

**[Sprites (SVG)](http://git.emojione.com/demos/latest/sprites-svg.html)**

This sprite method requires no extra CSS, and is infinitely resizable.


## Other Considerations
### Character Encoding &mdash; UTF-8

If you're getting serious about implementing emoji into your website, you will want to consider your web stack's character encoding. You should make sure that all connection points are using the same encoding. There are a lot of options and configuration possibilities here, so you'll have to figure what works best for your own situation. 

A quick Google search will bring up a lot of information on how to get your entire web stack to use UTF-8, which is needed to properly handle Unicode emoji.

To get you started, here's a nice guide: [UTF-8: The Secret of Character Encoding](http://htmlpurifier.org/docs/enduser-utf8.html).

## Information

### Bug reports

If you discover any bugs, feel free to create an issue on GitHub. We also welcome the open-source community to contribute to the project by forking it and issuing pull requests.

 *  https://github.com/Ranks/emojione/issues


### Contact

If you have any questions, comments, or concerns you are welcome to contact us.

*  [![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/Ranks/emojione?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
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
* https://github.com/HenrikJoreteg/emoji-images
* https://github.com/frissdiegurke/emoji-parser

## Licenses

### Emoji One Artwork

*  Applies to all PNG and SVG files as well as any adaptations made.
*  The following applies to artwork included in Emoji One GitHub libraries versions < 2.0.0.
  *  License: Creative Commons Attribution-ShareAlike 4.0 International
  *  Human Readable License: http://creativecommons.org/licenses/by-sa/4.0/
  *  Complete Legal Terms: http://creativecommons.org/licenses/by-sa/4.0/legalcode
*  The following applies to artwork included in Emoji One GitHub libraries versions >= 2.0.0.
  *  License: Creative Commons Attribution 4.0 International
  *  Human Readable License: http://creativecommons.org/licenses/by/4.0/
  *  Complete Legal Terms: http://creativecommons.org/licenses/by/4.0/legalcode


### Emoji One Non-Artwork

*  Applies to the Javascript, JSON, PHP, CSS, HTML files, and everything else not covered under the artwork license above.
*  License: MIT
*  Complete Legal Terms: http://opensource.org/licenses/MIT
