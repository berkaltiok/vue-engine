<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>
  </head>
  <body>
    <noscript><strong>Sorry, this project isn't working properly without JavaScript enabled. Please enable to continue.</strong></noscript>
    <layout id="app"></layout>
    <?=$engine->loadJS(["core/assets/js/vue.min.js", "core/assets/js/vue-router.min.js", "core/assets/js/vuex.min.js", "core/assets/js/vue-meta.min.js", "core/assets/js/require.min.js"])?>
  </body>
</html>