function filterEducation(){
  const q=(document.getElementById("q").value||"").toLowerCase();
  document.querySelectorAll(".karta .item").forEach(i=>{
    i.style.display=i.innerText.toLowerCase().includes(q)?"":"none";
  });
}

document.addEventListener("DOMContentLoaded",()=> {
    const cards=document.querySelectorAll(".karta");
    const io=new IntersectionObserver(e=>{
        e.forEach(x=>{
            if(x.islntersecting){
                x.target.classList.add("is-visible");
                io.unobserve(x.target);
            }
        });
    },{threshold:.12});
    cards.forEach(c=>io.observe(c));
 
document.querySelector(".link-btn").forEach(b=>{
    b.onclick=()=>{
        const t=document.querySelector(b.dataset.target);
        if(!t)return;

        t.scrollintoView({behavior:"smooth",block:"center"});
          t.classList.add("is-focused");
          setTimeout(()=>t.classList.remove("is-focused"),1400);
    };
});
});