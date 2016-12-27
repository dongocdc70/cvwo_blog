$(document).ready(function() {
	var preload = $('#preload');
	$('#search-box').on('keyup keydown', function(event) {
		if($('#search-box').val()) {
			if(preload.length) {
				preload.hide();
			}

			$('#loading-gif').show();
			$.ajax({
				url: 'search.php',
				data: {q: $('#search-box').val()}
			})
			.done(function(response) {
				console.log("success");
				$('#result').html(response);
			})
			.fail(function() {
				console.log("error");
			});
			$('#page-title').html('Search results <a href="index.php" style="float: right;" class="btn btn-warning">Back to homepage</a>')
		}
		else {
			if(preload.length) {
				preload.show();
			}
			$('#result').html('<img class="center-block" id="loading-gif" src="img/loader.gif" alt="loading" style="padding-top: 20px; display: none">');
			$('#page-title').html('All posts');
		}

	});


});
