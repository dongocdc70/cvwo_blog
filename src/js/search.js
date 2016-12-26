$(document).ready(function() {
	$('#search-box').keyup(function(event) {
		if($('#search-box').val()) {
			$('#preload').hide();
			$('#loading-gif').show();
			$.ajax({
				url: 'search.php',
				data: {q: $('#search-box').val()}
			})
			.done(function(response) {
				console.log(response);
			})
			.fail(function() {
				console.log("error");
			});
		}
		else {
			$('#preload').show();
			$('#result').html('<img class="center-block" id="loading-gif" src="img/loader.gif" alt="loading" style="padding-top: 20px; display: none">');
		}

	});


});
