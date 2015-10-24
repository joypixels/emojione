Package.describe({
  name: 'emojione:emojione',
  summary: 'Meteor Package of http://www.emojione.com/ set',
  version: '1.5.2',
  git: 'https://github.com/Ranks/emojione.git'
});

Package.onUse(function(api) {
  api.versionsFrom('1.0.2.1');

  api.addFiles([
    'lib/js/emojione.js',
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

  api.export('emojione');
});
