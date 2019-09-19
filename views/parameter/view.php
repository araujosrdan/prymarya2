<h2><a href="<?php echo BASEURL; ?>" class="" title="">Home</a> > CRUD via PARÂMETRO</h2>
<hr />
<a href="<?php echo BASEURL; ?>parameter/new" class="btn btn-primary" title="Novo registro">
    <i class="fas fa-plus"></i>
    Novo resgistro
</a>
<hr />
<table class="table table-striped table-bordered" style="width: 100%;" id="tbUsuarios">
    <thead>
        <tr>
            <td class="header_treat">Código:</td>
            <td class="header_treat">Img:</td>
            <td class="header_treat">Email:</td>
            <td class="header_treat">Nome:</td>
            <td class="header_treat">Idade:</td>
            <td class="header_treat">Ativo:</td>
            <td class="header_treat" style="text-align:right">Opções</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $usu): ?>
            <tr>
                <td><?php echo $usu['cod_usu']; ?></td>
                <?php if($usu['image'] != ''): ?>
                  <td align="center"><img src="<?php echo BASEURL; ?>media/user/<?php echo $usu['id_usu']; ?>/<?php echo $usu['image']; ?>" class="img-thumbail" style="height:3rem;width:3rem;" /> </td>
                <?php else: ?>
                  <td title="Sem imagem disponível" align="center"><i class="fas fa-portrait"></i></td>
                <?php endif; ?>
                <td><?php echo $usu['email']; ?></td>
                <td><?php echo $usu['name']; ?></td>
                <td><?php echo $usu['age']; ?></td>
                <?php if($usu['active'] == "Y"): ?>
                  <td>Sim</td>
                <?php else: ?>
                  <td>Não</td>
                <?php endif; ?>
                <td style="text-align:right">
                    <a href="<?php echo BASEURL; ?>parameter/image/?id=<?php echo $usu['id_usu']; ?>" class="btn btn-info" title="Editar imagem"><i class="fas fa-user"></i></a>
                    <a href="<?php echo BASEURL; ?>parameter/edit/?id=<?php echo $usu['id_usu']; ?>" class="btn btn-secondary" title="Editar registro"><i class="fas fa-edit"></i></a>
                    <button type="button" class="btn btn-danger" onclick="setDelUser(<?php echo $usu['id_usu']; ?>)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<hr />

<script type="text/javascript">
    $(document).ready(function() {
        $('#tbUsuarios').DataTable({
            "language": {
                "lengthMenu": "Mostrando _MENU_ registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });

    function setDelUser(id_usu){
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: "Deletar",
            message: 'Quer mesmo deletar este registro? Este processo não tem volta!',
            position: 'center',
            buttons: [
                ['<button>Sim, por favor!</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    let items = new URLSearchParams();
                    items.append("id_usu", id_usu);

                    axios({
                        method: "POST",
                        url: "modal/setDelUser",
                        data: items
                    }).then(res => {
                        var data_return = JSON.stringify(res.data);
                            response = JSON.parse(data_return);

                        if (response.code == "16") {
                            Swal.fire({
                                type: "success",
                                text: response.message
                            }).then(() => {
                                location.reload();
                            });    
                        }

                        if (response.code == "15") {
                            window.location.href = "welcome";   
                        }

                    }).catch(function(error){
                        console.log(error);
                    });

                }, true],
                ['<button><b>Não! Mudei de ideia.</b></button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    iziToast.info({
                        title: 'Ok! ',
                        message: "Registro mantido!"
                    });
                    return false;

                }],
            ]
        });
    }
</script>
