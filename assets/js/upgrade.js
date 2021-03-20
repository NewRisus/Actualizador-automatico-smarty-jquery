var upgrade = {
	smarty: function() {
		input = $("#smarty_install").serialize();
		console.log(input);
		$.ajax({
			type: 'POST',
			url: global.url + '/pages/ajax.php',
			data: input,
			beforeSend: function() {
				$(".btn.iniciar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Iniciando...');
			}
		}).done(function(r) {
			switch(r.charAt(0)) {
				case '0':
					location.href = r.substring(3);
				break;
				default:
					$("#upgrade").html(r);
					$("#hide").remove();
				break;
			}
		});
	},
	jquery: function() {
		setTimeout(function() {
			$('.hidden, .boxinfo').fadeToggle();
		}, 3000);
		input = $("#upgrade_js").serialize();
		$.ajax({
			type: 'POST',
			url: global.url + '/pages/ajax.php',
			data: input,
			beforeSend: function() {
				$(".btn.iniciar").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Iniciando...');
			}
		}).done(function(r) {
			switch(r.charAt(0)) {
				case '0':
					location.href = r.substring(3);
				break;
				default:
					setTimeout(function() {
						$("#upgrade").html(r);
						$("#hide").remove();
					}, 6000);
				break;
			}
		});
	}
}