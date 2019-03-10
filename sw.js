var CACHE_NAME = 'static-v1';
var pagesToCache = [
    '/',
    './index.html',
    './style.css',
    './manifest.json',
    './img/icone.png',
]


self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then((cache) =>{
            console.log("Cache aberto")
            return cache.addAll(pagesToCache);
        })
    )
});

self.addEventListener('fetch', (event) => {
    event.respondWith(
        caches.match(event.request)
        .then((cachedResponse) => {
            return cachedResponse || fetch(event.request);
        })
    );
});

self.addEventListener('activate', (event) => {
    event.waitUntil(
        caches.keys().then((keys) => {
            return Promise.all(keys.filter((key) => {
                return key.indexOf(CACHE_NAME) !== 0;
                })
                .map((key) => {
                    return caches.delete(key);
                })
            );
        })
    );
});