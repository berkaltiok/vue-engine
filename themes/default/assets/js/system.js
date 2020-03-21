function loadComponent(componentName, path) {
  return new Promise(function (resolve, reject) {
    requirejs([`core/loader/component.php?e=${path}&n=${componentName}`], function () {
      const component = Vue.component(componentName);
      if (component) {
        resolve(component);
      } else {
        reject();
      }
    });
  });
}
function loadCSS(cssURL) {
  return new Promise(function (resolve, reject) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = cssURL;
    document.head.appendChild(link);
    link.onload = function () {
      resolve();
    };
  });
}
function loadScript(url, callback) {
  const script = document.createElement("script");
  script.type = "text/javascript";

  if (script.readyState) {
    script.onreadystatechange = function () {
      if (script.readyState === "loaded" || script.readyState === "complete") {
        script.onreadystatechange = null;
        callback();
      }
    };
  } else {  //Others
    script.onload = function () {
      callback();
    };
  }

  script.src = url;
  document.getElementsByTagName("head")[0].appendChild(script);
}