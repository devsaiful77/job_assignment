import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Load Pusher globally
window.Pusher = Pusher;

// Setup Echo
const echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

export default echo;
