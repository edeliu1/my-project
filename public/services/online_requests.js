function filterRequests(){
  const q = (document.getElementById("q").value || "").toLowerCase();
  document.querySelectorAll(".karta .item").forEach(i => {
    i.style.display = i.innerText.toLowerCase().includes(q) ? "" : "none";
  });
}

document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".karta");
  const io = new IntersectionObserver(entries => {
    entries.forEach(x => {
      if (x.isIntersecting){
        x.target.classList.add("is-visible");
        io.unobserve(x.target);
      }
    });
  }, {threshold: .12});
  cards.forEach(c => io.observe(c));

  document.querySelectorAll(".link-btn").forEach(b => {
    b.onclick = () => {
      const t = document.querySelector(b.dataset.target);
      if(!t) return;

      t.scrollIntoView({behavior:"smooth", block:"center"});
      t.classList.add("is-focused");
      setTimeout(() => t.classList.remove("is-focused"), 1400);
    };
  });
});
