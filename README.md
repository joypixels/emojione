#![EmojiOne Logo](http://git.emojione.com/assets/logo.png) EmojiOne [![Build Status](https://travis-ci.org/Ranks/emojione.svg?branch=master)](https://travis-ci.org/Ranks/emojione)
> bringing you [emojione.com](http://emojione.com/) & [emoji.codes](http://emoji.codes/)

The web's first and only complete open source emoji set. It is 100% free and super easy to integrate.



## The Idea

To standardize emoji on the web through the use of common :shortnames:.

When storing user inputted text in your database, say from a guestbook or through a CMS admin, it is recommended that you store text containing only :shortnames: and not Unicode emoji characters or emoji images. Then, when you are displaying that content to the user, you can convert it server-side with the PHP toolkit provided, or client-side using the Javascript toolkit which is also provided. Demos of this process using Javascript, jQuery, and PHP are included in the repo, and we have example code snippets below.


#### _What are Shortnames?_

 Shortnames are semi-standardized human-readable identifiers for each emoji icon. Many online web applications will accept these shortnames as alternatives for the actual unicode character. We've compiled the full list over at [emoji.codes](http://emoji.codes/) with quick copy & search functions.
 


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
We sincerely hope that you choose to use EmojiOne and support our project, but if you feel like it's not for you, please have a look at these possible alternatives:

* https://github.com/hassankhan/emojify.js
* https://github.com/Genshin/PhantomOpenEmoji
* https://github.com/iamcal/php-emoji
* https://github.com/node-modules/emoji
* https://github.com/steveklabnik/emoji
* https://github.com/rockerhieu/emojicon
* https://github.com/HenrikJoreteg/emoji-images
* https://github.com/frissdiegurke/emoji-parser