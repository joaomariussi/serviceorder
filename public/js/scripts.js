// script.js
document.addEventListener("DOMContentLoaded", function() {
    var openModal = document.getElementById("openModal");
    var modal = document.getElementById("myModal");
    var closeModal = document.getElementsByClassName("close")[0];

    openModal.addEventListener("click", function() {
        modal.style.display = "block";
    });

    closeModal.addEventListener("click", function() {
        modal.style.display = "none";
    });

    window.addEventListener("click", function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});
