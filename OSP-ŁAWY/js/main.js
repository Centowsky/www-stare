$(document).ready(function() {
	
	$('.carousel').each(function(){
        $(this).find('.carousel-item').eq(0).addClass('active');
      });

    $('.carousel').carousel({
        interval: 10000
      });

$(window).on('load',function(){
        $('#myModal').modal('show');
    });

    $('input[name="podpis"]').keypress(function() {
      if (this.value.length >= 20) {
          return false;
      }
  });

  $('textarea[name="wpis"]').keypress(function() {
    if (this.value.length >= 120) {
        return false;
    }
});
     
});