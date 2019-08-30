//Rotina para impedir mais de um clique em formulários
function submitLock() {
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert('Você já clicou! Aguarde por favor.');
        return false;
    }
}

//Rotina para tratar mensagem de retorno positivo
$(document).ready(function() {
    $('#return_message_btn').click(function() {
        $('#return_message').fadeOut('slow');
        return false;
    });
});

//Mensagem para erro ao logar no sistema.
$().ready(function() {
	setTimeout(function () {
		$('.return_message').fadeOut('slow');
	}, 2500);
});

//Rotina para fazer logo e links do welcome surgirem devagar
$().ready(function() {
	setTimeout(function () {
		$('#logo_welcome').fadeIn('slow');
	}, 1500);
});

$().ready(function() {
	setTimeout(function () {
		$('#logo_links').fadeIn('slow');
	}, 2500);
});
