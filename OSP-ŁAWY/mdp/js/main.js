$(document).ready(function() {

  $(window).on('load',function(){
    $('#myModal').modal('show');
});

$('input[name="podpis"]').keypress(function() {
  if (this.value.length >= 20) {
      return false;
  }
});

      $('.carousel').each(function(){
        $(this).find('.carousel-item').eq(0).addClass('active');
      });

    $('.carousel').carousel({
        interval: 10000
      });
     
});