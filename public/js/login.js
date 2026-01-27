const form = document.querySelector("form");
const errorBox = document.getElementById("error");

form.addEventListener("submit",function (e) {
    e.preventDefault()

    const email =
    form.querySelector("input[name='email']").value.trim();

    const password =
    form.querySelector("input[name='password']").value.trim();

    errorBox.textContent="";
    
    if(!email || !password) {
        errorBox.textContent = "Please fill in all fields.";
        return;
    }

    if (!email.includes("@")) {
        errorBox.textContent = "Invalid email format.";
        return;
        
    }

    if (password.length<6) {
        errorBox.textContent= "Invalid email format.";
        return;
        
    }

    localStorage.setItem("userEmail", email);
    alert("Login successful (demo)");
    form.reset();
});
