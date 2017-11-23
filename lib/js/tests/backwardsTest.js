'use strict';

var emojione = require("../emojione");
var assert = require("assert");

var asciiEmojis = Object.keys(emojione.asciiList);
var shortnames = Object.keys(emojione.emojioneList);

for (var short in emojione.emojioneList)
	if (emojione.emojioneList[short].shortnames)
		shortnames = shortnames.concat(emojione.emojioneList[short].shortnames);

try {
	var translations = require("./translations.json");
} catch (e) {
	throw new Error("No translation.json found. Use generateCurrentTranslations.js to generate it for this version.");
}


var functions = require("./functionsAndOptionsToCheck.json");

Object.keys(functions).forEach(function (functionName) {
	suite(functionName,function () {
		functions[functionName].forEach(function (options) {
			var optionsName = JSON.stringify(options);
			suite(optionsName, function () {
				var oldOptions = {};
				for (var k in options)
					oldOptions[k] = emojione[k];
				suiteSetup(function () {
					for (var k in options)
						emojione[k] = options[k];
				});
				suiteTeardown(function () {
					for (var k in options)
						emojione[k] = oldOptions[k];
				});
				suite("ascii", function () {
					asciiEmojis.forEach(function (k) {
						test(k, function () {
							assert.equal(emojione.toImage(k), translations[functionName][optionsName][k]);
						});
					});
				});
				suite("shortnames", function () {
					shortnames.forEach(function (k) {
						test(k, function () {
							assert.equal(emojione.toImage(k), translations[functionName][optionsName][k]);
						});
					});
				});
			});
		});
	});
});
