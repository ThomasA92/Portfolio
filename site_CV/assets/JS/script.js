// Animate on Scroll

let $window = $(window);

$(document).ready(function () {});

$window.on("load", (function() { // sur le chargement de la page
  AOS.init();    
})); 

$window.on('scroll', function () { // Sur le scroll
   AOS.init();  
});

// Smooth scroll 
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
      });
  });
});

// Bouton retour en haut 

jQuery(document).ready(function() {
  
  let btn = $('#toTop');

  $(window).scroll(function() {
    if ($(window).scrollTop() > '10') {
      $('#toTop').show();
    } else {
      $('#toTop').hide();
    }
  });

  btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0},'300');
  });

});

// change l'ancre.

$('#maPage .navbar-nav a').on('click', function(e) {
  e.preventDefault();
  let anchor = $(this);                    
  window.scrollTo({top: $(anchor.attr('href')).offset().top - 120, behavior: 'smooth'});
 
  });