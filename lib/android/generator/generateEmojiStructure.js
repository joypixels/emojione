var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji.json");

// Generate Java mapping
var mapping = _(emojis).map(function(data, shortname) {
	var category = _(data.category);
	var unicode = _(data.unicode);
    // Get codepoints
    var codepoints = _(data.unicode.split("-")).map(function (code) {
        return "0x" + code;
    });

    return '_shortNameToEmoji.put("' + shortname + '", new Emoji("' + shortname + '",new String(new int[] {' + codepoints.join(',') + '}, 0, ' + codepoints.length + '), new String("' + unicode + '"),"' + category + '"));';
}).join("\n        ");

// Generate Java class from template
var input  = fs.readFileSync("./Emoji.java");
var output = _(input.toString()).template()({ mapping: mapping });

// Write Java class to file
var output_path = "../com/emojione/Emoji.java";
fs.writeFileSync(output_path, output);

console.log("Generated " + output_path);