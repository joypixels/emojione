## Unicode Conversion

```
# single character
🐌

# character mid sentence
The 🦄 is EmojiOne's official mascot.

# character mid sentence with a comma
The 🦄, is EmojiOne's official mascot.

# character at start of sentence
🐌 mail.

# character at start of sentence with apostrophe
🐌's are cool!

# character at end of sentence
EmojiOne's official mascot is 🦄.

# character at end of sentence with alternate puncuation
EmojiOne's official mascot is 🦄!

# character at end of sentence with preceeding colon
EmojiOne's official mascot: 🦄

# character inside of IMG tag
The <img class="emojione" alt="🦄" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f984.png" /> is EmojiOne's official mascot.

```


## Shortname Conversion

```
# single shortname
:snail:

# shortname mid sentence
The :unicorn: is EmojiOne's official mascot.

# shortname mid sentence with a comma
The :unicorn:, is EmojiOne's official mascot.

# shortname at start of sentence
:snail: mail.

# shortname at start of sentence with apostrophe
:snail:'s are cool!

# shortname at end of sentence
EmojiOne's official mascot is :unicorn:.

# shortname at end of sentence with alternate puncuation
EmojiOne's official mascot is :unicorn:!

# shortname at end of sentence with preceeding colon
EmojiOne's official mascot: :unicorn:

# shortname inside of IMG tag
The <img class="emojione" alt=":unicorn:" title=":unicorn:" src="https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f984.png" /> is EmojiOne's official mascot.

```

## ASCII Conversion

```html
# single smiley
:D

# single smiley with incorrect case (shouldn't convert)
:d

# multiple smileys
;) :p :*

# smiley to start a sentence
:\ is our confused smiley.

# smiley to end a sentence
Our smiley to represent joy is :')

# smiley to end a sentence with puncuation
The reverse is the joy smiley is the cry smiley :'(.

# smiley to end a sentence with preceeding punctuation
This is the "flushed" smiley: :$.

# smiley inside of an IMG tag  (shouldn't convert anything inside of the tag)
Smile <img class="emojione" alt=":)" title=":smile:" src="https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f604.png" /> because it's going to be a good day.

# typical username password fail  (shouldn't convert the user:pass, but should convert the last :p)
Please log-in with user:pass as your credentials :P.

# shouldn't replace an ascii smiley in a URL (shouldn't replace :/)
Check out https://www.emojione.com

```
