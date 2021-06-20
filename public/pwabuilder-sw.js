// This is the "Offline page" service worker

importScripts('https://storage.googleapis.com/workbox-cdn/releases/5.1.2/workbox-sw.js');

const CACHE = "pwabuilder-page";

//TODO: replace the following with the correct offline fallback page i.e.: const offlineFallbackPage = "offline.html";
const offlineFallbackPage = "./offline.html";

self.addEventListener("message", (event) => {
    if (event.data && event.data.type === "SKIP_WAITING") {
        self.skipWaiting();
    }
});

self.addEventListener('install', async (event) => {
    event.waitUntil(
        caches.open(CACHE)
        .then((cache) => cache.add(offlineFallbackPage))
    );
});

if (workbox.navigationPreload.isSupported()) {
    workbox.navigationPreload.enable();
}

self.addEventListener('fetch', (event) => {
    if (event.request.mode === 'navigate') {
        event.respondWith((async () => {
            try {
                const preloadResp = await event.preloadResponse;

                if (preloadResp) {
                    return preloadResp;
                }

                const networkResp = await fetch(event.request);
                return networkResp;
            } catch (error) {

                const cache = await caches.open(CACHE);
                const cachedResp = await cache.match(offlineFallbackPage);
                return cachedResp;
            }
        })());
    }
});


self.addEventListener('push', function (e) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        console.log('notification permissions not granted');
        //notifications aren't supported or permission not granted!
        return;
    }

    /*clients.matchAll().then(function(clients) {
        if(clients.length === 0) { */
            if (e.data) {
                var msg = e.data.json();
                console.log(msg)
                e.waitUntil(self.registration.showNotification(msg.title, {
                    body: msg.body,
                    icon: msg.icon,
                    actions: msg.actions,
                    tag: msg.tag,
                    badge: msg.badge,
                    vibrate: msg.vibrate,
                    data: msg.data,
                    renotify: msg.data.renotify,
                    requireInteraction: msg.requireInteraction,
                    image: msg.image
                }));
            }
       /* }
    }); */
});

self.addEventListener("notificationclick", function(event) {
    event.notification.close();
    event.waitUntil(self.clients.matchAll().then(function(activeClients) {
        let action = event.action !== '' ? event.action : Object.keys(event.notification.data.action_url)[0];
        let action_url = event.notification.data.action_url[action] ?? '/';
        if (activeClients.length > 0) {
            activeClients[0].navigate(action_url);
        } else {
            self.clients.openWindow(action_url);
        }
    }));
});
