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

const contactForm = document.querySelector("#contactForm");

if(contactForm){
  contactForm.addEventListener("submit", function(e){
    e.preventDefault();

    const inputs = contactForm.querySelectorAll("input, textarea");
    let valid = true;

    inputs.forEach(input => {
      if(input.value.trim() === ""){
        valid = false;
        input.style.borderColor = "red";
      } else {
        input.style.borderColor = "#bcd0ff";
      }
    });

    if(valid){
      alert("Message sent successfully!");
      contactForm.reset();
    } else {
      alert("Please fill in all fields.");
    }
  });
}

const loginForm = document.querySelector("#loginForm");

if(loginForm){
  loginForm.addEventListener("submit", function(e){
    e.preventDefault();

    const email = loginForm.querySelector("input[type='email']").value;
    const password = loginForm.querySelector("input[type='password']").value;

    if(email && password.length >= 6){
      alert("Login successful (demo)");
      localStorage.setItem("userEmail", email);
      loginForm.reset();
    } else {
      alert("Invalid login credentials");
    }
  });
}

const faqItems = document.querySelectorAll(".faq-item h3");

faqItems.forEach(item => {
  item.style.cursor = "pointer";

  item.addEventListener("click", () => {
    const p = item.nextElementSibling;
    p.style.display = p.style.display === "none" ? "block" : "none";
  });
});

const sections = document.querySelectorAll(".content-section");

const revealOnScroll = () => {
  const windowHeight = window.innerHeight;

  sections.forEach(section => {
    const top = section.getBoundingClientRect().top;

    if(top < windowHeight - 100){
      section.style.opacity = "1";
      section.style.transform = "translateY(0)";
    }
  });
};

window.addEventListener("scroll", revealOnScroll);
