//jshint strict: false
module.exports = function(config) {
  config.set({

    files: [
      'bower_components/angular/angular.js',
      'bower_components/angular-route/angular-route.js',
      'bower_components/angular-mocks/angular-mocks.js',
      'components/**/*.js',
      'view*/**/*.js',
      'controllers/**/*.js',
      'models/**/*.js',
      'tests/**/*.js'
    ],

    autoWatch: true,

    frameworks: ['jasmine'],

    browsers: ['Chrome'],

    plugins: [
      'karma-chrome-launcher',
      'karma-firefox-launcher',
      'karma-jasmine',
      'karma-junit-reporter',
      'karma-coverage'
    ],

    junitReporter: {
      outputFile: 'test_out/unit.xml',
      suite: 'unit'
    },

    preprocessors: {
      //TODO: исключить bower_components и node_modules
      '**/*.js': 'coverage'
    },

    coverageReporter: {
      type : 'html',
      dir : 'coverage/'
    },

    reporters: ['progress','coverage']

  });
};
