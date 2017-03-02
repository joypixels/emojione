#EmojiOne

##**Javascript Implementation Examples**

The following Javascript code snippets demonstrate common usages of EmojiOne within your project.

----------

##.shortnameToImage(str)
*Convert Shortnames to Images*

If you've chosen to unify your inputted text so that it contains only shortnames then this is the function (or its matching PHP function) you will want to use to convert the shortnames images when displaying it to the client.

**HTML:**
`<input type="button" value="Convert" onclick="convert()"/>`

**Javascript**
```
function convert() {
	var input = document.getElementById('inputText').value;
	var output = emojione.shortnameToImage(input);
	document.getElementById('outputText').innerHTML = output;
}
```