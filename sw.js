const cacheName = 'luvo-v1';
const statisticAssets = [
  './',
  'home.php',
  'script.js',
  'jquery-3.5.1.min.js',
  'post.php',
  'style.css',
  'usage.php',
  'settings.php',
  'theme.php',
  'privacy.php',
  'security.php',
  'notification.php',
  'bootstrap.css',
  'manifest.webmanifest',
  'img/Luvo_logo.png',
  'footer.php',
  'mainmenubar.php'
];
self.addEventListener('install', async e => {
  const cache = await caches.open(cacheName);
  await cache.addAll(statisticAssets);
  return self.skipWaiting();
});

self.addEventListener('activate', e => {
  self.clients.claim();
});

self.addEventListener('fetch', async e => {
  const req = e.request;
  const url = new URL(req.url);

  if (url.origin == location.origin) {
    e.respondWith(cacheFirst(req));
  } else {
    e.respondWith(networkAndCache(req));
  }
});

async function cacheFirst(req) {
  const cache = await caches.open(cacheName);
  const cached = await cache.match(req);
  return cached || fetch(req);
}

async function networkAndCache(req) {
  const cache = await caches.open(cacheName);
  try {
    const fresh = await fetch(req);
    await cache.put(req, fresh.clone());
    return fresh;
  } catch (e) {
    const cached = await cache.match(req);
    return cached;
  }
}
