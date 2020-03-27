<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Title</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <?=$engine->loadCSS()?>
  </head>
  <body>
    <noscript><strong>Sorry, this project isn't working properly without JavaScript enabled. Please enable to continue.</strong></noscript>
    <layout id="app"></layout>
    <script>const VUE_THEME = "<?=$engine->getTheme()?>", VUE_DIRECTION = "<?=$engine->getDirection()?>";</script>
    <?=$engine->loadJS(["core/assets/js/vue.min.js", "core/assets/js/vue-router.min.js", "core/assets/js/vuex.min.js", "core/assets/js/vue-meta.min.js", "core/assets/js/vue-clickaway.min.js", "core/assets/js/require.min.js"])?>
  </body>
</html>