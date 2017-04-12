# Emoji Alpha Codes

### WHAT ARE EMOJI ALPHA CODES?

An EAC (some know them as cheat codes, shortnames, or short codes) are emoji keywords wrapped in colons such as :emoji: as an alternative/convenient method to inserting emoij graphics directly into message forms without having to use a separate emoji picker or pasting the emoji unicode.

### PURPOSE OF THIS DATA

The purpose is to unify various alpha code lists into a single table developers could contribute to and share.  With a few different tables floating around, we've done our best to organize and de-fragment the tables.  To do this, we've divided the codes into a primary and secondary category.  The single "primary" EAC code is the main identifier and the "secondary" EAC code(s) are alternatives.  This gives the site developer the option to allow either a primary or secondary code to be entered to call a single emoji.

Our goal here is to help everyone involved and we appreciate contributions to this list.  Please know we don't recommend the primary EAC's change unless there's a major reason for it.

### THE FILES

We've included the current list of emoji alpha codes in two formats, json and csv. In each file the data is primarily arranged by unicode code point. The files are structured as such.

##### JSON

```
{
    "1f600": {
        "name": "grinning face",
        "alpha_code": ":grinning:",
        "aliases": ""
    },
    "1f642": {
        "name": "slightly smiling face",
        "alpha_code": ":slight_smile:",
        "aliases": ":slightly_smiling_face:"
    },
    "1f36e": {
        "name": "custard",
        "alpha_code": ":custard:",
        "aliases": ":pudding:|:flan:"
    }
}
```

##### CSV

```
“unicode”, “name”, "alpha_code”, “aliases”
```

### LICENSE

*  License: MIT
*  Complete Legal Terms: http://opensource.org/licenses/MIT
