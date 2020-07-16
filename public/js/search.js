document.addEventListener("DOMContentLoaded", function(event) {
  function push() {
    const { name, value } = this;
    const query = {};
    location.search
      .replace(/^\?/, '')
      .split('&')
      .map(str => {
        const [ key, val ] = str.split('=');
        query[key] = val
      })
    query[name] = value;

    if (!query.make) {
      delete query.model;
    }

    query.page = 1;

    const queryString = Object.keys(query)
                          .map(key => `${key}=${query[key]}`)
                          .join('&')

    window.location = `/?${queryString}`
  }

  document.getElementById('selectCondition').addEventListener("change", push);
  document.getElementById('selectYear').addEventListener("change", push);
  document.getElementById('selectMake').addEventListener("change", push);
  document.getElementById('selectModel').addEventListener("change", push);
})
