
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


// require('./bootstrap');

// window.Vue = require('vue');



//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
//

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



//---------------------------------Untested Code Here---------------------------------//
window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');



import Echo from "laravel-echo";
const PUSHER_KEY = 'c905a8ead7147cafd9af';
const NOTIFICATION_TYPES = {
    User_Alert: 'App\\Notifications\\User_Alert'
};

window.Pusher = require('pusher-js');
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'a4dcf7e6ddf9370b0196',
    cluster: 'us2',
    encrypted: true
});
// import Echo from "laravel-echo";
// const PUSHER_KEY = 'c905a8ead7147cafd9af';
// const NOTIFICATION_TYPES = {
//     User_Alert: 'App\\Notifications\\User_Alert'
// };
//
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'a4dcf7e6ddf9370b0196',
//     cluster: 'us2',
//     encrypted: true
// });
// import Echo from "laravel-echo";
// const PUSHER_KEY = 'c905a8ead7147cafd9af';
// const NOTIFICATION_TYPES = {
//     User_Alert: 'App\\Notifications\\User_Alert'
// };
//
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'a4dcf7e6ddf9370b0196',
//     cluster: 'us2',
//     encrypted: true
// });
var notifications = [];


$(document).ready(function() {
    // check if there's a logged in
    console.log(Laravel.userId);
    if(Laravel.userId) {
        $.get('notifications', function (data) {
            // addNotifications(data, "#notifications");
            console.log("success");
        });
    }

    window.Echo.private(`App.User.${Laravel.userId}`)
        .notification((notification) => {
            // addNotifications([notification], '#notifications');
            console.log('success');
        });
});

//
// function addNotifications(newNotifications, target) {
//     notifications = _.concat(notifications, newNotifications);
//     // show only last 5 notifications
//     notifications.slice(0, 5);
//     showNotifications(notifications, target);
// }
//
// function showNotifications(notifications, target) {
//     if(notifications.length) {
//         var htmlElements = notifications.map(function (notification) {
//             return makeNotification(notification);
//         });
//         $(target + 'Menu').html(htmlElements.join(''));
//         $(target).addClass('has-notifications')
//     } else {
//         $(target + 'Menu').html('<li class="dropdown-header">No notifications</li>');
//         $(target).removeClass('has-notifications');
//     }
// }
//
// function makeNotification(notification) {
//     var to = routeNotification(notification);
//     var notificationText = makeNotificationText(notification);
//     return '<li><a href="' + to + '">' + notificationText + '</a></li>';
// }
//
// // get the notification route based on it's type
// function routeNotification(notification) {
//     var to = '?read=' + notification.id;
//     if(notification.type === NOTIFICATION_TYPES.follow) {
//         to = 'users' + to;
//     }
//     return '/' + to;
// }
//
// // get the notification text based on it's type
// function makeNotificationText(notification) {
//     var text = '';
//     if(notification.type === NOTIFICATION_TYPES.follow) {
//         const name = notification.data.follower_name;
//         text += '<strong>' + name + '</strong> followed you';
//     }
//     return text;
// }
// // // //-----------------------------END---------------------------------------//
//
