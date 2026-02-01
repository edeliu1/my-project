document.addEventListener("DOMContentLoaded", () => {
  const data = window.NEWS_DATA || [];
  if (!Array.isArray(data) || data.length === 0) return;

  const titleEl = document.getElementById("newsTitle");
  const shortEl = document.getElementById("newsShort");
  const timeEl = document.getElementById("newsTime");
  const readMoreEl = document.getElementById("newsReadMore");
  const dotsEl = document.getElementById("newsDots");

  let current = 0;
  let timer = null;

  function renderDots() {
    if (!dotsEl) return;
    dotsEl.innerHTML = "";
    data.forEach((_, i) => {
      const b = document.createElement("button");
      b.type = "button";
      b.className = "dot" + (i === current ? " active" : "");
      b.addEventListener("click", () => {
        current = i;
        render();
        restart();
      });
      dotsEl.appendChild(b);
    });
  }

  function render() {
    const n = data[current];
    if (!n) return;

    if (titleEl) titleEl.textContent = n.title || "";
    if (shortEl) shortEl.textContent = n.short || "";
    if (timeEl) timeEl.textContent = n.date ? String(n.date) : "";
    if (readMoreEl) readMoreEl.href = "news.php?id=" + n.id;

    renderDots();
  }

  function next() {
    current = (current + 1) % data.length;
    render();
  }

  function restart() {
    if (timer) clearInterval(timer);
    timer = setInterval(next, 10000); 
  }

  render();
  restart();
});

