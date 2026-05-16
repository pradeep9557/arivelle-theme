(function () {
  var products = document.querySelector('body.tax-product_cat ul.products');
  var pagination = document.querySelector('body.tax-product_cat nav.woocommerce-pagination');

  if (!products || !pagination) {
    return;
  }

  var nextLink = pagination.querySelector('a.next');

  if (!nextLink) {
    pagination.remove();
    return;
  }

  var nextUrl = nextLink.href;
  var loading = false;
  var loader = document.createElement('div');
  var sentinel = document.createElement('div');

  loader.className = 'category-lazy-loader';
  loader.textContent = 'Loading more products...';
  sentinel.className = 'category-lazy-sentinel';
  pagination.replaceWith(loader);
  loader.after(sentinel);

  function loadNextPage() {
    if (loading || !nextUrl) {
      return;
    }

    loading = true;
    loader.classList.add('is-loading');

    fetch(nextUrl, { credentials: 'same-origin' })
      .then(function (response) {
        if (!response.ok) {
          throw new Error('Could not load products.');
        }

        return response.text();
      })
      .then(function (html) {
        var doc = new DOMParser().parseFromString(html, 'text/html');
        var nextProducts = doc.querySelectorAll('ul.products li.product');
        var nextPage = doc.querySelector('nav.woocommerce-pagination a.next');

        nextProducts.forEach(function (product) {
          products.appendChild(document.importNode(product, true));
        });

        nextUrl = nextPage ? nextPage.href : '';

        if (!nextUrl) {
          loader.remove();
          sentinel.remove();
          observer.disconnect();
        }
      })
      .catch(function () {
        loader.textContent = 'More products could not be loaded. Please refresh the page.';
        observer.disconnect();
      })
      .finally(function () {
        loading = false;
        loader.classList.remove('is-loading');
      });
  }

  var observer = new IntersectionObserver(function (entries) {
    if (entries[0] && entries[0].isIntersecting) {
      loadNextPage();
    }
  }, {
    rootMargin: '420px 0px',
  });

  observer.observe(sentinel);
})();
