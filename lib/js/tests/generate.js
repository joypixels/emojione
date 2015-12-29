// These tests are meant to develop over time.
// New tests can be added to validate.json
// Regenerate the tests.html file with the following command 'node generate.js'
// underscore.js is required. It can be installed with 'npm install underscore'

var fs = require('fs');
var  _ = require('underscore');

// load emojis
var emojis = JSON.parse(fs.readFileSync('validate.json'), 'utf8');

// load template
var data = fs.readFileSync('template.html');

data = data.toString();

var template = _.template(data);

var testFile = template(emojis);

// write test file
var output_path = 'tests.html';
fs.writeFileSync(output_path, testFile);

console.log('Generated ' + output_path);