function filterEducation(){
  const q=(document.getElementById("q").value||"").toLowerCase();
  document.querySelectorAll(".karta .item").forEach(i=>{
    i.style.display=i.innerText.toLowerCase().includes(q)?"":"none";
  });
}
