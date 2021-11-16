/* ############### Scroll to Top ############### */
//Get the button:
var buttonToTop = document.getElementById("back_to_top_button");
	
// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    buttonToTop.style.display = "block";
  } else {
    buttonToTop.style.display = "none";
  }
}


// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

buttonToTop.addEventListener('click', topFunction);

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0; // For Safari
  document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

buttonToTop.addEventListener('click', topFunction);


/* ############### Sidebar Navigation ############### */
var OpenSideNav = document.getElementById("side_nav");
var CloseSidenav = document.getElementById("active-background");
var objRef = document.body;

/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "255px";
  document.getElementById("mySidenav").style.display = "flex";
  document.getElementById("mySidenav").style.zIndex = "10000001";
  var element = document.getElementById("active-background");
  
  objRef.style.overflow = "hidden";
  element.classList.add("active-navigation-background");
}

OpenSideNav.addEventListener('click', openNav);

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "-255px";
  document.getElementById("mySidenav").style.display = "none";
  document.body.style.backgroundColor = "white";
  document.getElementById("mySidenav").style.zIndex = "0";
  objRef.style.overflow = "visible";
  var element = document.getElementById("active-background");
  element.classList.remove("active-navigation-background");
}

CloseSidenav.addEventListener('click', closeNav);

