function toggleForm() {
    const formTitle = document.getElementById("formTitle");
    const authForm = document.getElementById("authForm");
    const submitBtn = document.getElementById("submitBtn");

    if (formTitle.textContent === "Login") {
        formTitle.textContent = "Register";
        authForm.action = "register.php"; 
        submitBtn.textContent = "Register"; 
    } else {
        formTitle.textContent = "Login";
        authForm.action = "login.php"; 
        submitBtn.textContent = "Login"; 
    }
}
