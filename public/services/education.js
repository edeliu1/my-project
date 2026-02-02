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
})