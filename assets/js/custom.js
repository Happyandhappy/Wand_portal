$(document).ready(function(){
	var message = $('#message').val();
	if (message !=='' && message != undefined){
		showSwal('basic', message);		
	}

	$('#loginform').submit(function(e){
		e.preventDefault();
		console.log("submitted");
		$.ajax({
			url : 'Controller.php',
			type : 'POST',
			data : $(this).serialize(),
			success : function(res){
				var data = JSON.parse(res);
				$('#alert').attr('class', 'alert alert-' + data.status);
				$('#alert').html('<i class="fa fa-exclamation-circle"></i>' + data.message);
				if (data.status == 'success') window.location = "signup.php";
			}
		});
	});

	$('#signupform').submit(function(e){
		e.preventDefault();
		console.log("submitted");
		$('#submit').prop('disabled', true);
		$.ajax({
			url : 'Controller.php',
			type : 'POST',
			data : $(this).serialize(),
			success : function(res){
				$('#submit').prop('disabled', false);
				var data = JSON.parse(res);
				$('#alert').attr('class', 'alert alert-' + data.status);
				$('#alert').html('<i class="fa fa-exclamation-circle"></i>' + data.message);
				if (data.status == 'success') {
					showSwal('auto-close','New lead added successfully!');
					setTimeout(function(){location.reload();}, 2500)
				}
			}
		});
	});

	// $('.convert').click(function(e){
	// 	e.preventDefault();
	// 	$.ajax({
	// 		url : 'Controller.php?action=convert&id=' + $(this).attr('href'),
	// 		success: function(res){
	// 			var data = JSON.parse(res);
	// 			if (data.status ==='danger') showSwal('basic',data.message);
	// 			else showSwal('auto-close','Lead converted successfully!');
	// 		}
	// 	});
	// })
});