![EmojiOne Logo](http://git.emojione.com/assets/logo.png)

#### \*PLEASE NOTE\*
The following is related to an older, unsupported version of the EmojiOne emoji artwork (v2.x). They are still available under their old terms, which can be found below.

# EmojiOne [![Build Status](https://travis-ci.org/Ranks/emojione.svg?branch=master)](https://travis-ci.org/Ranks/emojione)
_bringing you [emojione.com](http://emojione.com/) & [emoji.codes](http://emoji.codes/)_

The web's first and only complete open source emoji set. It is 100% free and super easy to integrate.



## The Idea

To standardize emoji on the web through the use of common :shortnames:.

When storing user inputted text in your database, say from a guestbook or through a CMS admin, it is recommended that you store text containing only :shortnames: and not Unicode emoji characters or emoji images. Then, when you are displaying that content to the user, you can convert it server-side with the PHP toolkit provided, or client-side using the Javascript toolkit which is also provided. Demos of this process using Javascript, jQuery, and PHP are included in the repo, and we have example code snippets below.


#### _What are Shortnames?_

 Shortnames are semi-standardized human-readable identifiers for each emoji icon. Many online web applications will accept these shortnames as alternatives for the actual unicode character. We've compiled the full list over at [emoji.codes](http://emoji.codes/) with quick copy & search functions.




## Installation

We've teamed up with [JSDelivr](http://www.jsdelivr.com/#!emojione) to provide a simple way to install these emoji on any javascript-enabled website. Add the following script and stylesheet links to the head of your webpage:

```
<script src="https://cdn.jsdelivr.net/emojione/2.2.7/lib/js/emojione.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/2.2.7/assets/css/emojione.min.css"/>
```

Alternatively, CDNjs is also available as a [CDN Host for EmojiOne](https://cdnjs.com/libraries/emojione).

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

This demo shows you how to take input containing only shortnames and translate it directly to EmojiOne images. (when displaying the unified input to clients)

**[.unicodeToImage\(str\)](http://git.emojione.com/demos/latest/jsunicodetoimage.html)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to EmojiOne images. (would be great for a live editor preview)

**[.toImage\(str\)](http://git.emojione.com/demos/latest/jstoimage.html)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into EmojiOne images for display.


### PHP Conversion

##### As of version 1.4.1 this library syntax has changed.

**[toShort\($str\)](http://git.emojione.com/demos/latest/phptoshort.php)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[shortnameToImage\($str\)](http://git.emojione.com/demos/latest/phpshortnametoimage.php)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to EmojiOne images. (when displaying the unified input to clients)

**[unicodeToImage\($str\)](http://git.emojione.com/demos/latest/phpunicodetoimage.php)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to EmojiOne images. (would be great for a live editor preview)

**[toImage\($str\)](http://git.emojione.com/demos/latest/phptoimage.php)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into EmojiOne images for display.


##### Note: As of version 1.4.1 the following implementation has been deprecated. It's included in the library for backwards compatibility but will be removed at a later date.

**[::toShort\($str\)](http://git.emojione.com/demos/1.4.0/phptoshort.php)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[::shortnameToImage\($str\)](http://git.emojione.com/demos/1.4.0/phpshortnametoimage.php)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to EmojiOne images. (when displaying the unified input to clients)

**[::unicodeToImage\($str\)](http://git.emojione.com/demos/1.4.0/phpunicodetoimage.php)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to EmojiOne images. (would be great for a live editor preview)

**[::toImage\($str\)](http://git.emojione.com/demos/1.4.0/phptoimage.php)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into EmojiOne images for display.

### Meteor Conversion

#### Template helpers

```handlebars
My emoji {{> emojione ':beers:'}} text.
```

Or

```handlebars
{{#emojione}}My emoji :beers: text.{{/emojione}}
```

### Swift Conversion

```swift
Emojione.transform(string: "Rocket.Chat: :rocket:")
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

With an additional CSS file you can use EmojiOne as resizable PNG sprites (up to 64x64).

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

* [Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/Ranks/emojione?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge)
* [support@emojione.com](mailto:support@emojione.com)
* https://emojione.com
* https://twitter.com/emojione


### Alternatives
We sincerely hope that you choose to use EmojiOne and support our project, but if you feel like it's not for you, please have a look at these possible alternatives:

* https://github.com/hassankhan/emojify.js
* https://github.com/Genshin/PhantomOpenEmoji
* https://github.com/iamcal/php-emoji
* https://github.com/node-modules/emoji
* https://github.com/steveklabnik/emoji
* https://github.com/rockerhieu/emojicon
* https://github.com/HenrikJoreteg/emoji-images
* https://github.com/frissdiegurke/emoji-parser

## Licenses

### EmojiOne Artwork

*  Applies to all PNG and SVG files as well as any adaptations made.
*  The following applies to artwork included in EmojiOne GitHub libraries versions < 2.0.0.
    *  License: Creative Commons Attribution-ShareAlike 4.0 International
    *  Human Readable License: http://creativecommons.org/licenses/by-sa/4.0/
    *  Complete Legal Terms: http://creativecommons.org/licenses/by-sa/4.0/legalcode
*  The following applies to artwork included in EmojiOne GitHub libraries versions >= 2.0.0 and < 3.0.0.
    *  License: Creative Commons Attribution 4.0 International
    *  Human Readable License: http://creativecommons.org/licenses/by/4.0/
    *  Complete Legal Terms: http://creativecommons.org/licenses/by/4.0/legalcode
  
### EmojiOne Non-Artwork

*  Applies to: Javascript, JSON, PHP, CSS, HTML files, and everything else not covered under the artwork license above.
*  License: MIT
*  Complete Legal Terms: http://opensource.org/licenses/MIT


## EmojiOne Artwork Attribution

In general, proper attribution/credit must be given on every web page, app, or video description where our emojis are displayed. More specific information for each category can be found below.

### Creative Commons Requirements

In section 3(a)(1) of the CC-BY 4.0 legal terms, it lists the following as the guidelines needed to fulfill the attribution requirements:

> If You Share the Licensed Material (including in modified form), You must:
> - retain the following if it is supplied by the Licensor with the Licensed Material:
>     - identification of the creator(s) of the Licensed Material and any others designated to receive attribution, in any reasonable manner requested by the Licensor (including by pseudonym if designated);
>     - a copyright notice;
>     - a notice that refers to this Public License;
>     - a notice that refers to the disclaimer of warranties;
>     - a URI or hyperlink to the Licensed Material to the extent reasonably practicable;
> - indicate if You modified the Licensed Material and retain an indication of any previous modifications; and
> - indicate the Licensed Material is licensed under this Public License, and include the text of, or the URI or hyperlink to, this Public License."

### Proper Attribution Examples

Must contain:
- Our name (EmojiOne)
- A link to our website (https://www.emojione.com)
- The title and a link to our Creative Commons license

Also helpful:
- Make sure it does not look like we created or endorse your product
- List all modifications you've made to the artwork

### Ideal Attribution

> Emoji artwork is provided by [EmojiOne](https://www.emojione.com) and is licensed under [CC-BY 4.0](https://creativecommons.org/licenses/by/4.0/legalcode)

### Attribution Location

Apps:
- A note/link in the app store description is required.
- Other links/praise are much appreciated:
    - App settings
    - Official app website
    - Social media
    
Websites:
- A note/link on every web page where our emojis are displayed is required.
- Other links/praise are much appreciated:
    - Main homepage
    - Social media
    
Web Videos:
- A note/link in the video description is required.
- Other links/praise are much appreciated:
    - On-screen when emojis are displayed
    - On-screen in credits
    - Social media
