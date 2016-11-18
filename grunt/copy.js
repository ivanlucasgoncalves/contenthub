// Copy static files to public (done after cleaning it out)
module.exports = {
  theme: {
    cwd: 'theme',
    src: ['**'],
    dest: 'public_html/wp-content/themes/contentHub',
    expand: true
  },
  root_files: {
    cwd: '',
    src: ['*.{png,ico}'],
    dest: 'public_html',
    expand: true
  }
};
