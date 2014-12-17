var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji_strategy.json");

// Generate Objective-C mapping
var mapping = _(emojis).map(function(data, shortname) {
    // Get chars
    var chars = _(data.unicode.split("-")).map(function (code) {
        return "\\U" + Array(8 - code.length + 1).join("0") + code;
    });

    return '@"' + shortname + '" : @"' + chars.join('') + '",';
}).join("\n        ");

// Generate Objective-C class from template
var input  = fs.readFileSync("./Emojione.m");
var output = _(input.toString()).template()({ mapping: mapping });

// Write Objective-C class to file
var output_path = "../src/Emojione.m";
fs.writeFileSync(output_path, output);

console.log("Generated " + output_path);