(function () {
  var header = document.querySelector('.site-header');
  var searchToggle = document.querySelector('.search-toggle');
  var searchForm = document.querySelector('.header-search');
  var searchInput = document.querySelector('#header-search-field');

  if (!header || !searchToggle || !searchForm || !searchInput) {
    return;
  }

  function closeSearch() {
    header.classList.remove('search-open');
    searchToggle.setAttribute('aria-expanded', 'false');
  }

  function openSearch() {
    header.classList.add('search-open');
    searchToggle.setAttribute('aria-expanded', 'true');
    window.setTimeout(function () {
      searchInput.focus();
    }, 180);
  }

  searchToggle.addEventListener('click', function (event) {
    event.preventDefault();

    if (header.classList.contains('search-open')) {
      closeSearch();
      return;
    }

    openSearch();
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeSearch();
    }
  });

  document.addEventListener('click', function (event) {
    if (!header.classList.contains('search-open')) {
      return;
    }

    if (!header.contains(event.target)) {
      closeSearch();
    }
  });
})();

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
