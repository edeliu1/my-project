const sections = document.querySelectorAll(".permbajtja");

sections.forEach((sec) => sec.classList.add("reveal"));

function reveal() {
    const winH = window.innerHeight;
    sections.forEach((sec) => {
        const top = sec.getBoundingClientRect().top;
        if(top< winH - 120) {
            sec.classList.add("show");
        }
    });

};

window.addEventListener("scroll",reveal);
window.addEventListener("load",reveal);

