## EmojiOne Fonts

There's no better way to port our emoji into your device than through a native font.  We don't have the resources ourselves to construct fonts, so we'll depend on helpful contributions from the open source community.

> Note: Due to their size, the font files have been removed from this repo and instead will be attached to releases on our repo that hosts the artwork and related assets, [emojione-assets](https://github.com/emojione/emojione-assets).
>
> Please go here to download the font files: [emojione-assets/releases](https://github.com/emojione/emojione-assets/releases)
### Google Font - [emojione-android.ttf](https://github.com/emojione/emojione-assets/releases/download/3.1.2/emojione-android.ttf)

  * Compatible with rooted Android devices and Linux.
  * Updated July 6, 2017
  * Developers using the font within their app, please review [this issue](https://github.com/Ranks/emojione/issues/385) regarding proper display of digits.

Android Setup Help:
* We recommend Emoji Switcher (now free for EmojiOne): https://play.google.com/store/apps/details?id=com.stevenschoen.emojiswitcher&hl=en
* Reddit Thread: https://www.reddit.com/r/Android/comments/3xezb9/emojione_on_android/
* Must have a rooted Android phone.

Linux Setup Help:

* ArchLinux users are advised to install [AUR package](https://aur.archlinux.org/packages/ttf-emojione/)
* Alternatively setup the font manually:
  * Place the file in `~/.local/share/fonts/`
  * Create the following fontconfig file: [latest](https://aur.archlinux.org/cgit/aur.git/tree/70-emojione-color.conf?h=ttf-emojione) ([snapshot](https://github.com/maximbaz/dotfiles/blob/c893a835372c927eba9ec7e086e76b64f6210d8c/.config/fontconfig/conf.d/70-emojione-color.conf))
  * Update fontconfig cache with `$ fc-cache -f; sudo fc-cache -f`
* The font seems to be working now in Chrome and Firefox, as well as in many other apps!

### Apple Font

**For older apple devices** - [emojione-apple.ttf](https://github.com/emojione/emojione-assets/releases/download/3.1.2/emojione-apple.ttf)

**For latest apple devices** - [emojione-apple.ttc](https://github.com/emojione/emojione-assets/releases/download/3.1.2/emojione-apple.ttc)

  * Compatible with Mac OSX, and iOS devices (iPhone, iPad).
  * Rename font to Apple Color Emoji.ttf for Mac OSX.
  * Rename font to AppleColorEmoji@2x.ttf for iOS, jailbreak required.
  * Known Issue: On Mac OSX, emoji may display significantly smaller than normal (system wide).
  * Updated July 8, 2017
  
Mac OS Instructions:
Simply move the font into `~/Library/Fonts/Apple Color Emoji.ttc`. You should immediately see a new version of the Apple Color Emoji font in your Fontbook, and it will be useable immediately.

iOS Instructions:
Search for “EmojiOne 2016” on Cydia and apply with BytaFont. Cydia is a software application for iOS that enables a user to find and install software packages on jailbroken iOS devices (iPhone, iPod, iPad).

### EmojiOne SVG-based Color Fonts
Through a cooperative effort with Adobe Systems, EmojiOne created black and white versions of the emoji set which were used, in part, to generate this font. Using these fonts with Firefox or Microsoft Edge, you can enjoy full-color EmojiOne emoji. Black and white images will show as the fall back for systems that are not able to render color SVG fonts. The font is available in the following formats:

  * Open Type Font: [emojione-svg.otf](https://github.com/emojione/emojione-assets/releases/download/3.1.2/emojione-svg.otf)
  * Web Open Font Format: [emojione-svg.woff](https://github.com/emojione/emojione-assets/releases/download/3.1.2/emojione-svg.woff)
  * Web Open Font Format 2.0: [emojione-svg.woff2](https://github.com/emojione/emojione-assets/releases/download/3.1.2/emojione-svg.woff2)

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
