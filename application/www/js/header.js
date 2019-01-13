'use strict';

$('header li a').on("mouseenter",onHeaderNavEnter);
$('header li a').on("mouseleave",onHeaderNavLeave);

function onHeaderNavEnter() {
    //console.log(this);
//console.log($(this).parent());
var i_ap = $('<i>').attr("class","fas fa-beer");
var i_pre = $('<i>').attr("class","fas fa-beer");
$(this).prepend(i_pre).append(i_ap);
//$(this).append(i);
}
function onHeaderNavLeave() {
    $(this).children().remove();
}
// When the user scrolls the page, execute myFunction

window.onscroll = function() {headerSticky()};

// Get the navbar
//var topNav = document.querySelector('.header-top');
var bottomNav = document.querySelector('.header-bottom');
//var logo = document.querySelector('header .logo');
var topLogoNav = $('.top-header-logo');
var bottomLogoNav = $('.bottom-header-logo');
var backgroundNav = $('.header-bottom .background-nav')
var menuNav = $('.header-bottom .menu-nav')
var ulMenuNav = $('.header-bottom .menu-nav ul')
var aNav = $('.header-bottom .menu-nav a')
var sticky = bottomNav.offsetTop;

function headerSticky() {
    if (window.pageYOffset >= sticky) {

        $('.li-logo').remove();

        var li = $('<li>').attr("class","li-logo");
        var a = $('<a>').attr("href", getRequestUrl());
        var img = $('<img>').attr("class","bottom-header-logo").attr("src",getWwwUrl() + "/images/site/logo.png");
        li.append(a);
        a.append(img);
        ulMenuNav.prepend(li);

        aNav.css("padding","1.5rem");
        menuNav.css("grid-row","2 / span 1");
        menuNav.css("grid-column","2 / span 3");
        backgroundNav.css("grid-row","1 / span 3");

        topLogoNav.hide();
        bottomNav.classList.add("sticky");
        $('header').attr("class","headerIsSticky");

  } else {
        bottomLogoNav.hide();
        topLogoNav.show();

        $('.li-logo').remove();
        aNav.css("padding","3rem 1rem");
        menuNav.css("grid-row","3 / span 1");
        menuNav.css("grid-column","3 / span 2");
        backgroundNav.css("grid-row","1 / span 5");

        bottomNav.classList.remove("sticky");
        $('header').removeClass("headerIsSticky");


  }
}
