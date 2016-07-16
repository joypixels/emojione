Package.describe({
  name: 'emojione:emojione',
  summary: 'Meteor Package of http://www.emojione.com/ set',
  version: '2.2.6',
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

  api.addAssets('assets/sprites/emojione.sprites.css', 'client');
  api.addAssets('assets/sprites/emojione.sprites.svg', 'client');
  api.addAssets('assets/sprites/emojione.sprites.png', 'client');

  api.export('emojione');
});
