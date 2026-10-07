const CACHE_NAME = 'pdfacil-v2';
const ASSETS = [
  './',
  './index.php',
  './manifest.json',
  './assets/libs/pdf-lib.min.js',
  './assets/libs/pdf.min.js',
  './assets/libs/pdf.worker.min.js',
  './assets/libs/jszip.min.js',
  './assets/libs/sortable.min.js'
];

self.addEventListener('install', (e) => {
  e.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(ASSETS)).then(() => self.skipWaiting())
  );
});

self.addEventListener('activate', (e) => {
  e.waitUntil(
    caches.keys().then((keys) => {
      return Promise.all(
        keys.map((k) => {
          if (k !== CACHE_NAME) return caches.delete(k);
        })
      );
    }).then(() => self.clients.claim())
  );
});

self.addEventListener('fetch', (e) => {
  if (e.request.method === 'GET' && e.request.url.startsWith(self.location.origin)) {
    // Para index.php e raiz, buscar na rede primeiro para sempre receber atualizações frescas
    if (e.request.url.endsWith('/') || e.request.url.endsWith('/index.php')) {
      e.respondWith(
        fetch(e.request).then((res) => {
          const clone = res.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(e.request, clone));
          return res;
        }).catch(() => caches.match(e.request))
      );
      return;
    }

    e.respondWith(
      caches.match(e.request).then((res) => res || fetch(e.request).then((networkRes) => {
        if (networkRes.status === 200) {
          const clone = networkRes.clone();
          caches.open(CACHE_NAME).then((cache) => cache.put(e.request, clone));
        }
        return networkRes;
      }))
    );
  }
});
