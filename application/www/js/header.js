'use strict';

var liLogo = $('.li-logo');
var bottomNav = document.querySelector('.header-bottom');
var topLogoNav = $('.top-header-logo');
var backgroundNav = $('.header-bottom .background-nav');
var menuNav = $('.header-bottom .menu-nav');
var ulMenuNav = $('.header-bottom .menu-nav ul');
var aNav = $('.header-bottom .menu-nav a');

liLogo.hide();
window.onscroll = function() {headerSticky()};
var sticky = bottomNav.offsetTop;

function headerSticky() {
    if (window.pageYOffset >= sticky) {



        aNav.css("padding","1.5rem");
        menuNav.css("grid-row","2 / span 1");
        //menuNav.css("transition-duration","0.3s").css("transform","translate(2rem,-1.8rem)");
        backgroundNav.css("grid-row","1 / span 3");

        topLogoNav.hide();
        bottomNav.classList.add("sticky");
        $('header').attr("class","headerIsSticky");
        liLogo.show();

  } else {
        topLogoNav.show();

        liLogo.hide();

        aNav.css("padding","3rem 1rem");
        menuNav.css("grid-row","3 / span 1");
        //menuNav.css("transition-duration","0.3s").css("transform","translate(-1rem,0rem)");
        backgroundNav.css("grid-row","1 / span 5");

        bottomNav.classList.remove("sticky");
        $('header').removeClass("headerIsSticky");
  }
}
