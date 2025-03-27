<script src="https://www.gstatic.com/firebasejs/11.5.0/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/11.5.0/firebase-messaging-compat.js"></script>
<script>
    const firebaseConfig = {
        apiKey: "YOUR_API_KEY",
        authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
        projectId: "YOUR_PROJECT_ID",
        storageBucket: "YOUR_PROJECT_ID.appspot.com",
        messagingSenderId: "YOUR_SENDER_ID",
        appId: "YOUR_APP_ID"
    };
    
    // Initialize Firebase
    const firebaseApp = firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function requestPermission() {
        Notification.requestPermission().then(permission => {;
            if (permission === "granted") {
                messaging.getToken({ vapidKey: "your-vapid-key" }).then((token) => {
                    console.log("FCM Token:", token);
                    saveToken(token);
                });
                denyNotifications();
            } else {
                console.log("Permission denied.");
            }
        }).catch(error => {
            console.error("Error getting permission:", error);
        });
    }

    // Send the token to your Laravel backend
    function saveToken(token)
    {
        fetch('/save-token', { //save-token
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ token: token })
        })
        .then(response => response.json())
        .then(data => document.querySelector(".flash_messages").innerHTML = SUCCESS_MESSAGE.replace("FLASH_MESSAGE", data.message))
        .catch(error => document.querySelector(".flash_messages").innerHTML = SUCCESS_MESSAGE.replace("FLASH_MESSAGE", data.error));;
    }

    // remove the token to your Laravel backend
    function removeToken(token)
    {
        fetch('/remove-token', { //save-token
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ token: token })
        })
        .then(response => response.json())
        .then(data => document.querySelector(".flash_messages").innerHTML = SUCCESS_MESSAGE.replace("FLASH_MESSAGE", data.message))
        .catch(error => document.querySelector(".flash_messages").innerHTML = SUCCESS_MESSAGE.replace("FLASH_MESSAGE", data.error));
    }

    function denyNotifications() {
        document.getElementById('pushNotificationPrompt').classList.add("hidden");
    }

    function unsubscribeUser() {
        navigator.serviceWorker.getRegistrations().then((registrations) => {
            for (let registration of registrations) {
                registration.unregister();
            }
        });
        removeToken();
    }
</script>