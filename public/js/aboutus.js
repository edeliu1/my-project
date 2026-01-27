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

Selections.forEach((sec) => sec.classList.add("reveal"));

window.addEventListener("scroll",reveal);
window.addEventListener("load",reveal);

const links = document.querySelectorAll(".main a");

const setActive =()=> {
    const winH = window.innerHeight;
    let current = null;

    sections.forEach((sec) => {
        const rect = sec.getBoundingClientRect();
        if(rect.top<=winH*0.35 &&rect.bottom >=winH*0.35) {
            current=sec;
        }
    });

 links.forEach((a) =>a.classList.remove("active"));

 if(current) {
    const title = current.quarySelector("h2")?.textContent?.toLowerCase() ||"";

    const aboutLink = Array.from(links).find((a) => a.getAttribute("href")?.includes("about.html"));
    if(aboutLink)aboutLink.classList.add("active");
  }
};  

window.addEventListener("scroll", setActive);
window.addEventListener("load",setActive);