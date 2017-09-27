# TESTS
This folder contains tests for the js lib.
## HTML tests
### How to run
Run the `generate.js` script and open the `tests.html` in a browser.
### How to contribute
Add your tests in `validate.json`.
## Backwards Tests
This tests will allow you to compare 2 different versions.
### How to run
* Generate the `translations.json` file using the `generateCurrentTranslations.js` script.
* Checkout a different version.
* Run `mocha -u tdd backwardsTest.js` to compare the 2 versions
### How to test different options/functions
Simply add the required functions and options in the `functionsAndOptionsToCheck.json` and regenerate the `translations.json`
