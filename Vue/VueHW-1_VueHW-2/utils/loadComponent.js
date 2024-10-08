const { defineAsyncComponent } = Vue;
const { loadModule } = window["vue3-sfc-loader"];

function loadComponent(url, options = {}) {
  return defineAsyncComponent(() =>
    loadModule(url, {
      moduleCache: {
        vue: window.Vue,
      },
      async getFile(url) {
        const res = await fetch(url);
        if (!res.ok)
          throw Object.assign(new Error(res.statusText + " " + url), {
            res,
          });
        return {
          getContentData: (asBinary) =>
            asBinary ? res.arrayBuffer() : res.text(),
        };
      },
      addStyle(textContent) {
        const style = Object.assign(document.createElement("style"), {
          textContent,
        });
        const ref = document.head.getElementsByTagName("style")[0] || null;
        document.head.insertBefore(style, ref);
      },
      ...options,
    })
  );
}
