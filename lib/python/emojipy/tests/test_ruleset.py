#!/usr/bin/env python3
# -*- coding: utf-8; -*-

from __future__ import unicode_literals
from unittest import TestCase
import json

from emojipy.ruleset import ascii_replace,\
    unicode_replace, shortcode_replace, category_replace

json_path = '../../emoji.json'


class MappingTests(TestCase):
    def setUp(self):
        self.ascii_list = []
        with open(json_path) as json_file:
            content = json_file.read()
            self.json_dict = json.loads(content)
            self.emoji_count = len(self.json_dict)
        for key, value in self.json_dict.items():
            self.ascii_list.extend(value['ascii'])

    def test_unicode_count(self):
        self.assertEqual(self.emoji_count, len(unicode_replace))
        self.assertEqual(len(ascii_replace), len(self.ascii_list))
        self.assertEqual(len(shortcode_replace), len(unicode_replace))
