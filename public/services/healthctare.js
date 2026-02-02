document.addEventListener("DOMContentLoaded",() => {
    const card = document.querySelectorAll(".health-card");

    cards.forEach((card, index) => {
        card.style.opacity = "0";
        card.style.transform = "translateY(15px)";
        card.style.transition = "opacity .4s ease, transform .4s ease";

        setTimeout(() => {
            card.style.opacity = "1";
            card.style.transform = "translateY(0)";
        }, 120 + index * 120);
    });    
});