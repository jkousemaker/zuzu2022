const warningButton = document.querySelector(".exit-button");
const warningWrapper = document.querySelector(".warning-wrapper");

if(warningButton) {
    warningButton.addEventListener('click', function () {
        warningWrapper.classList.add("hidden");
    })
}

console.log("js loaded");