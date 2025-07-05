function showFlashMessage(message, type = "success") {
    const flash = document.getElementById("flash-message");
    const icon = document.getElementById("flash-icon");
    const text = document.getElementById("flash-text");

    // Reset class
    flash.className =
        "fixed top-4 right-4 max-w-sm flex items-start gap-3 px-4 py-3 rounded-lg shadow-lg transition-opacity duration-300 ease-in-out z-[9999]";

    // Set icon SVG & background
    let bgColor, svg;
    switch (type) {
        case "success":
            bgColor = "bg-green-500";
            svg = `<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                    d="M5 13l4 4L19 7" /></svg>`;
            break;
        case "error":
            bgColor = "bg-red-500";
            svg = `<svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12" /></svg>`;
            break;
        case "warning":
            bgColor = "bg-yellow-500 text-black";
            svg = `<svg class="w-3 h-3 text-black" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M4.93 19.07l14.14-14.14" /></svg>`;
            break;
        default:
            bgColor = "bg-gray-600";
            svg = "";
    }

    flash.classList.add(bgColor, "opacity-100");
    icon.innerHTML = svg;
    text.textContent = message;

    // Tampilkan
    flash.classList.remove("hidden");

    // Auto hide
    setTimeout(() => {
        flash.classList.add("opacity-0");
        setTimeout(() => flash.classList.add("hidden"), 300); // tunggu animasi selesai
    }, 5000);
}
