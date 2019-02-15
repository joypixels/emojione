<?php

namespace Emojione\Test;

use Emojione\Emojione;

class EmojioneTest extends \PHPUnit_Framework_TestCase
{

    private $emojiVersion = '4.5';

    public function emojiProvider()
    {
        $file = dirname (__FILE__).'/../../../emoji.json';

        $string = file_get_contents($file);

        $json = json_decode($string, true);

        $data = array();

        foreach($json as $emoji)
        {
            if(isset($emoji['aliases_ascii']) && is_array($emoji['aliases_ascii'])){
                foreach($emoji['aliases_ascii'] as $ascii)
                $data[] = array(
                    $ascii,
                    $emoji['shortname']
                );
            }
        }
        return $data;
    }

    /**
     * test Emojione::toImage()
     *
     * @return void
     */
    public function testToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="emojione" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/> <img class="emojione" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/>';

        $this->assertEquals(Emojione::toImage($test), $expected);
    }

    /**
     * test Emojione::unifyUnicode()
     *
     * @return void
     */
    public function testUnifyUnicode()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals(Emojione::unifyUnicode($test), $expected);
    }

    /**
     * test Emojione::shortnameToUnicode()
     *
     * @return void
     */
    public function testShortnameToUnicode()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 😄';

        $this->assertEquals(Emojione::shortnameToUnicode($test), $expected);
    }


    /**
     * test Emojione::shortnameToAscii()
     *
     * @return void
     */
    public function testShortnameToAscii()
    {
        $test     = 'Hello world! 🙂 :slight_smile:';
        $expected = 'Hello world! 🙂 :]';

        $this->assertEquals(Emojione::shortnameToAscii($test), $expected);
    }

    /**
     * test Emojione::shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <img class="emojione" alt="&#x1f604;" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/>';

        $this->assertEquals(Emojione::shortnameToImage($test), $expected);
    }

    /**
     * test Emojione::toShort()
     *
     * @return void
     */
    public function testToShort()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! :smile: :smile:';

        $this->assertEquals(Emojione::toShort($test), $expected);
    }
    /**
     *
     * test Emojione::asciiToShortname()
     *
     * @return void
     */
    public function testAsciiToShortname()
    {
        $test     = 'Hello world! :) :D ;) :smile:';
        $expected = 'Hello world! :slight_smile: :smiley: :wink: :smile:';

        $this->assertEquals(Emojione::asciiToShortname($test), $expected);
    }

    /**
     * Test Ascii to shortnames with dataProvider
     *
     * @dataProvider emojiProvider
     */
    public function testAsciiToShortnameWithDataProvider($ascii, $shortname)
    {
        $this->assertEquals($shortname, Emojione::asciiToShortname($ascii));
    }

    /**
     * test Emojione::unicodeToImage()
     *
     * @return void
     */
    public function testUnicodeToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <img class="emojione" alt="😄" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f604.png"/> :smile:';

        $this->assertEquals(Emojione::unicodeToImage($test), $expected);
    }
}
