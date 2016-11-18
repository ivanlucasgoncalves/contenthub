// Run a local server
module.exports = {
  server: {
    options: {
      port: 8789,
      hostname: '<%=ip%>',
      base: require('path').resolve('./public_html/'),
      livereload: 35731,
      open: true,
      directives: {
        'error_log': require('path').resolve('error.log')
      },
      env: {
        DEV_IP: '<%=ip%>'
      }
    }
  }
};
