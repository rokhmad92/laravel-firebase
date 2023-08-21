importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
firebase.initializeApp({
    apiKey: "api-key",
    authDomain: "project-id.firebaseapp.com",
    databaseURL: "https://project-id.firebaseio.com",
    projectId: "project-id",
    storageBucket: "project-id.appspot.com",
    messagingSenderId: "sender-id",
    appId: "app-id",
    measurementId: "G-measurement-id",
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

// messaging.onBackgroundMessage(function (payload) {
//     console.log(
//         "[firebase-messaging-sw.js] Received background message ",
//         payload
//     );
//     // Customize notification here
//     const notificationTitle = payload.data.title;
//     const notificationOptions = {
//         body: payload.data.body,
//         icon: "firebase.png",
//     };

//     self.registration.showNotification(notificationTitle, notificationOptions);
// });

messaging.setBackgroundMessageHandler(function ({
    data: { title, body, icon },
}) {
    return self.registration.showNotification(title, { body, icon });
});
