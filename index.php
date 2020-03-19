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
    <div id="app">
      <?=str_replace(["<template>", "</template>"], ["<div>", "</div>"], file_get_contents("layouts/default.engine"))?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.min.js"></script>

    <!-- SETUP AUTO LOAD -->
    <script src="https://unpkg.com/vue@2.6.11/dist/vue.min.js"></script>
    <script src="https://unpkg.com/vuex@3.1.3/dist/vuex.min.js"></script>
    <script src="https://unpkg.com/vue-router@3.1.6/dist/vue-router.min.js"></script>
    <script src="https://requirejs.org/docs/release/2.3.6/minified/require.js"></script>

    <!-- POST -->
    <script src="assets/js/system.js"></script>
    <script src="assets/js/router.js"></script>
    <script src="assets/js/store.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
