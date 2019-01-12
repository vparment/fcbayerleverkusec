'use strict';

// When the user scrolls the page, execute myFunction
window.onscroll = function() {myStickyFunction()};

// Get the navbar
var navbar = document.querySelector('header .background-nav');
//var logo = document.querySelector('header .logo');
var logo = document.querySelector('header .logo');
//var navbarMenu = document.querySelector('header .menu-nav');
// Get the offset position of the navbar
var sticky = navbar.offsetTop;

//var stickyMenu = navbarMenu.offsetTop;


 console.log(navbar);
 console.log(logo);
console.log(sticky);

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myStickyFunction() {
  if (window.pageYOffset >= sticky) {
     navbar.classList.add("sticky");
    // navbar.style.position ="absolute";
     $('header .background-nav').css("z-index",1000);
     logo.style.height="5rem";
     $('header .logo').css("grid-row","2/span 4");

     navbar.append(logo);
     //logo.classList.add("sticky-logo");

    //navbarMenu.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
    //logo.classList.remove("sticky-logo");

    //navbarMenu.classList.remove("sticky")

  }
}
