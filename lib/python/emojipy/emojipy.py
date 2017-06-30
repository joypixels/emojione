# -*- coding: utf-8; -*-

from __future__ import unicode_literals
import re
import six
if six.PY3:
    from html import escape, unescape
else:
    from cgi import escape
    from HTMLParser import HTMLParser
    import struct
    unescape = HTMLParser.unescape
    chr = unichr

from .ruleset import unicode_replace,\
    shortcode_replace, ascii_replace, category_replace


class Emoji(object):

    ascii = False
    unicode_alt = True
    sprites = False
    image_png_path = 'https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/'
    ignored_regexp = '<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>'
    unicode_regexp = "(" + '|'.join([re.escape(x.decode("utf-8")) for x in sorted(unicode_replace.keys(), key=len, reverse=True)]) + ")"
    shortcode_regexp = ':([-+\\w]+):'
    ascii_regexp = '(\\<3|&lt;3|\\<\\/3|&lt;\\/3|\\:\'\\)|\\:\'\\-\\)|\\:D|\\:\\-D|\\=D|\\:\\)|\\:\\-\\)|\\=\\]|\\=\\)|\\:\\]|\'\\:\\)|\'\\:\\-\\)|\'\\=\\)|\'\\:D|\'\\:\\-D|\'\\=D|\\>\\:\\)|&gt;\\:\\)|\\>;\\)|&gt;;\\)|\\>\\:\\-\\)|&gt;\\:\\-\\)|\\>\\=\\)|&gt;\\=\\)|;\\)|;\\-\\)|\\*\\-\\)|\\*\\)|;\\-\\]|;\\]|;D|;\\^\\)|\'\\:\\(|\'\\:\\-\\(|\'\\=\\(|\\:\\*|\\:\\-\\*|\\=\\*|\\:\\^\\*|\\>\\:P|&gt;\\:P|X\\-P|x\\-p|\\>\\:\\[|&gt;\\:\\[|\\:\\-\\(|\\:\\(|\\:\\-\\[|\\:\\[|\\=\\(|\\>\\:\\(|&gt;\\:\\(|\\>\\:\\-\\(|&gt;\\:\\-\\(|\\:@|\\:\'\\(|\\:\'\\-\\(|;\\(|;\\-\\(|\\>\\.\\<|&gt;\\.&lt;|\\:\\$|\\=\\$|#\\-\\)|#\\)|%\\-\\)|%\\)|X\\)|X\\-\\)|\\*\\\\0\\/\\*|\\\\0\\/|\\*\\\\O\\/\\*|\\\\O\\/|O\\:\\-\\)|0\\:\\-3|0\\:3|0\\:\\-\\)|0\\:\\)|0;\\^\\)|O\\:\\-\\)|O\\:\\)|O;\\-\\)|O\\=\\)|0;\\-\\)|O\\:\\-3|O\\:3|B\\-\\)|B\\)|8\\)|8\\-\\)|B\\-D|8\\-D|\\-_\\-|\\-__\\-|\\-___\\-|\\>\\:\\\\|&gt;\\:\\\\|\\>\\:\\/|&gt;\\:\\/|\\:\\-\\/|\\:\\-\\.|\\:\\/|\\:\\\\|\\=\\/|\\=\\\\|\\:L|\\=L|\\:P|\\:\\-P|\\=P|\\:\\-p|\\:p|\\=p|\\:\\-Þ|\\:\\-&THORN;|\\:Þ|\\:&THORN;|\\:þ|\\:&thorn;|\\:\\-þ|\\:\\-&thorn;|\\:\\-b|\\:b|d\\:|\\:\\-O|\\:O|\\:\\-o|\\:o|O_O|\\>\\:O|&gt;\\:O|\\:\\-X|\\:X|\\:\\-#|\\:#|\\=X|\\=x|\\:x|\\:\\-x|\\=#)'
    shortcode_compiled = re.compile(ignored_regexp+"|("+shortcode_regexp+")",
                                    re.IGNORECASE)
    unicode_compiled = re.compile(ignored_regexp+"|("+unicode_regexp+")",
                                  re.UNICODE)
    ascii_compiled = re.compile(ignored_regexp+"|("+ascii_regexp+")",
                                re.IGNORECASE)

    @classmethod
    def to_image(cls, text):
        text = cls.unicode_to_image(text)
        text = cls.shortcode_to_image(text)

        return text

    @classmethod
    def unicode_to_image(cls, text):
        def replace_unicode(match):
            unicode_char = text[match.start():match.end()]
            unicode_encoded = unicode_char.encode('utf-8')
            if not unicode_encoded or unicode_encoded not in unicode_replace:
                return unicode_char  # unsupported unicode char
            shortcode = unicode_replace[unicode_encoded]
            if cls.unicode_alt:
                alt = unicode_char
            else:
                alt = shortcode
            filename = shortcode_replace[shortcode]
            category = category_replace[shortcode]

            if cls.sprites:
                return '<span class="emojione emojione-32-%s _%s" title="%s">%s</span>'\
                    % (category, filename, escape(shortcode), alt)
            else:
                return '<img class="emojione" alt="%s" src="%s"/>' % (
                    alt,
                    cls.image_png_path+filename+'.png'
                )

        text = re.sub(cls.unicode_compiled, replace_unicode, text)
        return text

    @classmethod
    def shortcode_to_image(cls, text):
        def replace_shortcode(match):
            shortcode = text[match.start():match.end()]
            if not shortcode or shortcode not in shortcode_replace:
                return shortcode
            unicode = shortcode_replace[shortcode]
            if cls.unicode_alt:
                alt = cls.convert(unicode)
            else:
                alt = shortcode
            filename = shortcode_replace[shortcode]
            category = category_replace[shortcode]
            
            if cls.sprites:
                return '<span class="emojione emojione-32-%s _%s" title="%s">%s</span>'\
                    % (category, filename, escape(shortcode), alt)
            else:
                return '<img class="emojione" alt="%s" src="%s"/>' % (
                    alt,
                    cls.image_png_path+filename+'.png'
                )

        text = re.sub(cls.shortcode_compiled, replace_shortcode, text)
        if cls.ascii:
            return cls.ascii_to_image(text)
        return text

    @classmethod
    def shortcode_to_ascii(cls, text):
        def replace_shortcode(match):
            shortcode = text[match.start():match.end()]
            if not shortcode or shortcode not in shortcode_replace:
                return shortcode
            unicode = shortcode_replace[shortcode]
            reverse_ascii_unicode = {v: k for k, v in ascii_replace.items()}
            if unicode in reverse_ascii_unicode:
                return reverse_ascii_unicode[unicode]
            return shortcode

        return re.sub(cls.shortcode_compiled, replace_shortcode, text)

    @classmethod
    def shortcode_to_unicode(cls, text):
        def replace_shortcode(match):
            shortcode = text[match.start():match.end()]
            if not shortcode or shortcode not in shortcode_replace:
                return shortcode
            flipped_unicode_replace = {v: k for k, v in unicode_replace.items()}
            if shortcode in flipped_unicode_replace:
                return flipped_unicode_replace[shortcode].decode('utf8')
            return shortcode
        text = re.sub(cls.shortcode_compiled, replace_shortcode, text)
        if cls.ascii:
            return cls.ascii_to_unicode(text)
        return text

    @classmethod
    def ascii_to_unicode(cls, text):
        def replace_ascii(match):
            ascii = text[match.start():match.end()]
            ascii = unescape(ascii)  # convert escaped HTML entities back to original chars
            if not ascii or ascii not in ascii_replace:
                return ascii
            return cls.convert(ascii_replace[ascii])
        return re.sub(cls.ascii_compiled, replace_ascii, text)

    @classmethod
    def ascii_to_image(cls, text):
        def replace_ascii(match):
            ascii = text[match.start():match.end()]
            ascii = unescape(ascii)  # convert escaped HTML entities back to original chars
            if not ascii or ascii not in ascii_replace:
                return ascii
            unicode = ascii_replace[ascii]
            if cls.unicode_alt:
                alt = cls.convert(unicode)
            else:
                alt = escape(ascii)
            
            return '<img class="emojione" alt="%s" src="%s"/>' % (
                alt,
                cls.image_png_path+unicode+'.png'
            )
        return re.sub(cls.ascii_compiled, replace_ascii, text)

    @classmethod
    def convert(cls, hex_unicode):

        def char(i):
            try:
                return chr(i)
            except ValueError:
                return struct.pack('i', i).decode('utf-32')

        """
        Convert a unicode in hex string to actual unicode char
        """

        if '-' not in hex_unicode:
            return char(int(hex_unicode, 16))
        parts = hex_unicode.split('-')
        return ''.join(char(int(x, 16)) for x in parts)
