# -*- coding: utf-8; -*-

from __future__ import unicode_literals
from unittest import TestCase
from emojipy import Emoji


class ConversionTests(TestCase):
    """
    Test possible conversions from different kinds of input with
    unicode or shortname at different places
    """
    def setUp(self):
        self.emoji = Emoji
        self.emoji.sprites = False
        self.cache_bust_param = Emoji.cache_bust_param

    def test_single_unicode_char(self):
        unicode = '🐌'
        shortcode = ':snail:'
        image = '<img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/>'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_inside_sentence(self):
        unicode = 'The 🐌 is Emoji One\'s official mascot.'
        shortcode = 'The :snail: is Emoji One\'s official mascot.'
        image     = 'The <img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/> is Emoji One\'s official mascot.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_inside_sentence_with_comma(self):
        unicode = 'The 🐌, is Emoji One\'s official mascot.'
        shortcode = 'The :snail:, is Emoji One\'s official mascot.'
        image = 'The <img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/>, is Emoji One\'s official mascot.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_start_of_sentence(self):
        unicode = '🐌 mail.'
        shortcode = ':snail: mail.'
        image = '<img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/> mail.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_start_of_sentence_with_apostrophe(self):
        unicode = '🐌\'s are cool!'
        shortcode = ':snail:\'s are cool!'
        image = '<img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/>\'s are cool!'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_end_of_sentence(self):
        unicode = 'Emoji One\'s official mascot is 🐌.'
        shortcode = 'Emoji One\'s official mascot is :snail:.'
        image = 'Emoji One\'s official mascot is <img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/>.'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_end_of_sentence_with_alternate_punctuation(self):
        unicode = 'Emoji One\'s official mascot is 🐌!'
        shortcode = 'Emoji One\'s official mascot is :snail:!'
        image = 'Emoji One\'s official mascot is <img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/>!'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_at_end_of_sentence_with_preceeding_colon(self):
        unicode = 'Emoji One\'s official mascot: 🐌'
        shortcode = 'Emoji One\'s official mascot: :snail:'
        image = 'Emoji One\'s official mascot: <img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png'+self.cache_bust_param+'"/>'
        self.assertEqual(Emoji.unicode_to_image(unicode), image)
        self.assertEqual(Emoji.shortcode_to_image(shortcode), image)

    def test_emoji_inside_img_tag(self):
        unicode = 'The <img class="emojione" alt="🐌" src="https://cdn.jsdelivr.net/emojione/assets/png/1f40c.png" /> is Emoji One\'s official mascot.';
        self.assertEqual(Emoji.unicode_to_image(unicode), unicode)
        self.assertEqual(Emoji.shortcode_to_image(unicode), unicode)

    def test_emoji_inside_object_tag(self):
        unicode = 'The <object class="emojione" data="//cdn.jsdelivr.net/emojione/assets/svg/1f40c.svg" type="image/svg+xml" standby="🐌">🐌</object> is Emoji One\'s official mascot'
        self.assertEqual(Emoji.unicode_to_image(unicode), unicode)
        self.assertEqual(Emoji.shortcode_to_image(unicode), unicode)
