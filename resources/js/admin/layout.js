// Select all elements with the class "arrow"
const arrows = document.querySelectorAll(".arrow");

// Add a click event listener to each arrow
arrows.forEach(arrow => {
  arrow.addEventListener("click", () => {
    // Select the main parent of the arrow
    const arrowParent = arrow.parentElement.parentElement;
    arrowParent.classList.toggle("showMenu");
  });
});

// Select the elements with the classes "sidebar" and "bx-menu"
const sidebar = document.querySelector(".sidebar");
const sidebarBtn = document.querySelector(".bx-menu");

// Add a click event listener to the menu icon
sidebarBtn.addEventListener("click", () => {
  sidebar.classList.toggle("close");
});