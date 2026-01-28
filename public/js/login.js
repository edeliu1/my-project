document.addEventListener("DOMContentLoaded", () => {
    const kutia = document.querySelector(".hyrja-wrapper");

    if (kutia) {
        kutia.style.opacity = "0";
        kutia.style.transform = "translateY(20px)";
        kutia.style.transition = "0.6s ease";

        requestAnimationFrame(() => {
            kutia.style.opacity = "1";
            kutia.style.transform = "translateY(0)";
        });
    }
});
