'use strict';

var functions = require("./functionsAndOptionsToCheck.json");


var emojione = require("../emojione");

var asciiEmojis = Object.keys(emojione.asciiList);
var shortnames = Object.keys(emojione.emojioneList);

for (var short in emojione.emojioneList)
	if (emojione.emojioneList[short].shortnames)
		shortnames = shortnames.concat(emojione.emojioneList[short].shortnames);

emojione.ascii = true;

var bigOne = {};

Object.keys(functions).forEach(function (functionName) {
	bigOne[functionName] = {};
	functions[functionName].forEach(function (options) {
		var optionsName = JSON.stringify(options);
		var smallOne = bigOne[functionName][optionsName] = {};
		asciiEmojis.forEach(function (k) {
			smallOne[k] = emojione[functionName](k);
		});
		shortnames.forEach(function (k) {
			smallOne[k] = emojione[functionName](k);
		});
	});
});

require('fs').writeFileSync("./translations.json",JSON.stringify(bigOne));
