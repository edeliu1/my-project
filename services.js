document.querySelectorAll(".service-box").forEach((card,i)=>{
    card.style.opacity = "0";
    card.style.transform = "translateY(30px)";
    
    setTimeout(() => {
        card.style.transition = "0.5s ease";
        card.style.opacity = "1";
        card.style.transform = "translateY(0)";
    }, 150*i);
});