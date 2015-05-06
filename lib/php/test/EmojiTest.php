<?php

namespace Emojione\Test;

use Emojione\Emojione;

class EmojiTest extends \PHPUnit_Framework_TestCase
{
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
     * test Emojione::toImage()
     *
     * @dataProvider emojiProvider
     *
     * @return void
     */
    public function testEmojis($shortname, $simple_unicode)
    {
        $unicode = Emojione::shortnameToUnicode($shortname);

        $this->assertNotTrue($unicode === $shortname);

        $convert_unicode = Emojione::convert($simple_unicode);

        $this->assertTrue(isset(Emojione::$shortcode_replace[$shortname]));
        $this->assertEquals(strtoupper(Emojione::$shortcode_replace[$shortname]), $simple_unicode);
        $this->assertTrue(isset(Emojione::$unicode_replace[$unicode]));
        $this->assertEquals(Emojione::$unicode_replace[$unicode], $shortname);
    }
}
