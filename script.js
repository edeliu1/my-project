const lajmet = [
  {
    titulli: "Road Infrastructure Update",
    pershkrimi: "Road reconstruction has started in the city center. Completion expected in March 2025."
  },
  {
    titulli: "New School Renovation",
    pershkrimi: "Dardania School renovation includes new classrooms and digital equipment."
  },
  {
    titulli: "Train Schedule Changes",
    pershkrimi: "Train schedules for Prishtina–Fushe Kosova have been updated."
  }
];

const newsGrid = document.querySelector(".news-grid");

if(newsGrid){
  lajmet.forEach(lajm => {
    const kartela = document.createElement("div");
    kartela.classList.add("news-card");

    kartela.innerHTML = `
      <h3>${lajm.titulli}</h3>
      <p>${lajm.pershkrimi}</p>
    `;

    newsGrid.appendChild(kartela);
  });
}

const aboutSection = document.querySelector("#about p");

if(aboutSection){
  aboutSection.textContent =
    "This Smart City Platform provides digital access to healthcare, education, transportation, and municipal services for the citizens of Fushe Kosova.";
}

const loginForm = document.querySelector("#loginForm");

if (loginForm) {
  loginForm.addEventListener("submit", e => {
    e.preventDefault();

    const email = loginForm.querySelector("input[type='email']").value;
    const password = loginForm.querySelector("input[type='password']").value;

    if (email && password.length >= 6) {
      alert("Login successful (demo)");
      localStorage.setItem("userEmail", email);
      loginForm.reset();
    } else {
      alert("Invalid login credentials");
    }
  });
}

document.querySelectorAll(".faq-item").forEach(h=> {
  item.style.cursor ="pointer";

  const p = item.querySelector("p");
  if(!p) return;

  p.style.display ="none";

  item.addEventListener("click", () => {
    p.style.display = p.style.display === "none" || p.style.display === "" ? "block" : "none";
  });
});

const contactForm = document.getElementById("contactForm");

if(contactForm){
  const alertBox = document.getElementById("contactError");

  contactForm.addEventListener("submit", e =>{
    e.preventDefault();

    const name = contactForm.querySelector("input[name='name']");
    const email = contactForm.querySelector("input[name='email']");
    const message = contactForm.querySelector("textarea[name='message']");

    const errors = [];

    if(!name.value.trim()) errors.push("Please enter your name.");
    if(!email.value.trim()) errors.push("Please enter your email.");

    if(email.value  
      && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)
    ){
      errors.push("Email format is not valid.");
    }

    if(!message.value.trim()) errors.push("Please write a message.");

    if(alertBox) alertBox.textContent = errors.join(" ");

    if(errors.length === 0){
      alert("Message sent successfully! (demo)");
      contactForm.reset();
      if(alertBox) alertBox.textContent = "";
    }
  });
}

function revealOnScroll(){
  document.querySelectorAll(".reveal").forEach(el => {
    const top = el.getBoundingClientRect().top;
    const winHeight = window.innerHeight;

    if(top < winHeight -  100){
      el.classList.add("active");
    }
  });
}

window.addEventListener("scroll", revealOnScroll);
revealOnScroll();

const slider = document.querySelector("[data-slider]");

if(slider){
  const cards = Array.from(slider.querySelectorAll(".slide-card"));
  const dotsWrap = slider.querySelector("[data-dots]");
  const prevBtn = slider.querySelector("[data-prev]");
  const nextBtn = slider.querySelector("[data-next]");

  let idx = 0;

  const renderDots = () => {
    if(!dotsWrap) return;
    dotsWrap.innerHTML = "";

    cards.forEach((_, i) => {
      const d = document.createElement("button");
      d.type = "button";
      d.className ="dot" + (i === idx ? " active" : "");

      d.addEventListener("click", () => {
        idx = i;
        update();
      });

      dotsWrap.appendChild(d);
    });
  };

  const update = () => {
    cards.forEach((card, i) => {
      card.style.display = i === idx ? "block" : "none";
    });
    renderDots();
  };

  prevBtn && prevBtn.addEventListener("click", () => {
    idx = (idx - 1 + cards.length) % cards.length;
    update();
  });

  nextBtn && nextBtn.addEventListener("click", () => {
    idx = (idx + 1) % cards.length;
    update();
  });

  setInterval(() => {
    idx = (idx + 1) % cards.length;
    update();
  }, 5000);

  update(); 
  
}