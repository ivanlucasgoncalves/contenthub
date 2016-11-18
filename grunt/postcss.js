// Process CSS files
module.exports = {
  options: {
    map: 'false',
    processors: [
      require('autoprefixer')({
        browsers: ['last 2 versions']
      })
    ]
  },
  dist: {
    src: 'theme/css/*.css'
  }
};
