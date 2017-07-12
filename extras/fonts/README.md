## EmojiOne Fonts

There's no better way to port our emoji into your device than through a native font.  We don't have the resources ourselves to construct fonts, so we'll depend on helpful contributions from the open source community.

### Google Font - emojione-android.ttf
https://github.com/Ranks/emojione/raw/master/extras/fonts/emojione-android.ttf

  * Compatible with rooted Android devices and Linux.
  * Updated July 6, 2017
  * Developers using the font within their app, please review [this issue](https://github.com/Ranks/emojione/issues/385) regarding proper display of digits.

Android Setup Help:
* We recommend Emoji Switcher (now free for EmojiOne): https://play.google.com/store/apps/details?id=com.stevenschoen.emojiswitcher&hl=en
* Reddit Thread: https://www.reddit.com/r/Android/comments/3xezb9/emojione_on_android/
* Must have a rooted Android phone.

Linux Setup Help:
  * Place the file in `~/.local/share/fonts/`
  * Create the following fontconfig file: [latest](https://github.com/maximbaz/dotfiles/blob/master/.config/fontconfig/conf.d/70-emojione-color.conf) ([snapshot](https://github.com/maximbaz/dotfiles/blob/b63b2fe4bb5362d207e407c646655070cd1251bc/.config/fontconfig/conf.d/70-emojione-color.conf))
  * Update fontconfig cache with `$ fc-cache -f`
  * Chrome and all derivative apps (like Electron) will display color emoji after a restart.
  * Install a patched Cairo library to display color emoji in all GTK+ apps:
    * https://aur.archlinux.org/packages/cairo-coloredemoji
    * https://software.opensuse.org/package/libcairo2-color-emoji

### Apple Font

**For older apple devices**

https://github.com/Ranks/emojione/raw/master/extras/fonts/emojione-apple.ttf

**For latest apple devices**

https://github.com/Ranks/emojione/raw/master/extras/fonts/emojione-apple.ttc

  * Compatible with Mac OSX, and iOS devices (iPhone, iPad).
  * Rename font to Apple Color Emoji.ttf for Mac OSX.
  * Rename font to AppleColorEmoji@2x.ttf for iOS, jailbreak required.
  * Known Issue: On Mac OSX, emoji may display significantly smaller than normal (system wide).
  * Updated July 8, 2017
  
Mac OS Instructions:
Using the latest OS (El Capitan), I was able to load this emoji file in less than a minute.  The original emoji ttf is located in system/library/fonts, do not touch this.  You can safely upload the renamed file (from emojione-apple.ttf, to Apple Color Emoji.ttf) to the /library/fonts folder.  That file will override the default.  This was my experience, but yours may vary.  If someone could create a video and/or web-site guide, we'd gladly link to it.

iOS Instructions:
Search for “EmojiOne 2016” on Cydia and apply with BytaFont. Cydia is a software application for iOS that enables a user to find and install software packages on jailbroken iOS devices (iPhone, iPod, iPad).

### EmojiOne SVG-based Color Fonts
Through a cooperative effort with Adobe Systems, EmojiOne created black and white versions of the emoji set which were used, in part, to generate this font. Using these fonts with Firefox or Microsoft Edge, you can enjoy full-color EmojiOne emoji. Black and white images will show as the fall back for systems that are not able to render color SVG fonts. The font is available in the following formats:

  * Open Type Font: https://github.com/Ranks/emojione/raw/master/extras/fonts/emojione-svg.otf
  * Web Open Font Format: https://github.com/Ranks/emojione/raw/master/extras/fonts/emojione-svg.woff
  * Web Open Font Format 2.0: https://github.com/Ranks/emojione/raw/master/extras/fonts/emojione-svg.woff2

The black and white images used to generate these fonts are also provided in the v2 branch here:

  * SVGs available at https://github.com/Ranks/emojione/tree/2.2.7/assets/svg_bw/
  * PNGs available at https://github.com/Ranks/emojione/tree/2.2.7/assets/png_bw/

---
  
### Contributions
  * If you have a font to add, please submit a pull request.  
  * Please thoroughly test the files the best you can.  
  * Let us know how you'd like to be acknowledged.  

### Warranty & Disclaimer
  * These files are very raw and not fully tested.  
  * We provide no guarantees that the font will function on your device.
  
### Acknowledgements
  * Google Font: Thanks to Miguel Sousa from Adobe Systems, [Maxim Baz](https://github.com/maximbaz) and [Albert Chang](https://github.com/mxalbert1996).
  * Apple Font: Thanks to Philip (@pw5a29) and Cody (@vXBaKeRXv).
