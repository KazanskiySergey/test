$(document).ready(function(){
	$("#bday").keyup(function(e) {
		let val = $("#bday").val();		
		$("#bday").val(val.replace(/[^0-9\.]/g, ''));
		
		if( e.keyCode != 8 ){
			if( val.match(/^[0-9]{2}$|^[0-9]{2}.[0-9]{2}$/g ) ){
				$("#bday").val(val + '.');				
			}				
		}
		
		if( val.match(/[0-9]{5}$/g ) ){			
			$("#bday").val(val.replace(/[0-9]{1}$/g, '' ));
		}
	});
	
	$("form").submit(function() {
		let f_name = $(this).attr("id");
		let m = "";
		if(f_name == 'reg'){			
			if( !$("#exampleInputEmail2").val().match( /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g ) ){
				m += "email err \n";
			}	
			if( !$("#bday").val().match(/^[0-9]{2}.[0-9]{2}.[0-9]{4}$/g ) ){
				m += "date err - format: dd.mm.hh \n";
			}
			if( !$("#exampleInputPassword2").val().match( /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[а-я])(?=.*[А-Я])[0-9а-яА-Я!@#$%^&*]{12,}/g ) ){
				m += "pass err - test: 123ФФфф!@#$%^&* \n";
			}
			if( !$("#exampleInputPassword3").val().match( /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[а-я])(?=.*[А-Я])[0-9а-яА-Я!@#$%^&*]{12,}/g ) ){
				m += "pass2 err\n";
			}
			//message
			if(m != ""){
				alert(m);
				return false;
			}
			
		} else {
			
		}
		
	});
});