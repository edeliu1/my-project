(function () {
  const data = window.NEWS_DATA || [];
  const titleEl = document.getElementById("newsTitle");
  const shortEl = document.getElementById("newsShort");
  const timeEl = document.getElementById("newsTime");
  const readMoreEl = document.getElementById("newsReadMore");
  const dotsWrap = document.getElementById("newsDots");

  if (!titleEl || !shortEl || !readMoreEl || !dotsWrap) return;

  let i = 0;
  let timer = null;

  function renderDots() {
    dotsWrap.innerHTML = "";
    data.forEach((_, idx) => {
      const b = document.createElement("button");
      b.type = "button";
      b.className = "news-dot-btn" + (idx === i ? " active" : "");
      b.addEventListener("click", () => {
        i = idx;
        show();
        restart();
      });
      dotsWrap.appendChild(b);
    });
  }

  function show() {
    if (!data.length) {
      titleEl.textContent = "No news yet";
      shortEl.textContent = "Please add news in admin panel.";
      readMoreEl.href = "#";
      timeEl.textContent = "";
      dotsWrap.innerHTML = "";
      return;
    }

    const n = data[i];
    titleEl.textContent = n.title;
    shortEl.textContent = n.short;
    timeEl.textContent = n.date ? n.date : "";
    readMoreEl.href = "news_view.php?id=" + n.id;

    [...dotsWrap.querySelectorAll(".news-dot-btn")].forEach((d, idx) => {
      d.classList.toggle("active", idx === i);
    });
  }

  function next() {
    if (!data.length) return;
    i = (i + 1) % data.length;
    show();
  }

  function restart() {
    if (timer) clearInterval(timer);
    timer = setInterval(next, 10000); 
  }

  renderDots();
  show();
  restart();
})();
