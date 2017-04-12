var fs = require('fs');

// Load emojis
var emojis = JSON.parse(fs.readFileSync('../../emoji_strategy.json'), 'utf8');

// Generate .scss mapping
var mapping = '';

for (var key in emojis) {
    if (emojis.hasOwnProperty(key))
        mapping += '"' + key + '": "' + emojis[key].shortname.slice(1, -1) + "\",\n";
}

mapping = "$emoji-map: (\n" + mapping;
mapping = mapping.substr(0, mapping.length - 2) + "\n);";

// Write .scss file
var output_path = '../../lib/emojione-awesome/_emojione-awesome.map.scss';
fs.writeFileSync(output_path, mapping);

console.log('Generated ' + output_path);