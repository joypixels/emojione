# Emojione Awesome


### How to use

In the same vein as Font-Awesome, Emojione Awesome is for front end developers who just wanna drop an emoji on a page without using any sorts of scripts.
Uses human-friendly class names (based on emoji shortcodes). View a full list of shortcodes at www.emoji.codes


```
<!-- Coffee Emoji -->
<i class="e1a-coffee"></i>
```

Additional classes let you modify size:

```
<!-- Coffee Emoji (large) -->
<i class="e1a-coffee e1a-lg"></i>

<!-- Coffee Emoji (2x) -->
<i class="e1a-coffee e1a-2x"></i>

<!-- Coffee Emoji (3x) -->
<i class="e1a-coffee e1a-3x"></i>

<!-- Coffee Emoji (4x) -->
<i class="e1a-coffee e1a-4x"></i>

<!-- Coffee Emoji (5x) -->
<i class="e1a-coffee e1a-5x"></i>

```


# Thanks

Special Thanks to Michael Hartmann for creating these scripts for us!


### How to generate mapping

```
cd lib/emojione-awesome
node generate.js

```

### How to compile scss

Once you've generated the mapping you can build the css files via grunt.
The compiled styles are output into /assets/css/emojione-awesome.css

```
npm install grunt grunt-contrib-sass
grunt sass
```