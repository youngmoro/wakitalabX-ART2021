$('#view-more-img').on('click', function () {
  $('.hidden-img').stop().fadeToggle(300);
  $('#view-more-img .text-less').stop().fadeToggle(300);
  $('#view-more-img .text-more').stop().fadeToggle(300);
});

$('#view-more-note').on('click', function () {
  $('.hidden-note').stop().fadeToggle(300);
  $('#view-more-note .text-less').stop().fadeToggle(300);
  $('#view-more-note .text-more').stop().fadeToggle(300);
});