// Keep an eye on source files in case anything changes
module.exports = {
  sass: {
    files: ['src/css/**/*'],
    tasks: ['sass','postcss','copy:theme']
  },
  javascript: {
    files: ['src/js/**/*','copy:theme'],
    tasks: ['uglify']
  },
  static: {
    files: ['theme/**/*'],
    tasks: ['copy:theme'],
    options: {
      livereload: 35731
    }
  }
};
