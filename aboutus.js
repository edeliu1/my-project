const sections =
document.querySelectorAll(".permbajtja");

const reveal = () => {
    const winH = window.innerHeight;
      
    sections.forEach((sec) => {
        const top = sec.getBoundingClientRect().top;
        if(top< winH - 120) {
            sec.classList.add("show");
        }
    });

};
