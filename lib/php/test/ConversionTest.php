<?php

namespace Emojione\Test;

use Emojione\Emojione;

class ConversionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * test single unicode character
     *
     * @return void
     */
    public function testSingleUnicodeCharacter()
    {
        $unicode   = '🐌';
        $shortname = ':snail:';
        $image     = '<img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), '<img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>');
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), '<img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>');
    }

    /**
     * test single ascii character
        *
     * @return void
     */
    public function testSingleSmiley()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii     = ':-)';
        $unicode   = '😄';
        $shortname = ':smile:';
        $image     = '<img class="emojione" alt="&#x1f604;" src="//cdn.jsdelivr.net/emojione/assets/png/1F604.png?v=1.2.4"/>';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), ':]');
        $this->assertEquals(Emojione::unifyUnicode($ascii), '&#x1f604;');
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }
}
