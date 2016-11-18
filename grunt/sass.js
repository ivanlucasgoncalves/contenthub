// Compile SASS into CSS
module.exports = {
  dist: {
    options: {
      style: 'compressed',
      sourcemap: 'none'
    },
    files: [{
      expand: true,
      cwd: 'src/css',
      src: ['*.scss'],
      dest: 'theme/css',
      ext: '.css'
    }]
  }
};
