const button_create = document.getElementById("button_create");
const button_delete = document.getElementById("button_delete");
const button_update = document.getElementById("button_update");

let typeName = document.getElementById("type-name");
let description = document.getElementById("type-description");

var pageTitle = document.title;

function controlCreate() {
    let nameValue = typeName.value;
    let descValue = description.value;

    if ((descValue === "" || descValue.length > 20) || (nameValue === "" || nameValue.length > 20)) {
        button_create.disabled = true;
        button_create.style.border = "1px solid red";
    } else {
        button_create.disabled = false;
        button_create.style.border = "1px solid green";
    }
}

function controlUpdate() {
    let nameValue = document.getElementById("type-name").value;
    let descValue = document.getElementById("type-description").value;
    let nameToUpdateValue = document.getElementById("type-name-update").value;

    if ((descValue === "" || descValue.length > 20) || (nameValue === "" || nameValue.length > 20) || (nameToUpdateValue === "" || nameToUpdateValue.length > 20)) {
        button_update.disabled = true;
        button_update.style.border = "1px solid red";
    } else {
        button_update.disabled = false;
        button_update.style.border = "1px solid green";
    }
}


function controlDelete() {
    let nameValue = typeName.value;

    if (nameValue === "" || nameValue.length > 20) {
        button_delete.disabled = true;
        button_delete.style.border = "1px solid red";
    } else {
        button_delete.disabled = false;
        button_delete.style.border = "1px solid green";
    }
}

if (pageTitle === "Update") {
    console.log("Condition met!");
    let nameToUpdate = document.getElementById("type-name-update");

    typeName.addEventListener("input", controlUpdate);
    nameToUpdate.addEventListener("input", controlUpdate);
    description.addEventListener("input", controlUpdate);
}

if (pageTitle === "Create") {
    console.log("Condition met!");
    typeName.addEventListener("input", controlCreate);
    description.addEventListener("input", controlCreate);
}



if (pageTitle === "Delete") {
    typeName.addEventListener("input", controlDelete);
}