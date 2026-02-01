document.addEventListener("DOMContentLoaded", () => {

    const cards = document.querySelectorAll(".karta");
  const io = new IntersectionObserver((entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        e.target.classList.add("is-visible");
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });

    cards.forEach((c) => io.observe(c));

    const btns = document.querySelectorAll(".link-btn");
  btns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const sel = btn.getAttribute("data-target");
      const el = sel ? document.querySelector(sel) : null;
      if (!el) return;

      el.scrollIntoView({ behavior: "smooth", block: "center" });
      el.classList.add("is-focused");
      setTimeout(() => el.classList.remove("is-focused"), 1400);
    });
  });
});