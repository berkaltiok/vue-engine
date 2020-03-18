function load(fileName) {
  if (!fileName) return false;
  let xhr = new XMLHttpRequest();
  xhr.open('GET', fileName);
  xhr.send();
  xhr.onload = function () {
    if (xhr.status >= 200 && xhr.status < 300) return xhr.response;
  };
}
