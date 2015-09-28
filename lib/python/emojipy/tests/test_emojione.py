# -*- coding: utf-8; -*-

from unittest import TestCase
from emojipy import Emoji


class EmojipyTest(TestCase):
    def setUp(self):
        pass

    def test_unicode_to_image(self):
        txt = 'Hello world! 😄 :smile:'
        expected = """Hello world! <img class="emojione" alt="😄" src="https://cdn.jsdelivr.net/emojione/assets/png/1F604.png%s"/> :smile:""" %\
                   Emoji.cache_bust_param

        self.assertEqual(Emoji.unicode_to_image(txt), expected)

    def test_shortcode_to_image(self):
        txt = 'Hello world! 😄 :smile:'
        expected = """Hello world! 😄 <img class="emojione" alt="😄" src="https://cdn.jsdelivr.net/emojione/assets/png/1F604.png%s"/>""" %\
                   Emoji.cache_bust_param
        self.assertEqual(Emoji.shortcode_to_image(txt), expected)
        Emoji.unicode_alt = False
        expected = """Hello world! 😄 <img class="emojione" alt=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/png/1F604.png%s"/>""" %\
                   Emoji.cache_bust_param
        self.assertEqual(Emoji.shortcode_to_image(txt), expected)
        Emoji.unicode_alt = True

    def test_shortcode_to_ascii(self):
        txt = 'Hello world! 😄 :smile:'
        expected = [
            'Hello world! 😄 :]',
            'Hello world! 😄 :-)',
            'Hello world! 😄 =)',
            'Hello world! 😄 :)',
            'Hello world! 😄 =]'
        ]

        output = Emoji.shortcode_to_ascii(txt)
        self.assertIn(output, expected)
