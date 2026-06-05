function getUsername() {
    let username = localStorage.getItem("username");

    if (!username) {
        username = "Gebruiker" + Math.floor(1000 + Math.random() * 9000);
        localStorage.setItem("username", username);
    }

    return username;
}

function isValidUsername(username) {
    return /^[a-zA-Z0-9 _-]{1,20}$/.test(username);
}

document.addEventListener("DOMContentLoaded", function () {
    const nav = document.querySelector("nav .relative");

    if (!nav) {
        return;
    }

    const usernameBox = document.createElement("div");
    usernameBox.className = "absolute right-4 text-sm text-slate-700";

    usernameBox.innerHTML = `
        <span id="usernameText"></span>
        <button id="changeUsername" type="button" class="ml-2 rounded border border-slate-300 px-3 py-1 hover:bg-slate-100">
            Change
        </button>
    `;

    nav.appendChild(usernameBox);

    document.getElementById("usernameText").textContent = getUsername();

    document.getElementById("changeUsername").addEventListener("click", function () {
        const newUsername = prompt("Enter your new username:", getUsername());

        if (newUsername === null) {
            return;
        }

        const cleanUsername = newUsername.trim();

        if (!isValidUsername(cleanUsername)) {
            alert("Username must be 1-20 characters and can only contain letters, numbers, spaces, _ or -.");
            return;
        }

        localStorage.setItem("username", cleanUsername);
        document.getElementById("usernameText").textContent = cleanUsername;
    });
});