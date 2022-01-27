
$('.owl-promo').owlCarousel({
  items: 3,
  margin: 10,
  nav: false,
  dots: true
});

$('.owl-product').owlCarousel({
  items: 3,
  margin: 10,
  nav: true,
  dots: true
});

$('.owl-partner').owlCarousel({
  items: 6,
  margin: 10,
  nav: true,
  dots: false,
  loop:true,
  autoplay:true,
  stagePadding:40
});

$('.btn-menu button').click(function(){
  $('nav.collapse').toggleClass('show');
})
