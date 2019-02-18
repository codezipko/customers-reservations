$('document').ready(function(){
 var username_state = false;
 var choose_state = false;

$('#create_reservation').prop('disabled', true);

var date = new Date();
var dateToday = new Date(date.getFullYear(), date.getMonth(), date.getDate());
var dates = $("#pick_date").datepicker({
	defaultDate: "+1w",
	dateFormat: "yy-mm-dd",
	changeMonth: true,
    maxDate: "+2w",
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "datepicker" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});

 $('#username').on('blur', function(){
  var username = $('#username').val();
  if (username == '') {
  	username_state = false;
  	$('#username').css('border-color', 'red');
  	$('#choose_time').prop('disabled', true);
  	$('#pick_date').prop('disabled', true);
    $('#username').siblings("span").text('Nepamirškite įrašyti kliento vardo!');
    $('#username').on('blur', function() {
    	$('#username').css('border-color', '#ced4da');
    	$('#choose_time').prop('disabled', false);
    	$('#pick_date').prop('disabled', false);
    });
  	return;
  }
 	$.ajax({
	    url: 'createReservation',
	    type: 'post',
	    data: {
	    	'username_check' : 1,
	    	'username' : username,
    },
    success: function(response){
      	username_state = true;
	    if (response == 'have_discount' ) {
	      	$('#username').parent().removeClass();
	      	$('#username').parent().addClass("form_success");
	      	$('#username').siblings("span").text('Klientui priklauso 10% nuolaida!');
	    }else if (response == 'no_discount') {
	      	$('#username').parent().removeClass();
	      	$('#username').parent().addClass("form_error");
	      	$('#username').siblings("span").text('Nuolaidos suteikti nereikia.');
	    } else if ( response == 'no_user') {
	      	$('#username').parent().removeClass();
	      	$('#username').parent().addClass("form_error");
	      	$('#username').siblings("span").text('Kliento duomenų bazėje nėra.');
	    }
    }
  });
 }); 

 $('#choose_time').on('blur', function(){
  var choose_time = $('#choose_time').val();
  var pick_date = $('#pick_date').val();

  if (choose_time == '') {
  	choose_state = false;
  	return;
  }
  if(pick_date == '') {
  	$('#pick_date').css('border-color', 'red');
  	$('#choose_time').prop('disabled', true);
  	$('#choose_time').val('');
    $('#choose_time').siblings("span").text('Pirmiausia pasirinkite datą.');
    $('#pick_date').on('blur', function() {
    	$('#pick_date').css('border-color', '#ced4da');
    	$('#choose_time').prop('disabled', false);
    });
  } else {
  $.ajax({
    url: 'createReservation',
    type: 'post',
    data: {
    	'exists_date' : 1,
    	'pick_date' : pick_date,
    	'choose_time' : choose_time,
    },
    success: function(response){
      if (response == 'time_already_exists' ) {
      	choose_state = false;
      	$('#choose_time').parent().removeClass();
      	$('#choose_time').parent().addClass("form_error");
      	$('#choose_time').siblings("span").text('Rezervacijos data užimta arba pasibaigusi.');
      	$('#create_reservation').prop('disabled', true);
      }else if (response == 'time_free') {
      	choose_state = true;
      	$('#choose_time').parent().removeClass();
      	$('#choose_time').parent().addClass("form_error");
      	$('#choose_time').siblings("span").text('Data laisva.');
      	$('#create_reservation').prop('disabled', false);
      }
    }
  });
	}
 });

$('#create_reservation').on('click', function(){
 	var username = $('#username').val();
 	var phone = $('#phone').val();
 	var pick_date = $('#pick_date').val();
 	var choose_time = $('#choose_time').val();
 	if (choose_state == false || username_state == false) {
	  $('#error_msg').text('Forma užpildyta neteisingai.');
	} else {
      $.ajax({
      	url: 'createReservation',
      	type: 'post',
      	data: {
      		'save' : 1,
      		'username' : username,
      		'phone' : phone,
      		'pick_date' : pick_date,
      		'choose_time' : choose_time
      	},
      	success: function(response){
      		alert( username + ' Sėkmingai užregistruotas!');
      		location.reload();
      	}
      });
 	}
 });

});