<?php

namespace Emojione\Test;

use Emojione\Emojione;

/**
 * Tests all Emojis from emoji.json
 */
class EmojiTest extends \PHPUnit_Framework_TestCase
{
    private $emojiVersion = '4.0';

    public function emojiProvider()
    {
        $file = dirname (__FILE__).'/../../../emoji.json';

        $string = file_get_contents($file);

        $json = json_decode($string, true);

        $data = array();

        foreach($json as $emoji)
        {
            $data[] = array(
                $emoji['shortname'],
                $emoji['unicode'],
            );
        }

        return $data;
    }

    /**
     * test all Emojis and shortcodes
     *
     * @dataProvider emojiProvider
     *
     * @return void
     */
    public function testEmojis($shortname, $simple_unicode)
    {
        $shortcode_replace = Emojione::getClient()->getRuleset()->getShortcodeReplace();
        $unicode_replace = Emojione::getClient()->getRuleset()->getUnicodeReplace();

        $unicode = Emojione::shortnameToUnicode($shortname);

        $this->assertNotTrue($unicode === $shortname);

        $this->assertTrue(isset($shortcode_replace[$shortname]));
        $this->assertEquals($shortcode_replace[$shortname], $simple_unicode);
        $this->assertTrue(in_array($unicode, $unicode_replace));
        $this->assertEquals($unicode_replace[$shortname], $unicode);

        $convert_unicode = strtolower(Emojione::convert($simple_unicode));

        $image_template = '<img class="emojione" alt="%1$s" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/%2$s.png"/>';

        $image = sprintf($image_template, $convert_unicode, $simple_unicode);

        $this->assertEquals(Emojione::toImage($shortname), $image);
    }
}
