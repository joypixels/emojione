var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji_strategy.json");

// Generate C# mapping
var mapping = _(emojis).map(function(data, shortname) {
    // Get chars
    return '{"' + shortname + '", "' + data.unicode + '"},';
}).join("\n        ");

// Generate C# class from template
var input  = fs.readFileSync("./Emojione.cs");
var output = _(input.toString()).template()({ mapping: mapping });

// Write C# class to file
var output_path = "../src/Emojione.cs";
fs.writeFileSync(output_path, output);

console.log("Generated " + output_path);