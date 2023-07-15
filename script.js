document.addEventListener("DOMContentLoaded", function() {
  var button = document.getElementById("toggleButton");

  // Initial button state
  var isOn = false;

  // Add click event listener
  button.addEventListener("click", function() {
    isOn = !isOn; // Toggle the state

    if (isOn) {
      button.innerHTML = "On";
      button.classList.remove("off");
      button.classList.add("on");
    } else {
      button.innerHTML = "Off";
      button.classList.remove("on");
      button.classList.add("off");
    }
  });
});

window.addEventListener('message', function(event) {
      var color = event.data;
      document.body.style.backgroundColor = color;
    });

 function openTheme() {
      var url = './theme.html'; 
      var newWindow = window.open(url, '_blank');
    }

