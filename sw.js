var CACHE_NAME = 'devCach-v16';
var pagesToCache = [
    // './home.php',
    './editarperfil.php',
    './style.css',
    './mdl/material.min.css',
    './manifest.webmanifest',
    './app.js',
    './mdl/material.min.js',
    './js/easypiechart.js',
    './img/simbolo.png',
    './img/inicio.png',
    './favicon.ico'
]


self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME)
        .then((cache) =>{
            console.log("Cache aberto");
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
