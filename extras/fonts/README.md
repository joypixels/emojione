## EmojiOne Fonts

There's no better way to port our emoji into your device than through a native font.  We don't have the resources ourselves to construct fonts, so we'll depend on helpful contributions from the open source community.

> Note: Due to their size, the font files have been removed from this repo and instead will be attached to releases on our repo that hosts the artwork and related assets, [emojione-assets](https://github.com/emojione/emojione-assets).
>
> Please go here to download the font files: [emojione-assets/releases](https://github.com/emojione/emojione-assets/releases)
### Google Font - [emojione-android.ttf](https://github.com/emojione/emojione-assets/releases/download/4.5/emojione-android.ttf)

  * Compatible with rooted Android devices and Linux.
  * Updated Sept 12, 2018
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

**For latest apple devices** 
- [emojione-mac.ttc](https://github.com/emojione/emojione-assets/releases/download/4.5/emojione-mac.ttc)
- [emojione-ios.ttc](https://github.com/emojione/emojione-assets/releases/download/4.5/emojione-ios.ttc)

  * Compatible with Mac OSX, and iOS devices (iPhone, iPad).
  * Rename font to Apple Color Emoji.ttc for Mac OSX.
  * Rename font to AppleColorEmoji@2x.ttc for iOS, jailbreak required.
  * Updated Oct 29, 2018
  
 
**Mac OS System Instructions:**
	1.) Manual 
	- Simply move the Mac compatible font into `~/Library/Fonts/Apple Color Emoji.ttc`. You should immediately see a new version of the Apple Color Emoji font in your Fontbook, and it will be useable immediately.

**iOS System Instructions:**
	1.) Manual 
	- Take a look at [PoomSmarts Guide](https://poomsmart.github.io/repo/emoji10.html) Option #3: Manual

	2.) Installable
	Cydia is a package manager app for rooted/jailbroken iOS devices(iPhone, iPod, iPad) and is based on Debian APT [(Advanced Packaging Tool)](https://en.wikipedia.org/wiki/APT_(Debian)) 
	Tap [Add EmojiPort Fonts](cydia://url/https://cydia.saurik.com/api/share#?source=https://vxbakerxv.github.io/repo/) cydia source for "EmojiOne 2018".

App Instructions:
    This has not been fully tested/confirmed but may work in app projects. 
	Extract TTF from TTC and create new FontFamily name 'EmojiOne'. After that you should be able to drop the font in your project and use UIFont to call that newly created FontFamily name. 
	[otc2otf.py](https://github.com/adobe-type-tools/afdko/tree/develop/python/afdko) Adobe standalone python script to extract fonts from a TTC
	[fontname.py](https://github.com/chrissimpkins/fontname.py) FontTools python script to change name table in a TTF.
	You can also use High-Logic FontCreator to do the above tasks.
	
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
