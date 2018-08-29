# Upgrading from emojione v2 to emojione v3+

*  emojione v3 brought about several breaking changes and new considerations
*  please review EmojiOne Licensing for more information on using SVG or PNG (larger than 128px) assets

## Libraries
**JS**
 - Deprecated vars: 
 	- [emojione.js] imagePathSVG, imagePathSVGSprites, imageType (now defaulted to png)
 - Tests also updated (added explicit protocol for cdn, included previously-added title attribute to img tag)
  - Added vars: 
  	- emojiVersion (str)
	- emojiSize (str)
  	- greedyMatch (bool)
  	- blacklistChars (bool)
	- spriteSize (str)
	- riskyMatchAscii (bool)
	- fileExtension (str)

**PHP**
 - Deprecated vars: 
	- [src/Client.php] imagePathSVG, imagePathSVGSprites
	- [src/Emojione.php] imagePathSVG, imagePathSVGSprites, imageType
 - Added vars:
 	- emojiVersion (str)
	- emojiSize (str)
	- greedyMatch (bool)
	- blacklistChars (str)
	- spriteSize (str)
	- riskyMatchAscii (bool)
	- fileExtension (str)
 - Tests
	- [tests/ConversionTest.php] removed testSmileyInsideAnObject()
	- [tests/ConversionTest.php] removed testShortnameInsideOfObjectTag()

## Demos
Replaced by ‘examples’. Contains code snippets of each of the functions previously demonstrated. Updated demos can be found at <a href="https://demos.emojione.com/latest"></a>.

## JSON Files
**EMOJI.JSON (updated)** 
 - primary key is now *base code point* rather than shortname
	- base code point is the full unicode code point minus VS16 and ZWJ
	- base code point is used as an identifier for emoji file names (PNG) as well as within sprites (CSS)
 - **name** (str)
 - **unicode_version** (num) - floating-point number indicating initial Unicode release
 - **category** (str) - key for `category` property in `emoji_categories.json`
 - **emoji_order** (num) is now simply **order** (num)
 - **display** (num) determines whether an emoji should be shown on a keyboard
 - **shortname** (str) colon-encapsulated, snake_case representation of the emoji name
 - **aliases** (array) is now **shortname_alternates** (array) alternative (including previously-used) shortnames
 - **aliases_ascii** (array) is now **ascii** (array)
 - **diversity** (str) is either `null` or the base code point of the corresponding Fitzpatrick Emoji Modifier
 - **diversities** (array) contains the base code points of the diversity children for a diversity parent (non-diverse, diversity base)
 - **gender** (str) is either `null` or the base code point of the corresponding male/female emoji symbol
 - **genders** (array) contains the base code points of the gender children for a gender parent (gender-neutral, gender base)
 - **unicode** (str) and **unicode_alt** (str) are depricated. code points are now organized within **code_points** (array)
 	- **base** (str) is identical to the primary key
 	- **fully_qualified** (str) represents code point according to [this Unicode documentation](http://unicode.org/Public/emoji/11.0/emoji-test.txt)
 	- **non_fully_qualified** (str) derived from same documentation as FQ. NFQ code point convention is used for PNG file names in font file builds
	- **output** (str) is the recommended code point to use for conversion to native unicode
	- **match_default** (array) contains one or more code points used to identify native unicode
	- **match_greedy** (array) contains one or more code points used to identify potential native unicode variants
		- note: the match_greedy code point(s) may replace non-emoji variants producing undesired results
	- **decimal** (str) replaces **code_decimal** (str)
 - **keywords** (array)

**EMOJI_STRATEGY.JSON (updated)**
 - primary key is now *base code point* rather than short name
 - **aliases** (str) is now **shortname_alternates** (array)
 - **keywords** (str) is now **keywords** (array)
 - **unicode** (str) is now **unicode_output** (str)

**EMOJI_CATEGORIES.JSON (new)**
 - **order** (str)
 - **category** (str)
 - **category_label** (str)

## Shortname Changes
Along with the many changes to emojione version 3.0 comes a number of shortname updates. **Any shortnames that change will still appear as an alternate shortname (or alias) in the data files.** You can view the complete list of primary shortname changes in the [extras/alpha-codes readme](extras/alpha-codes/).
