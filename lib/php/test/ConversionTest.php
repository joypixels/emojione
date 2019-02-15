<?php

/*
Tests based on lib/tests.md
*/

namespace Emojione\Test;

use Emojione\Emojione;

class ConversionTest extends \PHPUnit_Framework_TestCase
{

    private $emojiVersion = '4.5';

    /**
     * test single unicode character
     *
     * @return void
     */
    public function testSingleUnicodeCharacter()
    {
        $unicode   = '🐌';
        $shortname = ':snail:';
        $image     = '<img class="emojione" alt="🐌" title=":snail:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>';
        $image_fix = '<img class="emojione" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>';

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
        $unicode   = 'The 🦄 is EmojiOne\'s official mascot.';
        $shortname = 'The :unicorn: is EmojiOne\'s official mascot.';
        $image     = 'The <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/> is EmojiOne\'s official mascot.';
        $image_fix = 'The <img class="emojione" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/> is EmojiOne\'s official mascot.';

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
        $unicode   = 'The 🦄, is EmojiOne\'s official mascot.';
        $shortname = 'The :unicorn:, is EmojiOne\'s official mascot.';
        $image     = 'The <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>, is EmojiOne\'s official mascot.';
        $image_fix = 'The <img class="emojione" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>, is EmojiOne\'s official mascot.';

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
        $image     = '<img class="emojione" alt="🐌" title=":snail:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/> mail.';
        $image_fix = '<img class="emojione" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/> mail.';

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
        $image     = '<img class="emojione" alt="🐌" title=":snail:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>\'s are cool!';
        $image_fix = '<img class="emojione" alt="&#x1f40c;" title=":snail:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f40c.png"/>\'s are cool!';

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
        $unicode   = 'EmojiOne\'s official mascot is 🦄.';
        $shortname = 'EmojiOne\'s official mascot is :unicorn:.';
        $image     = 'EmojiOne\'s official mascot is <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>.';
        $image_fix = 'EmojiOne\'s official mascot is <img class="emojione" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>.';

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
        $unicode   = 'EmojiOne\'s official mascot is 🦄!';
        $shortname = 'EmojiOne\'s official mascot is :unicorn:!';
        $image     = 'EmojiOne\'s official mascot is <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>!';
        $image_fix = 'EmojiOne\'s official mascot is <img class="emojione" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>!';

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
        $unicode   = 'EmojiOne\'s official mascot: 🦄';
        $shortname = 'EmojiOne\'s official mascot: :unicorn:';
        $image     = 'EmojiOne\'s official mascot: <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>';
        $image_fix = 'EmojiOne\'s official mascot: <img class="emojione" alt="&#x1f984;" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png"/>';

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
        $unicode   = 'The <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png" /> is EmojiOne\'s official mascot.';
        $shortname = 'The <img class="emojione" alt=":unicorn:" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f984.png" /> is EmojiOne\'s official mascot.';

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

        $ascii       = ':-)';
        $unicode     = '🙂';
        $unicode_fix = '&#x1f642;';
        $shortname   = ':slight_smile:';
        $image       = '<img class="emojione" alt="&#x1f642;" title=":slight_smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f642.png"/>';

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

    /**
     * test single smiley with incorrect case (shouldn't convert)
     *
     * @return void
     */
    public function testSingleSmileyWithIncorrectCase()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii = ':d';

        $this->assertEquals(Emojione::shortnameToImage($ascii), $ascii);
        $this->assertEquals(Emojione::toImage($ascii), $ascii);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $ascii);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test multiple smileys
     *
     * @return void
     */
    public function testMultipleSmilies()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii       = ';) :p :*';
        $ascii_fix   = ';^) d: :^*';
        $unicode     = '😉 😛 😘';
        $unicode_fix = '&#x1f609; &#x1f61b; &#x1f618;';
        $shortname   = ':wink: :stuck_out_tongue: :kissing_heart:';
        $image       = '<img class="emojione" alt="&#x1f609;" title=":wink:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f609.png"/> <img class="emojione" alt="&#x1f61b;" title=":stuck_out_tongue:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f61b.png"/> <img class="emojione" alt="&#x1f618;" title=":kissing_heart:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f618.png"/>';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test smiley to start a sentence
     *
     * @return void
     */
    public function testSmileyAtSentenceStart()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii       = ':\\ is our confused smiley.';
        $ascii_fix   = '=L is our confused smiley.';
        $unicode     = '😕 is our confused smiley.';
        $unicode_fix = '&#x1f615; is our confused smiley.';
        $shortname   = ':confused: is our confused smiley.';
        $image       = '<img class="emojione" alt="&#x1f615;" title=":confused:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f615.png"/> is our confused smiley.';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test smiley to end a sentence
     *
     * @return void
     */
    public function testSmileyAtSentenceEnd()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii       = 'Our smiley to represent joy is :\')';
        $ascii_fix   = 'Our smiley to represent joy is :\'-)';
        $unicode     = 'Our smiley to represent joy is 😂';
        $unicode_fix = 'Our smiley to represent joy is &#x1f602;';
        $shortname   = 'Our smiley to represent joy is :joy:';
        $image       = 'Our smiley to represent joy is <img class="emojione" alt="&#x1f602;" title=":joy:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f602.png"/>';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test smiley to end a sentence with puncuation
     *
     * @return void
     */
    public function testSmileyAtSentenceEndWithPunctuation()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii       = 'The reverse is the joy smiley is the cry smiley :\'(.';
        $ascii_fix   = 'The reverse is the joy smiley is the cry smiley ;-(.';
        $unicode     = 'The reverse is the joy smiley is the cry smiley 😢.';
        $unicode_fix = 'The reverse is the joy smiley is the cry smiley &#x1f622;.';
        $shortname   = 'The reverse is the joy smiley is the cry smiley :cry:.';
        $image       = 'The reverse is the joy smiley is the cry smiley <img class="emojione" alt="&#x1f622;" title=":cry:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f622.png"/>.';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test smiley to end a sentence with preceeding puncuration
     *
     * @return void
     */
    public function testSmileyAtSentenceEndWithPreceedingPunctuation()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii       = 'This is the "flushed" smiley: :$.';
        $ascii_fix   = 'This is the "flushed" smiley: =$.';
        $unicode     = 'This is the "flushed" smiley: 😳.';
        $unicode_fix = 'This is the "flushed" smiley: &#x1f633;.';
        $shortname   = 'This is the "flushed" smiley: :flushed:.';
        $image       = 'This is the "flushed" smiley: <img class="emojione" alt="&#x1f633;" title=":flushed:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f633.png"/>.';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test smiley inside of an IMG tag  (shouldn't convert anything inside of the tag)
     *
     * @return void
     */
    public function testSmileyInsideAnImgTag()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $image = 'Smile <img class="emojione" alt=":)" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f642.png" /> because it\'s going to be a good day.';

        $this->assertEquals(Emojione::shortnameToImage($image), $image);
        $this->assertEquals(Emojione::toImage($image), $image);
        $this->assertEquals(Emojione::shortnameToAscii($image), $image);
        $this->assertEquals(Emojione::unifyUnicode($image), $image);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test typical username password fail  (shouldn't convert the user:pass, but should convert the last :p)
     *
     * @return void
     */
    public function testTypicalUsernamePasswordFail()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii       = 'Please log-in with user:pass as your credentials :P.';
        $ascii_fix   = 'Please log-in with user:pass as your credentials d:.';
        $unicode     = 'Please log-in with user:pass as your credentials 😛.';
        $unicode_fix = 'Please log-in with user:pass as your credentials &#x1f61b;.';
        $shortname   = 'Please log-in with user:pass as your credentials :stuck_out_tongue:.';
        $image       = 'Please log-in with user:pass as your credentials <img class="emojione" alt="&#x1f61b;" title=":stuck_out_tongue:" src="https://cdn.jsdelivr.net/emojione/assets/' . $this->emojiVersion . '/png/32/1f61b.png"/>.';

        $this->assertEquals(Emojione::shortnameToImage($shortname), $image);
        $this->assertEquals(Emojione::shortnameToImage($ascii), $image);
        $this->assertEquals(Emojione::toImage($shortname), $image);
        $this->assertEquals(Emojione::toImage($ascii), $image);
        $this->assertEquals(Emojione::shortnameToAscii($shortname), $ascii_fix);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $unicode_fix);
        $this->assertEquals(Emojione::unifyUnicode($shortname), $unicode);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }

    /**
     * test shouldn't replace an ascii smiley in a URL (shouldn't replace :/)
     *
     * @return void
     */
    public function testSmileyInAnUrl()
    {
        // enable ASCII conversion
        $default_ascii = Emojione::$ascii;
        Emojione::$ascii = true;

        $ascii = 'Check out http://www.emojione.com';

        $this->assertEquals(Emojione::shortnameToImage($ascii), $ascii);
        $this->assertEquals(Emojione::toImage($ascii), $ascii);
        $this->assertEquals(Emojione::shortnameToAscii($ascii), $ascii);
        $this->assertEquals(Emojione::unifyUnicode($ascii), $ascii);

        // back to default ASCII conversion
        Emojione::$ascii = $default_ascii;
    }
}
