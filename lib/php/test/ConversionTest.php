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
        $image_fix = '<img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname mid sentence
     *
     * @return void
     */
    public function testShortnameInsideSentence()
    {
        $unicode   = 'The 🐌 is Emoji One\'s official mascot.';
        $shortname = 'The :snail: is Emoji One\'s official mascot.';
        $image     = 'The <img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/> is Emoji One\'s official mascot.';
        $image_fix = 'The <img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/> is Emoji One\'s official mascot.';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname mid sentence with a comma
     *
     * @return void
     */
    public function testShortnameInsideSentenceWithComma()
    {
        $unicode   = 'The 🐌, is Emoji One\'s official mascot.';
        $shortname = 'The :snail:, is Emoji One\'s official mascot.';
        $image     = 'The <img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>, is Emoji One\'s official mascot.';
        $image_fix = 'The <img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>, is Emoji One\'s official mascot.';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at start of sentence
     *
     * @return void
     */
    public function testShortnameAtStartOfSentence()
    {
        $unicode   = '🐌 mail.';
        $shortname = ':snail: mail.';
        $image     = '<img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/> mail.';
        $image_fix = '<img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/> mail.';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at start of sentence with apostrophe
     *
     * @return void
     */
    public function testShortnameAtStartOfSentenceWithApostrophe()
    {
        $unicode   = '🐌\'s are cool!';
        $shortname = ':snail:\'s are cool!';
        $image     = '<img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>\'s are cool!';
        $image_fix = '<img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>\'s are cool!';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at end of sentence
     *
     * @return void
     */
    public function testShortnameAtEndOfSentence()
    {
        $unicode   = 'Emoji One\'s official mascot is 🐌.';
        $shortname = 'Emoji One\'s official mascot is :snail:.';
        $image     = 'Emoji One\'s official mascot is <img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>.';
        $image_fix = 'Emoji One\'s official mascot is <img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>.';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at end of sentence with alternate punctuation
     *
     * @return void
     */
    public function testShortnameAtEndOfSentenceWithAlternatePunctuation()
    {
        $unicode   = 'Emoji One\'s official mascot is 🐌!';
        $shortname = 'Emoji One\'s official mascot is :snail:!';
        $image     = 'Emoji One\'s official mascot is <img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>!';
        $image_fix = 'Emoji One\'s official mascot is <img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>!';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * test shortname at end of sentence with preceeding colon
     *
     * @return void
     */
    public function testShortnameAtEndOfSentenceWithPreceedingColon()
    {
        $unicode   = 'Emoji One\'s official mascot: 🐌';
        $shortname = 'Emoji One\'s official mascot: :snail:';
        $image     = 'Emoji One\'s official mascot: <img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>';
        $image_fix = 'Emoji One\'s official mascot: <img class="emojione" alt="&#x1f40c;" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png?v=1.2.4"/>';

        $this->assertEquals(Emojione::toShort($unicode), $shortname);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $image_fix);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $unicode);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($unicode), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image_fix);
    }

    /**
     * shortname inside of IMG tag
     *
     * @return void
     */
    public function testShortnameInsideOfImgTag()
    {
        $unicode   = 'The <img class="emojione" alt="🐌" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png" /> is Emoji One\'s official mascot.';
        $shortname = 'The <img class="emojione" alt=":snail:" src="//cdn.jsdelivr.net/emojione/assets/png/1F40C.png" /> is Emoji One\'s official mascot.';

        $this->assertEquals(Emojione::toShort($unicode), $unicode);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $shortname);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $shortname);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $unicode);
        $this->assertEquals(Emojione::toImage($unicode), $unicode);
        $this->assertEquals(Emojione::toImage($shortname), $shortname);
    }

    /**
     * # characters inside of OBJECT tag
The <object class="emojione" data="//cdn.jsdelivr.net/emojione/assets/svg/1F40C.svg" type="image/svg+xml" standby="🐌">🐌</object> is Emoji One's official mascot.
     *
     * @return void
     */
    public function testShortnameInsideOfObjectTag()
    {
        $unicode   = 'The <object class="emojione" data="//cdn.jsdelivr.net/emojione/assets/svg/1F40C.svg" type="image/svg+xml" standby="🐌">🐌</object> is Emoji One\'s official mascot';
        $shortname = 'The <object class="emojione" data="//cdn.jsdelivr.net/emojione/assets/svg/1F40C.svg" type="image/svg+xml" standby=":snail:">:snail:</object> is Emoji One\'s official mascot';

        $this->assertEquals(Emojione::toShort($unicode), $unicode);
        $this->assertEquals(Emojione::shortnameToImage($shortname), $shortname);
        $this->assertEquals(Emojione::shortnameToUnicode($shortname), $shortname);
        $this->assertEquals(Emojione::unicodeToImage($unicode), $unicode);
        $this->assertEquals(Emojione::toImage($unicode), $unicode);
        $this->assertEquals(Emojione::toImage($shortname), $shortname);
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
        $unicode_fix = '&#x1f604;';
        $shortname = ':smile:';
        $image     = '<img class="emojione" alt="&#x1f604;" src="//cdn.jsdelivr.net/emojione/assets/png/1F604.png?v=1.2.4"/>';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), ':]');
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }
}
