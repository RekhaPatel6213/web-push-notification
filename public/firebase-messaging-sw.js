self.addEventListener('push', function(event) {
    if (!(self.Notification && self.Notification.permission === 'granted')) {
        //notifications aren't supported or permission not granted!
        return;
    }

    if (event.data) {
        const responseData = event.data.json();

        // Extract actions if available
        let actions = [];
        if (responseData.data.actions) {
            actions = JSON.parse(responseData.data.actions);
        }


        event.waitUntil(self.registration.showNotification(responseData.data.title, {
            body: responseData.data.body,
            icon: responseData.data.icon,
            image: responseData.data.image,
            data: { url: responseData.data.url },
            actions: actions,
            requireInteraction: true 
        }));
    }
});

// Handle notification action clicks
self.addEventListener("notificationclick", function(event) {
    event.notification.close(); // Close notification

    if (event.action === "open_url") {
        event.waitUntil(clients.openWindow(event.notification.data.url)); // Open the URL
    }
});