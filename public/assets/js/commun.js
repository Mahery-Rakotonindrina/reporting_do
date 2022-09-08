$(document).ready(function() {
    $('#sidebarCollapse').on('click', function() {
        $('#sidebar').toggleClass('active');
    });
	
	$(document).on('click', '.btn-export',function(){
		if($('.menu_viapost').hasClass('active')){
			var value = $('.active').attr('data-menu');
			var URL = base_url()+"Export/"+value;

			window.location.replace(URL);
		}
		
	})

	$(document).on('change', '#datepicker1', function(){
		change_date1();
	})

	$(document).on('change', '#datepicker2', function(){
		change_date();
	})

});

function reset_input_date_deb(){
	if($('#datepicker1').val() == ""){
		var date_deb = $('#datepicker1').attr('data-datedeb');
		$('#datepicker1').val(date_deb);
	}
}

function reset_input_date_fin(){
	if($('#datepicker2').val() == ""){
		var date_fin = $('#datepicker2').attr('data-datefin');
		$('#datepicker2').val(date_fin);
	}
}

function change_date(){
	var date_debut = $('#datepicker1').val().split('/');
	var date_fin = $('#datepicker2').val().split('/');

	var debut = new Date(date_debut[2], date_debut[1] - 1, date_debut[0]);
	var fin = new Date(date_fin[2], date_fin[1] - 1, date_fin[0]);
	
	if(fin < debut){
		$('#datepicker1').val($('#datepicker2').val())
	}
}

function change_date1(){
	var date_debut = $('#datepicker1').val().split('/');
	var date_fin = $('#datepicker2').val().split('/');

	var debut = new Date(date_debut[2], date_debut[1] - 1, date_debut[0]);
	var fin = new Date(date_fin[2], date_fin[1] - 1, date_fin[0]);
	
	if(debut > fin){
		$('#datepicker2').val($('#datepicker1').val())
	}
}


function base_url(){
    var url = $('.base_url').val();
    return url;
}
