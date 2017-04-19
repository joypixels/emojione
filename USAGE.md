## Usage Examples

Below there are some examples of how you will actually use the libraries to convert Unicode emoji characters to :shortnames: and :shortnames: to emoji images.


### Javascript Conversion


**[.toShort\(str\)](https://demos.emojione.com/latest/jstoshort.html)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[.shortnameToImage\(str\)](https://demos.emojione.com/latest/jsshortnametoimage.html)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to EmojiOne images. (when displaying the unified input to clients)

**[.unicodeToImage\(str\)](https://demos.emojione.com/latest/jsunicodetoimage.html)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to EmojiOne images. (would be great for a live editor preview)

**[.toImage\(str\)](https://demos.emojione.com/latest/jstoimage.html)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into EmojiOne images for display.


### PHP Conversion

##### As of version 1.4.1 this library syntax has changed.

**[toShort\($str\)](https://demos.emojione.com/latest/phptoshort.php)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[shortnameToImage\($str\)](https://demos.emojione.com/latest/phpshortnametoimage.php)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to EmojiOne images. (when displaying the unified input to clients)

**[unicodeToImage\($str\)](https://demos.emojione.com/latest/phpunicodetoimage.php)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to EmojiOne images. (would be great for a live editor preview)

**[toImage\($str\)](https://demos.emojione.com/latest/phptoimage.php)** - _native unicode + shortnames -> images (mixed input)_

This demo shows you how to take input containing both native unicode emoji and shortnames, and translate it into EmojiOne images for display.


##### Note: As of version 1.4.1 the following implementation has been deprecated. It's included in the library for backwards compatibility but will be removed at a later date.

**[::toShort\($str\)](https://demos.emojione.com/1.4.0/phptoshort.php)** - _native unicode -> shortnames_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it to their corresponding shortnames. (we recommend this for database storage)

**[::shortnameToImage\($str\)](https://demos.emojione.com/1.4.0/phpshortnametoimage.php)** - _shortname -> images_

This demo shows you how to take input containing only shortnames and translate it directly to EmojiOne images. (when displaying the unified input to clients)

**[::unicodeToImage\($str\)](https://demos.emojione.com/1.4.0/phpunicodetoimage.php)** - _native unicode -> images_

This demo shows you how to take native unicode emoji input, such as that from your mobile device, and translate it directly to EmojiOne images. (would be great for a live editor preview)

**[::toImage\($str\)](https://demos.emojione.com/1.4.0/phptoimage.php)** - _native unicode + shortnames -> images (mixed input)_

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

**[shortnameToUnicode(str)](https://demos.emojione.com/latest/shortnametounicode.html)**

Change from shortnames to native unicode emoji.

**[Shortname Autocomplete](https://demos.emojione.com/latest/autocomplete.html)**

Easily add shortname autocomplete functionality to any text input on your page.

**[ASCII Smiley Conversion](https://demos.emojione.com/latest/ascii-smileys.html)**

With one quick step you can start converting common ASCII smileys to their corresponding images.

**[Alternate Alt Tags](https://demos.emojione.com/latest/alternate-alt-tags.html)**

Change from the native unicode emoji in the resulting alt tags to their shortnames instead.

**[Live Preview Box](https://demos.emojione.com/latest/live-preview.html)**

Display converted Emoji in a preview box as the user is typing.

**[Conversion HTML Class](https://demos.emojione.com/latest/class-convert.html)**

Stick a class of .emojione-convert on any HTML element and automatically convert native unicode emoji and/or shortnames to images after page load.

**[Convert on Form Submission](https://demos.emojione.com/latest/convert-on-submit.html)**

Converts unicode input to shortnames once the user submits the form.

**[Sprites (PNG)](https://demos.emojione.com/latest/sprites-png.html)**

With an additional CSS file you can use EmojiOne as resizable PNG sprites (up to 64x64).

**[Sprites (SVG)](https://demos.emojione.com/latest/sprites-svg.html)**

This sprite method requires no extra CSS, and is infinitely resizable.
