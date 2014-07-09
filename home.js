$(document).ready(function(){
                  var month_number = document.URL.match(/[0-9]+(?=.)/);
                  var panel_number = (month_number==null) ? 0 : panel_number = $('#months h3').length-parseInt(month_number);
                  
                  $('#months').accordion({active:panel_number});
});

$('.problemlink').click();
