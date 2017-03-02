#EmojiOne

##**Additional Implementation Examples**

The following code snippets demonstrate common usages of EmojiOne within your project.

----------

##Alternate Alt Tags

By default, both the Javascript and PHP toolkits we've provided will use the native unicode character as the alt tag for converted <IMG> tags. Doing this makes it so that if you copy and paste the converted text, in most cases, it will copy the native unicode emoji instead of the image. You can optionally turn this off by setting **unicodeAlt** to **false**. If set to false, the toolkits will use the :shortname: as the alternate text instead.

**HTML Output (default)**
```html
<p id="example-png">
	PNG: Hello world! <img class="emojione" alt="😄" title=":smile:" src="../assets/png/1f604.png">
</p>
```

**Javascript For Shortname Alt**
```javascript
$(document).ready(function() {
	// turn unicode alternate text off
	emojione.unicodeAlt = false;
	
	var input = $('#example-png').html();
	var replaced = emojione.toImage(input);
	$('#example-png').html(replaced);
});
```

**HTML Output For Shortname Alt**
```html
<p id="example-png">
	PNG: Hello world! <img class="emojione" alt=":smile:" title=":smile:" src="../assets/png/1f604.png">
</p>
```

