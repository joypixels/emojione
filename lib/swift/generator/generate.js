var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji_strategy.json");

// Generate Objective-C mapping
var mapping = _(emojis).map(function(data, unicode) {
    // Get chars
    var chars = _(unicode.split("-")).map(function (code) {
        // Handle invalid unicode char for C99
        // http://c0x.coding-guidelines.com/6.4.3.html
        if (code < 160) {
            return String.fromCharCode(parseInt(code, 16));
        }

        return "\\u{" + Array(8 - code.length + 1).join("0") + code + "}";
    });

    return '"' + data.shortname.slice(1, -1) + '": "' + chars.join('') + '",';
}).join("\n        ");

// Generate Objective-C class from template
var input  = fs.readFileSync("./Emojione.swift");
var output = _(input.toString()).template()({ mapping: mapping });

// Write Objective-C class to file
var output_path = "../src/Emojione.swift";
fs.writeFileSync(output_path, output);

console.log("Generated " + output_path);