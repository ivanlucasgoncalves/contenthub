// Shrinkify JS
module.exports = {
  options: {
    // this stops it catching fire
    mangle: false
  },
  dist: {
    files: {
      'theme/js/script.min.js': [
        'src/js/**/*.js',
        'src/js/scripts.js'
      ]
    }
  }
};
