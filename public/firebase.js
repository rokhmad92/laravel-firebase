import { initializeApp } from "https://www.gstatic.com/firebasejs/10.2.0/firebase-app.js";
import {
    getMessaging,
    getToken,
    onMessage,
} from "https://www.gstatic.com/firebasejs/10.2.0/firebase-messaging.js";

const firebaseConfig = {
    apiKey: "AIzaSyCFT4FSzy85E81-oAdkxdVo8x_FOILJviE",
    authDomain: "laravel-crud-f8fe9.firebaseapp.com",
    projectId: "laravel-crud-f8fe9",
    storageBucket: "laravel-crud-f8fe9.appspot.com",
    messagingSenderId: "530274461941",
    appId: "1:530274461941:web:46bcc39a930840cc117dbc",
    databaseURL:
        "https://laravel-crud-f8fe9.asia-southeast2.firebasedatabase.app",
    measurementId: "G-0WB0ZLZLGS",
};

const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

// onMessage(messaging, (payload) => {
//     console.log("Pesan diterima:", payload);
//     // Menampilkan notifikasi
//     const notificationTitle = payload.notification.title;
//     const notificationOptions = {
//         body: payload.notification.body,
//         icon: "firebase.png",
//     };

//     // Tampilkan notifikasi
//     self.registration.showNotification(notificationTitle, notificationOptions);
// });

onMessage(messaging, ({ data: { body, title, icon } }) => {
    new Notification(title, { body, icon });
});

getToken(messaging).then(function (currentToken) {
    if (currentToken) {
        $("#form").submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/register",
                data: {
                    _token: csrfToken,
                    data: $(this).serialize(),
                    token: currentToken,
                },
                dataType: "json",
                success: function () {
                    window.location.href = "/";
                },
            });
        });
    } else {
        permission();
    }
});

// izin notif
function permission() {
    Notification.requestPermission().then((permission) => {
        if (permission === "granted") {
            console.log("Notification permission granted.");
        } else {
            console.log("Unable to get permission to notify.");
        }
    });
}
