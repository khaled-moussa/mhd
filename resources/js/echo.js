import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "770cffc9955e7375af84",
    cluster: "eu",
    encrypted: false,
});
