# -*- coding: utf-8; -*-

from __future__ import unicode_literals
from emojipy import Emoji
from unittest import TestCase


class SpriteTest(TestCase):
    def setUp(self):
        self.emoji = Emoji
        self.emoji.sprites = True
        self.emoji.unicode_alt = True

    def test_unicode_to_image(self):
        """
        Test 'unicode_to_image' method with 'sprites' enabled
        """

        text = 'Hello world! 😄 :smile:'
        expected = 'Hello world! <span class="emojione emojione-32-people _1f604" title=":smile:">😄</span> :smile:'

        self.assertEqual(self.emoji.unicode_to_image(text), expected)
