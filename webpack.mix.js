const mix = require('laravel-mix');

 mix.js('resources/js/app.js', 'public/js')
 .vue()
 .disableNotifications()
 .postCss('resources/css/app.css', 'public/css');

 module.exports = {
    module: {
      rules: [
        {
          test: /\.css$/i,
          use: ["style-loader", "css-loader"],
        },
      ],
    },
  };