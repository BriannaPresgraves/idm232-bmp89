  // Function to clear all filters
  function clearFilters() {
    var buttons = document.querySelectorAll('.filterBtn');
    buttons.forEach(function(btn) {
      btn.classList.remove('activeFilter');
    });
    console.log("Filters cleared");
    window.location.href = 'index.php';
  }