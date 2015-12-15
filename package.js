Package.describe({
  name: 'emojione:emojione',
  summary: 'Meteor Package of http://www.emojione.com/ set',
  version: '1.5.2',
  git: 'https://github.com/Ranks/emojione.git'
});

Package.onUse(function(api) {
  api.versionsFrom('1.0.2.1');

  api.addFiles([
    'lib/meteor/pre-export.js',
    'lib/js/emojione.js',
    'lib/meteor/post-export.js',
  ]);

  api.use([
    'blaze',
    'htmljs',
    'templating',
  ], 'client');

  api.addFiles([
    'lib/meteor/emojione-client.js',
    'assets/css/emojione.css',
  ], 'client');

  if ((process.env.EMOJIONE_ADD_SVG_SPRITES !== undefined && process.env.EMOJIONE_ADD_SVG_SPRITES.toLowerCase() === 'true') || (process.env.EMOJIONE_ADD_PNG_SPRITES !== undefined && process.env.EMOJIONE_ADD_PNG_SPRITES.toLowerCase() === 'true')) {
    api.addFiles([
      'assets/sprites/emojione.sprites.css',
    ], 'client');
    if (process.env.EMOJIONE_ADD_SVG_SPRITES) {
        api.addAssets([
          'assets/sprites/emojione.sprites.svg'
        ], 'client');
    }
    if (process.env.EMOJIONE_ADD_PNG_SPRITES) {
        api.addAssets([
          'assets/sprites/emojione.sprites.png'
        ], 'client');
    }
  }

  api.export('emojione');
});
