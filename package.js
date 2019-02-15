Package.describe({
  name: 'emojione:emojione',
  summary: 'Meteor Package of the https://www.emojione.com/ set.',
  version: '4.5.0',
  git: 'https://github.com/emojione/emojione.git'
});

Package.onUse(function(api) {
  api.versionsFrom('1.0.2.1');

  api.addFiles([
    'lib/meteor/pre-export.js',
    'lib/js/emojione.js',
    'lib/meteor/post-export.js'
  ]);

  api.use([
    'blaze',
    'htmljs',
    'templating'
  ], 'client');

  api.addFiles([
    'lib/meteor/emojione-client.js',
    'extras/css/emojione.css',
    'extras/css/emojione-awesome.css'
  ], 'client');
  
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32.min.css', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-activity.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-diversity.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-flags.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-food.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-nature.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-objects.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-people.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-regional.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-symbols.png', 'client');
  api.addAssets('../emojione-assets/sprites/emojione-sprite-32-travel.png', 'client');

  api.export('emojione');
});
