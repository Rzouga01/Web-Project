// Create Page
const button = document.getElementById("button");

function control() {
    let name = document.getElementById("type-name").value;
    let desc = document.getElementById("type-description").value;

    if ((name.length > 20 || name.length <= 0) || (desc.length > 20 || desc.length <= 0)) {
        button.disabled = true;
        button.style.border = "1px solid red";

    } else {
        button.disabled = false;
        button.style.border = "";
    }
}

control();
