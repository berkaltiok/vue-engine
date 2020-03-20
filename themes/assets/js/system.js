function loadComponent(componentName, path) {
  return new Promise(function (resolve, reject) {
    requirejs([`core/loader/component.php?f=${path}/${componentName}`], function () {
      const component = Vue.component(componentName);
      if (component) {
        resolve(component);
      } else {
        reject();
      }
    });
  });
}