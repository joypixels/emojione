var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji_strategy.json");

// Generate Java mapping
var mapping = _(emojis).map(function(data, shortname) {
    // Get codepoints
    var codepoints = _(data.unicode.split("-")).map(function (code) {
        return "0x" + code;
    });

    return '_shortNameToUnicode.put("' + shortname + '", new String(new int[] {' + codepoints.join(',') + '}, 0, ' + codepoints.length + '));';
}).join("\n        ");

// Generate Java class from template
var input  = fs.readFileSync("./Emojione.java");
var output = _(input.toString()).template()({ mapping: mapping });

// Write Java class to file
var output_path = "../com/emojione/Emojione.java";
fs.writeFileSync(output_path, output);

console.log("Generated " + output_path);