<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  </head>
  <body>
    <script src="assets/js/global/system.js"></script>

    <div id="app">
      <?=str_replace(["<template>", "</template>"], ["<div>", "</div>"], file_get_contents("layouts/default.engine"))?>
    </div>

    <script src="https://unpkg.com/vue@2.6.11/dist/vue.min.js"></script>
    <script src="https://unpkg.com/vuex@3.1.3/dist/vuex.min.js"></script>
    <script src="https://unpkg.com/vue-router@3.1.6/dist/vue-router.min.js"></script>

    <script src="assets/js/global/router.js"></script>
    <script src="assets/js/global/store.js"></script>
    <script src="assets/js/global/main.js"></script>
  </body>
</html>
