# EmojiOne

## **Javascript Implementation Examples**

The following Javascript code snippets demonstrate common usages of EmojiOne within your project.

----------

## .shortnameToImage(str)
*Convert Shortnames to Images*

If you've chosen to unify your inputted text so that it contains only shortnames then this is the function (or its matching PHP function) you will want to use to convert the shortnames images when displaying it to the client.

**HTML:**
`<input type="button" value="Convert" onclick="convert()"/>`

**Javascript Snippet**
```javascript
function convert() {
	var input = document.getElementById('inputText').value;
	var output = emojione.shortnameToImage(input);
	document.getElementById('outputText').innerHTML = output;
}
```

----------

## .toImage(str)
*Convert Native Unicode Emoji and Shortnames Directly to Images*

This function is simply a shorthand for **.unicodeToImage(str)** and **.shortnameToImage(str)**. First it will convert native unicode emoji directly to images and then convert any shortnames to images. This function can be useful to take mixed input and convert it directly to images if, for example, you wanted to give clients a live preview of their inputted text. Also, if your source text contains both unicode characters and shortnames (you didn't unify it) then this function will be useful to you.
      
**HTML:**
`<input type="button" value="Convert" onclick="convert()"/>`

**Javascript Snippet**
```javascript
function convert() {
	var input = document.getElementById('inputText').value;
	var output = emojione.toImage(input);
	document.getElementById('outputText').innerHTML = output;
}
```

----------

## .toShort(str)
*Convert Native Unicode Emoji to Shortnames*

Our recommendation is to unify all user inputted text by converting native unicode emoji, such as those inputted by mobile devices, to their corresponding shortnames. This demo shows you how to use the **.toShort(str)** Javascript function provided in our toolkit to do just that.

**HTML:**
`<input type="button" value="Convert" onclick="convert()"/>`

**Javascript Snippet**
```javascript
function convert() {
	var input = document.getElementById('inputText').value;
	var output = emojione.toShort(input);
	document.getElementById('outputText').innerHTML = output;
}
```

----------

## .shortnameToUnicode(str)
*Convert Shortnames to Native Unicode*

If you'd like to convert shortnames back to native unicode emoji characters, you can use this function.

**Javascript Snippet**
````javascript
function convert() {
	var input = document.getElementById('inputText').value;
	var output = emojione.shortnameToUnicode(input);
	document.getElementById('outputText').innerHTML = output;
}
````