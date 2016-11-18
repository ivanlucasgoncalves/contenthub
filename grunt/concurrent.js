// Run tasks concurrently
module.exports = {
  options: {
    logConcurrentOutput: true
  },
  serve: ['php', 'watch']
};
