export default function initLanguageSwitcher() {
    const toggle = document.getElementById("language-toggle");
    const dropdown = document.getElementById("languages-dropdown");

    if (!toggle || !dropdown) return;

    toggle.addEventListener("click", (e) => {
        e.stopPropagation();

        dropdown.classList.toggle("opacity-0");
        dropdown.classList.toggle("pointer-events-none");
    });

    document.addEventListener("click", (e) => {
        if (!toggle.contains(e.target)) {
            dropdown.classList.add("opacity-0");
            dropdown.classList.add("pointer-events-none");
        }
    })
}