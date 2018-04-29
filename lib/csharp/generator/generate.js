var util = require("util"),
    fs   = require("fs"),
    _    = require("underscore");


// Load emojis
var emojis = require("../../../emoji_strategy.json");

// helper function for unicode parsing.
// c# only has 16 bit unicode literals so we need to have some magic.

function csharp(unicode) {
    output = "\\u";
    tmp = "";
    map = "0123456789abcdef".split('');


    for(i = 0; i < unicode.length; i++)
    {
        if(tmp.length != 0 && tmp.length % 4 == 0 ) {
            output += tmp + "\\u";
            tmp = "";
        }
        if(map.indexOf(unicode[i].toLowerCase()) == -1)
        {
            if(unicode[i] != "-")
                console.log("don't know how to convert " + unicode);

            if (tmp.length > 0) {
                while(tmp.length < 4)
                {
                    tmp = "0" + tmp;
                }

                output += tmp + "\\u";
                tmp = "";
            }
        } else {
            tmp += unicode[i];
        }

    }
    while(tmp.length < 4)
        tmp = "0"+tmp;

    output += tmp;


    if(output.substr(output.length - 2, output.length) == "\\u")
        output = output.substr(0, output.length - 2);
    return output;
}


// Generate C# mapping
var uni_shortname_mapping = _(emojis).map(function(data, unicode) {
    // Get chars
    return '{"' + data.shortname + '", "' + csharp(data.unicode_output) + '"},';
}).join("\n        ");

var shortname_uni_mapping = _(emojis).map(function(data, unicode) {
    // Get chars
    return '{"' + csharp(data.unicode_output) + '", "' + data.shortname + '"},';
}).join("\n        ");
// Generate C# class from template

var input  = fs.readFileSync("./Emojione.cs");
var output = _(input.toString()).template()({ mapping: uni_shortname_mapping, shortname_uni : shortname_uni_mapping });

// Write C# class to file
var output_path = "../src/Emojione.cs";
fs.writeFileSync(output_path, output);

console.log("Generated " + output_path);
