import emojioneList from './emojioneList';
import asciiList from './asciiList';
import jsEscapeMap from './jsEscapeMap';
import jsEscapeMapGreedy from './jsEscapeMapGreedy';
import shortnames from './shortnames';
import asciiRegexp from './asciiRegexp';
import regUnicode from './regUnicode';

var emojiVersion = '3.0'; // you can [optionally] modify this to load alternate emoji versions. see readme for backwards compatibility and version options
var emojiSize = '32';
var spriteSize = '32';
var greedyMatch = false; // set to true for greedy unicode matching
var imagePathPNG = 'https://cdn.jsdelivr.net/emojione/assets/' + emojiVersion + '/png/' + emojiSize + '/';
var imageTitleTag = true; // set to false to remove title attribute from img tag
var sprites = false; // if this is true then sprite markup will be used
var unicodeAlt = true; // use the unicode char as the alt attribute (makes copy and pasting the resulting text better)
var ascii = false; // change to true to convert ascii smileys
var riskyMatchAscii = false; // set true to match ascii without leading/trailing space char

var regShortNames = new RegExp("<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|("+shortnames+")", "gi");
var regAscii = new RegExp("<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|((\\s|^)"+asciiRegexp+"(?=\\s|$|[!,.?]))", "gi");
var regAsciiRisky = new RegExp("<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|(()"+asciiRegexp+"())", "gi");
var memMapShortToUnicode;
var memMapShortToUnicodeCharacters;
var unicodeReplacementRegEx;


function toImage(str) {
    str = unicodeToImage(str);
    str = shortnameToImage(str);
    return str;
}

// Uses toShort to transform all unicode into a standard shortname
// then transforms the shortname into unicode
// This is done for standardization when converting several unicode types
function unifyUnicode(str) {
    str = toShort(str);
    str = shortnameToUnicode(str);
    return str;
}

// Replace shortnames (:wink:) with Ascii equivalents ( ;^) )
// Useful for systems that dont support unicode nor images
function shortnameToAscii(str) {
    var unicode,
        // something to keep in mind here is that array flip will destroy
        // half of the ascii text "emojis" because the unicode numbers are duplicated
        // this is ok for what it's being used for
        unicodeToAscii = objectFlip(asciiList);

    str = str.replace(regShortNames, function(shortname) {
        if( (typeof shortname === 'undefined') || (shortname === '') || (!(shortname in emojioneList)) ) {
            // if the shortname doesnt exist just return the entire match
            return shortname;
        }
        else {
            unicode = emojioneList[shortname].uc_output;
            if(typeof unicodeToAscii[unicode] !== 'undefined') {
                return unicodeToAscii[unicode];
            } else {
                return shortname;
            }
        }
    });
    return str;
}

// will output unicode from shortname
// useful for sending emojis back to mobile devices
function shortnameToUnicode(str) {
    // replace regular shortnames first
    var unicode,fname;
    str = str.replace(regShortNames, function(shortname) {
        if( (typeof shortname === 'undefined') || (shortname === '') || (!(shortname in emojioneList)) ) {
            // if the shortname doesnt exist just return the entire matchhju
            return shortname;
        }
        unicode = emojioneList[shortname].uc_output.toUpperCase();
        fname = emojioneList[shortname].uc_base;
        return convert(unicode);
    });

    // if ascii smileys are turned on, then we'll replace them!
    if (ascii) {
        var asciiRX = riskyMatchAscii ? regAsciiRisky : regAscii;
        str = str.replace(asciiRX, function(entire, m1, m2, m3) {
            if( (typeof m3 === 'undefined') || (m3 === '') || (!(unescapeHTML(m3) in asciiList)) ) {
                // if the ascii doesnt exist just return the entire match
                return entire;
            }

            m3 = unescapeHTML(m3);
            unicode = asciiList[m3].toUpperCase();
            return m2+convert(unicode);
        });
    }

    return str;
}

function shortnameToImage(str) {
    // replace regular shortnames first
    var replaceWith,shortname,unicode,fname,alt,category,title,size;
    var mappedUnicode = mapUnicodeToShort();
    str = str.replace(regShortNames, function(shortname) {
        if( (typeof shortname === 'undefined') || (shortname === '') || (shortnames.indexOf(shortname) === -1) ) {
            // if the shortname doesnt exist just return the entire match
            return shortname;
        }
        else {
            // map shortname to parent
            if (!emojioneList[shortname]) {
                for ( var emoji in emojioneList ) {
                    if (!emojioneList.hasOwnProperty(emoji) || (emoji === '')) continue;
                    if (emojioneList[emoji].shortnames.indexOf(shortname) === -1) continue;
                    shortname = emoji;
                    break;
                }
            }
            unicode = emojioneList[shortname].uc_output;
            fname = emojioneList[shortname].uc_base;
            category = (fname.includes("-1f3f")) ? 'diversity' : emojioneList[shortname].category;
            title = imageTitleTag ? 'title="' + shortname + '"' : '';
            size = (spriteSize == '32' || spriteSize == '64') ? spriteSize : '32';

            // depending on the settings, we'll either add the native unicode as the alt tag, otherwise the shortname
            alt = (unicodeAlt) ? convert(unicode.toUpperCase()) : shortname;

            if(sprites) {
                replaceWith = '<span class="emojione emojione-' + size + '-' + category + ' _' + fname + '" ' + title + '>' + alt + '</span>';
            }
            else {
                replaceWith = '<img class="emojione" alt="' + alt + '" ' + title + ' src="' + imagePathPNG + '' + fname + '.png"/>';
            }

            return replaceWith;
        }
    });

    // if ascii smileys are turned on, then we'll replace them!
    if (ascii) {

        var asciiRX = riskyMatchAscii ? regAsciiRisky : regAscii;

        str = str.replace(regAscii, function(entire, m1, m2, m3) {
            if( (typeof m3 === 'undefined') || (m3 === '') || (!(unescapeHTML(m3) in asciiList)) ) {
                // if the ascii doesnt exist just return the entire match
                return entire;
            }

            m3 = unescapeHTML(m3);
            unicode = asciiList[m3];
            shortname = mappedUnicode[unicode];
            category = (unicode.includes("-1f3f")) ? 'diversity' : emojioneList[shortname].category;
            title = imageTitleTag ? 'title="' + escapeHTML(m3) + '"' : '';
            size = (spriteSize == '32' || spriteSize == '64') ? spriteSize : '32';

            // depending on the settings, we'll either add the native unicode as the alt tag, otherwise the shortname
            alt = (unicodeAlt) ? convert(unicode.toUpperCase()) : escapeHTML(m3);

            if(sprites) {
                replaceWith = m2+'<span class="emojione emojione-' + size + '-' + category + ' _' + unicode +'"  ' + title + '>' + alt + '</span>';
            }
            else {
                replaceWith = m2+'<img class="emojione" alt="'+alt+'" ' + title + ' src="' + imagePathPNG + unicode + '.png"/>';
            }

            return replaceWith;
        });
    }

    return str;
}

function unicodeToImage(str) {

    var replaceWith,unicode,short,fname,alt,category,title,size;
    var mappedUnicode = mapUnicodeToShort();
    var eList = emojioneList;
    str = str.replace(regUnicode, function(unicodeChar) {
        if( (typeof unicodeChar === 'undefined') || (unicodeChar === '') )
        {
            return unicodeChar;
        }
        else if ( unicodeChar in jsEscapeMap )
        {
            fname = jsEscapeMap[unicodeChar];
        }
        else if ( greedyMatch && unicodeChar in jsEscapeMapGreedy )
        {
            fname = jsEscapeMapGreedy[unicodeChar];
        }
        else
        {
            return unicodeChar;
        }

        // then map to shortname and locate the filename
        short = mappedUnicode[fname];

        // then pull the unicode output from emojioneList
        fname = eList[short].uc_base;
        unicode = eList[short].uc_output;
        category = (fname.includes("-1f3f")) ? 'diversity' : eList[short].category;
        size = (spriteSize == '32' || spriteSize == '64') ? spriteSize : '32';

        // depending on the settings, we'll either add the native unicode as the alt tag, otherwise the shortname
        alt = (unicodeAlt) ? convert(unicode.toUpperCase()) : short;
        title = imageTitleTag ? 'title="' + short + '"' : '';

        if(sprites) {
            replaceWith = '<span class="emojione emojione-' + size + '-' + category + ' _' + fname + '" ' + title + '>' + alt + '</span>';
        }
        else {
            replaceWith = '<img class="emojione" alt="' + alt + '" ' + title + ' src="' + imagePathPNG + '' + fname + '.png"/>';
        }

        return replaceWith;
    });

    // if ascii smileys are turned on, then we'll replace them!
    if (ascii) {

        var asciiRX = riskyMatchAscii ? regAsciiRisky : regAscii;

        str = str.replace(asciiRX, function(entire, m1, m2, m3) {
            if( (typeof m3 === 'undefined') || (m3 === '') || (!(unescapeHTML(m3) in asciiList)) ) {
                // if the ascii doesnt exist just return the entire match
                return entire;
            }

            m3 = unescapeHTML(m3);
            unicode = asciiList[m3];
            shortname = mappedUnicode[unicode];
            category = (unicode.includes("-1f3f")) ? 'diversity' : emojioneList[shortname].category;
            title = imageTitleTag ? 'title="' + escapeHTML(m3) + '"' : '';
            size = (spriteSize == '32' || spriteSize == '64') ? spriteSize : '32';

            // depending on the settings, we'll either add the native unicode as the alt tag, otherwise the shortname
            alt = (unicodeAlt) ? convert(unicode.toUpperCase()) : escapeHTML(m3);

            if(sprites) {
                replaceWith = m2+'<span class="emojione emojione-' + size + '-' + category + ' _' + unicode +'"  ' + title + '>' + alt + '</span>';
            }
            else {
                replaceWith = m2+'<img class="emojione" alt="'+alt+'" ' + title + ' src="' + imagePathPNG + unicode + '.png"/>';
            }

            return replaceWith;
        });
    }

    return str;
}

// this is really just unicodeToShortname() but I opted for the shorthand name to match toImage()
function toShort(str) {
    var find = unicodeCharRegex();
    return  replaceAll(str, find);
}

// for converting unicode code points and code pairs to their respective characters
function convert(unicode) {
    var s, hi, lo;
    if(unicode.indexOf("-") > -1) {
        var parts = [];
        s = unicode.split('-');
        for(var i = 0; i < s.length; i++) {
            var part = parseInt(s[i], 16);
            if (part >= 0x10000 && part <= 0x10FFFF) {
                hi = Math.floor((part - 0x10000) / 0x400) + 0xD800;
                lo = ((part - 0x10000) % 0x400) + 0xDC00;
                part = (String.fromCharCode(hi) + String.fromCharCode(lo));
            }
            else {
                part = String.fromCharCode(part);
            }
            parts.push(part);
        }
        return parts.join('');
    }
    else {
        s = parseInt(unicode, 16);
        if (s >= 0x10000 && s <= 0x10FFFF) {
            hi = Math.floor((s - 0x10000) / 0x400) + 0xD800;
            lo = ((s - 0x10000) % 0x400) + 0xDC00;
            return (String.fromCharCode(hi) + String.fromCharCode(lo));
        }
        else {
            return String.fromCharCode(s);
        }
    }
}

function escapeHTML(string) {
    var escaped = {
        '&' : '&amp;',
        '<' : '&lt;',
        '>' : '&gt;',
        '"' : '&quot;',
        '\'': '&#039;'
    };

    return string.replace(/[&<>"']/g, function (match) {
        return escaped[match];
    });
}
function unescapeHTML(string) {
    var unescaped = {
        '&amp;'  : '&',
        '&#38;'  : '&',
        '&#x26;' : '&',
        '&lt;'   : '<',
        '&#60;'  : '<',
        '&#x3C;' : '<',
        '&gt;'   : '>',
        '&#62;'  : '>',
        '&#x3E;' : '>',
        '&quot;' : '"',
        '&#34;'  : '"',
        '&#x22;' : '"',
        '&apos;' : '\'',
        '&#39;'  : '\'',
        '&#x27;' : '\''
    };

    return string.replace(/&(?:amp|#38|#x26|lt|#60|#x3C|gt|#62|#x3E|apos|#39|#x27|quot|#34|#x22);/ig, function (match) {
        return unescaped[match];
    });
}

function shortnameConversionMap() {
    var map = [], emoji;
    for (emoji in emojioneList) {
        if (!emojioneList.hasOwnProperty(emoji) || (emoji === '')) continue;
        map[convert(emojioneList[emoji].uc_output)] = emoji;
    }
    return map;
}

function unicodeCharRegex() {
    var map = [], emoji;
    for (emoji in emojioneList) {
        if (!emojioneList.hasOwnProperty(emoji) || (emoji === '')) continue;
        map.push(convert(emojioneList[emoji].uc_output));
    }
    return map.join('|');
}

function mapEmojioneList (addToMapStorage) {
    for (var shortname in emojioneList) {
        if (!emojioneList.hasOwnProperty(shortname)) { continue; }
        var unicode = emojioneList[shortname].uc_base;
        addToMapStorage(unicode, shortname);
    }
}

function mapUnicodeToShort() {
    if (!memMapShortToUnicode) {
        memMapShortToUnicode = {};
        mapEmojioneList(function (unicode, shortname) {
            memMapShortToUnicode[unicode] = shortname;
        });
    }
    return memMapShortToUnicode;
}

function memorizeReplacement() {
    if (!unicodeReplacementRegEx || !memMapShortToUnicodeCharacters) {
        var unicodeList = [];
        memMapShortToUnicodeCharacters = {};
        mapEmojioneList(function (unicode, shortname) {
            var emojiCharacter = convert(unicode);
            memMapShortToUnicodeCharacters[emojiCharacter] = shortname;
            unicodeList.push(emojiCharacter);
        });
        unicodeReplacementRegEx = unicodeList.join('|');
    }
}

function mapUnicodeCharactersToShort() {
    memorizeReplacement();
    return memMapShortToUnicodeCharacters;
}

//reverse an object
function objectFlip (obj) {
    var key, tmp_obj = {};

    for (key in obj) {
        if (obj.hasOwnProperty(key)) {
            tmp_obj[obj[key]] = key;
        }
    }

    return tmp_obj;
}

function escapeRegExp(string) {
    return string.replace(/[-[\]{}()*+?.,;:&\\^$#\s]/g, "\\$&");
}

function replaceAll(string, find) {
    var escapedFind = escapeRegExp(find); //sorted largest output to smallest output
    var search = new RegExp("<object[^>]*>.*?<\/object>|<span[^>]*>.*?<\/span>|<(?:object|embed|svg|img|div|span|p|a)[^>]*>|("+escapedFind+")", "gi");

    // callback prevents replacing anything inside of these common html tags as well as between an <object></object> tag

    var replace = function(entire, m1) {
        return ((typeof m1 === 'undefined') || (m1 === '')) ? entire : shortnameConversionMap()[m1];
    };

    return string.replace(search,replace);
}

export {
    ascii,
    asciiList,
    asciiRegexp,
    convert,
    emojiSize,
    emojiVersion,
    emojioneList,
    escapeHTML,
    escapeRegExp,
    greedyMatch,
    imagePathPNG,
    imageTitleTag,
    jsEscapeMap,
    jsEscapeMapGreedy,
    mapEmojioneList,
    mapUnicodeCharactersToShort,
    mapUnicodeToShort,
    memMapShortToUnicode,
    memMapShortToUnicodeCharacters,
    memorizeReplacement,
    objectFlip,
    regAscii,
    regShortNames,
    regUnicode,
    replaceAll,
    riskyMatchAscii,
    shortnameConversionMap,
    shortnameToAscii,
    shortnameToImage,
    shortnameToUnicode,
    shortnames,
    sprites,
    toImage,
    toShort,
    unescapeHTML,
    unicodeAlt,
    unicodeCharRegex,
    unicodeReplacementRegEx,
    unicodeToImage,
    unifyUnicode
};