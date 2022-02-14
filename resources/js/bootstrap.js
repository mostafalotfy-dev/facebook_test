try {
    require('bootstrap');
} catch (e) {}
import { initializeApp } from 'firebase/app';
// Import the functions you need from the SDKs you need
import { getMessaging, getToken,onMessage} from "firebase/messaging";

import { onBackgroundMessage } from "firebase/messaging/sw";
// require("tagify").default;
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
  apiKey: "AIzaSyBSk3LgElUbTTXTucsMKlJuENmpdZ4hPIs",
  authDomain: "laravel-fac5d.firebaseapp.com",
  projectId: "laravel-fac5d",
  storageBucket: "laravel-fac5d.appspot.com",
  messagingSenderId: "586267524767",
  appId: "1:586267524767:web:2e47b6b6adef23769a6caa",
  measurementId: "G-KWPF094PX4"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging();
getToken(messaging,"BAPFpF5lJIwfdCeqhItdwNA1r8YSo5-Y9cGB6EzkQyDSHGYnlmvL5zVoWbjcUvTVXmAVFLSOU5oilI6-NRz9CUo")
.then(function(token){
  if(token)
  {

  }else{

  }
})
onMessage(messaging,(payload)=>{

})


onBackgroundMessage(messaging, (payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const notificationTitle = 'Background Message Title';
  const notificationOptions = {
    body: 'Background Message body.',
    icon: '/firebase-logo.png'
  };

  self.registration.showNotification(notificationTitle,
    notificationOptions);
});
// $(".tagify").tagify();