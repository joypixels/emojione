<?php

namespace Emojione\Test;

use Emojione\Emojione;

class SpriteTest extends \PHPUnit_Framework_TestCase
{

    /**
     * prepare SpriteTest
     */
    protected function setUp()
    {
        Emojione::$sprites = true;
        Emojione::$imageType = 'png';
        Emojione::$unicodeAlt = true;
    }

    /**
     * test Emojione::toImage()
     *
     * @return void
     */
    public function testToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <span class="emojione-1F604" title=":smile:">😄</span> <span class="emojione-1F604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals(Emojione::toImage($test), $expected);
    }

    /**
     * test Emojione::shortnameToImage()
     *
     * @return void
     */
    public function testShortnameToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! 😄 <span class="emojione-1F604" title=":smile:">&#x1f604;</span>';

        $this->assertEquals(Emojione::shortnameToImage($test), $expected);
    }

    /**
     * test Emojione::unicodeToImage()
     *
     * @return void
     */
    public function testUnicodeToImage()
    {
        $test     = 'Hello world! 😄 :smile:';
        $expected = 'Hello world! <span class="emojione-1F604" title=":smile:">😄</span> :smile:';

        $this->assertEquals(Emojione::unicodeToImage($test), $expected);
    }
}
