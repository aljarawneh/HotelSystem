// Variables
const themeBtn = document.querySelector("#themeBtn");
let darkMode = document.cookie.includes("theme=true") || true;

themeBtn.onclick = () => {
	console.log(darkMode);
	if (darkMode) {
		// Dark Mode setting
		document.body.setAttribute("data-bs-theme", "light");
		document.querySelector(".navbar-brand").src = "../images/logo-dark.png";
		// Theme swap to dark mode
		document.querySelectorAll(".bg-dark").forEach((element) => {
			element.classList.replace("bg-dark", "bg-light");
		});
		document.querySelectorAll(".text-bg-light").forEach((element) => {
			element.classList.replace("text-bg-light", "text-bg-dark");
		});
		// Change Scrollbar
	} else {
		// Light mode setting
		document.body.setAttribute("data-bs-theme", "dark");
		document.querySelector(".navbar-brand").src = "../images/logo-light.png";
		// Theme swap to light mode
		document.querySelectorAll(".bg-light").forEach((element) => {
			element.classList.replace("bg-light", "bg-dark");
		});
		document.querySelectorAll(".text-bg-dark").forEach((element) => {
			element.classList.replace("text-bg-dark", "text-bg-light");
		});
	}

	// Change type
	darkMode = !darkMode;
};
