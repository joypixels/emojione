var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji_strategy.json");

// Generate Java mapping
var mapping = _(emojis).map(function(data, shortname) {
    return '_shortNameToUnicode.put("' + shortname + '", new String(Character.toChars(0x' + data.unicode + ')));';
}).join("\n        ");

// Generate Java class from template
var input  = fs.readFileSync("./Emojione.java");
var output = _(input.toString()).template()({ mapping: mapping });

// fs.writeFileSync("../com/emojione/Emojione.java", output);

util.log(output);
