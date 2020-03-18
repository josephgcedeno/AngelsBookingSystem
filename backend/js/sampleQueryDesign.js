

$(document).ready(function(){


	$('button#sbtn').on('click',function(){
	
		var orig=$('button#sbtn').text();
		if (orig=='Show pictures')
		{
			$('div#content').fadeIn(500);
			$('button#sbtn').text('Hide pictures');
		}
		else
		{
			$('div#content').fadeOut(500);
			$('button#sbtn').text('Show pictures');
		}

	
	});

	$('#uploadbtn').on('click',function(){

		var orig=$('button#uploadbtn').text();
		if (orig=='Upload File click here')
		{
			$('div.uploadContent').fadeIn(0);
			$('button#uploadbtn').text('Hide upload');
		}
		else
		{
			$('div.uploadContent').fadeOut(0);
			$('button#uploadbtn').text('Upload File click here');
		}

	});

	$('#showAcc').on('click',function(){


		var orig=$('button#showAcc').text();
		if (orig=='Show Accounts')
		{
			$('#example').fadeIn(500);
			$('#showAcc').text('Hide Accounts');
		}
		else
		{
			$('#example').fadeOut(500);
			$('#showAcc').text('Show Accounts');
		}

	});



	$('input#updatorValues').on('click',function(){
		alert("s");
		$('#updatorValues').val("Done");
	});











	$('div.uploadContent').hide();
	$('div#content').hide();
	$('table#example').hide();

});