# -*- coding: utf-8; -*-

from __future__ import unicode_literals
from unittest import TestCase
from emojipy import Emoji


class EmojipyTest(TestCase):
    def setUp(self):
        pass

    def test_unicode_to_image(self):
        txt = 'Hello world! 😄 :smile:'
        expected = """Hello world! <img class="emojione" alt="😄" src="https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f604.png"/> :smile:"""

        self.assertEqual(Emoji.unicode_to_image(txt), expected)

    def test_shortcode_to_image(self):
        txt = 'Hello world! 😄 :smile:'
        expected = """Hello world! 😄 <img class="emojione" alt="😄" src="https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f604.png"/>"""
        self.assertEqual(Emoji.shortcode_to_image(txt), expected)
        Emoji.unicode_alt = False
        expected = """Hello world! 😄 <img class="emojione" alt=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/3.1/png/64/1f604.png"/>"""
        self.assertEqual(Emoji.shortcode_to_image(txt), expected)
        Emoji.unicode_alt = True

    def test_shortcode_to_ascii(self):
        txt = 'Hello world! 😄 :slight_smile:'
        expected = [
            'Hello world! 😄 :]',
            'Hello world! 😄 :-)',
            'Hello world! 😄 =)',
            'Hello world! 😄 :)',
            'Hello world! 😄 =]'
        ]

        output = Emoji.shortcode_to_ascii(txt)
        self.assertIn(output, expected)
