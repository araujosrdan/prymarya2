//Carregando Datatables
$(document).ready(function() {
	function loadUserTable(){
        $('#tbUsuarios').DataTable({
            "pageLength" : 10,
            "filter" : true,
            "deferRender" : true,
            "scrollY" : 200,
            "scrollCollapse" : true,
            "scroller" : true,
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    }
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
