import Echo from "laravel-echo";
import Pusher from "pusher-js";

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});

window.listenRoomTyping = function (roomId, currentUserId) {
    let hideTimer = null;

    window.Echo.private(`room.${roomId}`).listenForWhisper("typing", (e) => {
        if (e.user_id === currentUserId) return;

        const indicator = document.getElementById("typing-indicator");
        if (!indicator) return;

        indicator.textContent = `✍️ ${e.name} está a escrever…`;
        indicator.classList.remove("hidden");

        clearTimeout(hideTimer);
        hideTimer = setTimeout(() => {
            indicator.classList.add("hidden");
        }, 2000);
    });
};
