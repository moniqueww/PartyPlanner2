$(function() {
  $('#encolheMenu').on('click', function(){
	 /* $('#sidebar .list-unstyled > p').hide();
	  $('#sidebar .list-unstyled li span').hide();
	  $('#sidebar .list-unstyled li div').hide();
	  $('#sidebar .list-unstyled a.sidebar-evento').hide();*/
	  $('#sidebar').addClass('minimized');
	  $('#action-bar').addClass('minimized');
	  $( "#page" ).addClass('minimized');
	  $('#encolheMenu').hide();
	  $('#expandeMenu').fadeIn();
  });
  $('#expandeMenu').on('click', function(){
	  /*$('#sidebar .list-unstyled > p').fadeIn();
	  $('#sidebar .list-unstyled li span').fadeIn();
	  $('#sidebar .list-unstyled li div').fadeIn();
	  $('#sidebar .list-unstyled a.sidebar-evento').fadeIn();*/
	  $('#sidebar').removeClass('minimized');
	  $('#action-bar').removeClass('minimized');
	  $( "#page" ).removeClass('minimized');
	  $('#expandeMenu').hide();
	  $('#encolheMenu').fadeIn();
	});

  	$('#page').scroll(function() {    
  	    var scroll = $('#page').scrollTop();    
  	    if (scroll >= 100) {
            $('#background .navigation').addClass('dark-nav');
  	    } else {
  	        $('#background .navigation').removeClass('dark-nav');
  	    }
  	});
});