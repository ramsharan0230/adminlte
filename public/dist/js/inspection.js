$( function() {
    $( ".datepicker" ).datepicker(
        { dateFormat: 'yy-mm-dd' }
    );
  } );

  $(".datepicker1").datepicker({ dateFormat: 'yy-mm-dd' }).datepicker("setDate", new Date());


  $('#accountibility1').change(function(){
    $('#accountibility').val($('#accountibility1').val())
  })

  $('#location_choose').change(function(){
    $('#location').val($('#location_choose').val())
  })

  $(document).ready(function() 
 {
    $('ul.suggestions li').click(function(e) { 
      $('#findings').val($(this).find("span.t").text())
    });
 });

 $(document).ready(function() 
 {
    $('ul.pca_suggestionAll li').click(function(e) { 
      $('#pca').val($(this).find("span.t").text())
    });
 });