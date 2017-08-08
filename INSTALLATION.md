### Installation

We've teamed up with [JSDelivr](http://www.jsdelivr.com/#!emojione) to provide a simple way to install these emoji on any javascript-enabled website. Add the following script and stylesheet links to the head of your webpage:

```
<script src="https://cdn.jsdelivr.net/emojione/3.1.2/lib/js/emojione.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/emojione/3.1.2/extras/css/emojione.min.css"/>
```

Quick installs can also be done using NPM and Bower (for the Javascript toolkit) or Composer (for the PHP toolkit). **If you wish to serve image assets locally you'll need to install [emojione-assets](https://www.github.com/emojione/emojione-assets) and include the pngs and/or sprites into your project.** Many of our [demos](https://demos.emojione.com/latest/) use assets locally simply by pointing the `imagePathPNG` variable to your local asset location.

#### NPM
```
> npm install emojione
```

#### Bower
```
> bower install emojione
```


#### Composer
```
$ composer require emojione/emojione
```

#### Meteor
```
meteor add emojione:emojione
```

### Version 2 Installation
If you're looking to use emojione < version 3.0, refer to [the 2.2.7 branch](https://github.com/emojione/emojione/tree/2.2.7). **CDN (jsdelivr) dependency has been preserved for version 2.**


### Character Encoding &mdash; UTF-8

If you're getting serious about implementing emoji into your website, you will want to consider your web stack's character encoding. You should make sure that all connection points are using the same encoding. There are a lot of options and configuration possibilities here, so you'll have to figure what works best for your own situation. 

A quick Google search will bring up a lot of information on how to get your entire web stack to use UTF-8, which is needed to properly handle Unicode emoji.

To get you started, here's a nice guide: [UTF-8: The Secret of Character Encoding](http://htmlpurifier.org/docs/enduser-utf8.html).
