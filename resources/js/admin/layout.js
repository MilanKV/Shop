$(document).ready(function() {
  // Function to check if sidebar should be closed based on viewport width
  function checkSidebarState() {
    const windowWidth = $(window).width();
    const sidebar = $('.sidebar');
    const sidebarBtn = $('.bx-menu');

    if (windowWidth <= 1100 && !sidebar.hasClass('close')) {
      sidebar.addClass('close');
    } else if (windowWidth > 1100 && sidebar.hasClass('close') && !sidebarBtn.hasClass('clicked')) {
      sidebar.removeClass('close');
    }
  }

  // Initial check
  checkSidebarState();

  // Add click event listener to all elements with the class "arrow"
  $(".arrow").on("click", function() {
    // Select the main parent of the arrow
    const arrowParent = $(this).parent().parent();
    arrowParent.toggleClass("showMenu");
  });

  // Select the elements with the classes "sidebar" and "bx-menu"
  const sidebar = $(".sidebar");
  const sidebarBtn = $(".bx-menu");

  // Add click event listener to the menu icon
  sidebarBtn.on("click", function() {
    sidebar.toggleClass("close");
    sidebarBtn.toggleClass("clicked");
    checkSidebarState(); // Call the function to check sidebar state
  });

  // Add resize event listener to check sidebar state on window resize
  $(window).on('resize', function() {
    checkSidebarState();
  });
});