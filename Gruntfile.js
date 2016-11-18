module.exports = function(grunt) {
  var ip = null;
  var interfaces = require('os').networkInterfaces();
  for (var devName in interfaces) {
    var iface = interfaces[devName];

    for (var i = 0; i < iface.length; i++) {
      var alias = iface[i];
      if (alias.family === 'IPv4' && alias.address !== '127.0.0.1' && !alias.internal)
        ip = alias.address;
    }
  }


  require('load-grunt-tasks')(grunt, {pattern: ['grunt-*']});
  require('load-grunt-config')(grunt, {config: {ip: ip}});

};
