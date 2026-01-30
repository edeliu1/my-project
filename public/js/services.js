document.addEventListener("DOMContentLoaded", () => {
  const cards = document.querySelectorAll(".service-card");

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          el.classList.add("is-visible");
          io.unobserve(el);
        }
      });
    },
    { threshold: 0.12 }
  );

  cards.forEach((card, idx) => {
    card.style.transitionDelay = `${idx * 60}ms`;
    io.observe(card);
  });

  const params = new URLSearchParams(window.location.search);
  const focus = (params.get("focus") || "").toLowerCase().trim();

  if (focus) {
    const match = Array.from(cards).find((c) => {
      const href = (c.getAttribute("href") || "").toLowerCase();
      return href.includes(focus);
    });

    if (match) {
      match.classList.add("is-focused");
      match.scrollIntoView({ behavior: "smooth", block: "center" });
      setTimeout(() => match.classList.remove("is-focused"), 1800);
    }
  }
});