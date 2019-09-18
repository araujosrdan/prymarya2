<h2><a href="<?php echo BASEURL; ?>" class="" title="">Home</a> > CRUD via Modal</h2>
<hr />
<a href="#" data-toggle="modal" data-target="#new" class="btn btn-primary" title="Novo registro">
    <i class="fas fa-plus"></i>
    Novo resgistro
</a>
<!-- MODAL NOVO INICIO -->
<div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="NovoRegistro" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form method="POST" name="newUser">
                    <div class="form-group">
                        <p>Novo registro de usuário</p>
                        <label for="name">Nome:</label>
                        <input type="text" name="new_user_name" class="form-control" />
                        <label for="username">Email:</label>
                        <input type="email" name="new_user_email" class="form-control" />
                        <label for="age">Idade:</label>
                        <input type="text" name="new_user_age" class="form-control" />
                        <label for="pass">Senha:</label>
                        <input type="password" name="new_user_pass" class="form-control" />
                    </div>
                    <button type="button" class="btn btn-success" onclick="setNewUser()">Confirmar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- MODAL NOVO FIM -->
<hr />
<table class="table table-striped table-bordered" style="width: 100%;" id="tbUsuarios">
    <thead>
        <tr>
            <th class="header_treat">Código:</th>
            <th class="header_treat">Img:</th>
            <th class="header_treat">Email:</th>
            <th class="header_treat">Nome:</th>
            <th class="header_treat">Idade:</th>
            <th class="header_treat">Ativo:</th>
            <th class="header_treat" style="text-align:right">Opções</th>
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
                    <a href="#" data-toggle="modal" data-target="#image<?php echo $usu['id_usu']; ?>" class="btn btn-info" title="Editar imagem"><i class="fas fa-user"></i></a>
                    <a href="#" data-toggle="modal" data-target="#edit<?php echo $usu['id_usu']; ?>" class="btn btn-secondary" title="Editar registro"><i class="fas fa-edit"></i></a>
                    <a href="#" data-toggle="modal" data-target="#pass<?php echo $usu['id_usu']; ?>" class="btn btn-warning" title="Editar senha"><i class="fas fa-key"></i></a>
                    <button type="button" class="btn btn-danger" onclick="setDelUser(<?php echo $usu['id_usu']; ?>)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <!-- MODAL IMAGEM INICIO -->
        <div class="modal fade" id="image<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarRegistro" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="imagetUser" enctype="multipart/form-data">
                            <div class="form-group">
                                <p>Editar imagem de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" name="user_name" class="form-control" value="<?php echo $usu['name']; ?>" readonly />
                                <label for="image">Nova imagem:</label>
                                <input type="file" accept="image/*" name="user_image" class="form-control" />
                                <input type="hidden" name="id_usu" value="<?php echo $usu['id_usu']; ?>" />
                            </div>
                            <!-- <input type="submit" value="Confirmar" name="imageUserDone" class="btn btn-success" /> -->
                            <button type="button" class="btn btn-primary" onclick="setUserImg(<?php echo $usu['id_usu']; ?>)">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL IMAGEM FIM -->
        <!-- MODAL EDITAR INICIO -->
        <div class="modal fade" id="edit<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarRegistro" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="editUser">
                            <div class="form-group">
                                <p>Editar registro de usuário</p>
                                <label for="active">Ativo:</label>
                                <input type="radio" name="user_active" value="Y" class="user_active" <?php echo ($usu['active'] == "Y"?'checked="checked"':''); ?>> Sim
                                <input type="radio" name="user_active" value="N" class="user_active" <?php echo ($usu['active'] == "N"?'checked="checked"':''); ?>> Não
                                <br />
                                <label for="name">Nome:</label>
                                <input type="text" name="user_name" class="form-control" value="<?php echo $usu['name']; ?>" />
                                <label for="username">Email:</label>
                                <input type="email" name="user_email" class="form-control" value="<?php echo $usu['email']; ?>" />
                                <label for="age">Idade:</label>
                                <input type="text" name="user_age" class="form-control" value="<?php echo $usu['age']; ?>" />
                            </div>
                            <button type="button" class="btn btn-success" onclick="setEditUser(<?php echo $usu['id_usu']; ?>)">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR FIM -->
        <!-- MODAL NOVA SENHA INICIO -->
        <div class="modal fade" id="pass<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarSenha" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="passEdit">
                            <div class="form-group">
                                <p>Editar senha de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" readonly value="<?php echo $usu['name']; ?>" />
                                <input type="hidden" name="user_email_pass" value="<?php echo $usu['email']; ?>" />
                                <label for="pass">Nova senha:</label>
                                <input type="password" name="user_new_pass" class="form-control" />
                            </div>
                            <button type="button" class="btn btn-success" onclick="setNewPass(<?php echo $usu['id_usu']; ?>)">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL NOVA SENHA FIM -->
        <?php endforeach; ?>
    </tbody>
</table>
<hr />

<script type="text/javascript">
    $(document).ready( function () {
            $('#tbUsuarios').DataTable({
            "pageLength" : 10,
            "filter" : true,
            "deferRender" : true,
            "scrollY" : 500,
            "scrollCollapse" : true,
            "scroller" : true,
            "language": {
                "lengthMenu": "Mostrando _MENU_  registros por página",
                "zeroRecords": "Nada encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro disponível",
                "infoFiltered": "(filtrado de _MAX_ registros no total)"
            }
        });
    });

    function setNewUser(){
        var new_user_name = $('input[name="new_user_name"]').val();
        var new_user_email = $('input[name="new_user_email"]').val();
        var new_user_age = $('input[name="new_user_age"]').val();
        var new_user_pass = $('input[name="new_user_pass"]').val();

        if (new_user_name == "" || typeof(new_user_name) == "undefined") {
            $('input[name="new_user_name"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        if (new_user_email == "" || typeof(new_user_email) == "undefined") {
            $('input[name="new_user_email"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        if (new_user_age == "" || typeof(new_user_age) == "undefined") {
            $('input[name="new_user_age"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        if (new_user_pass == "" || typeof(new_user_pass) == "undefined") {
            $('input[name="new_user_pass"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        let items = new URLSearchParams();
        items.append("new_user_name", new_user_name);
        items.append("new_user_email", new_user_email);
        items.append("new_user_age", new_user_age);
        items.append("new_user_pass", new_user_pass);

        axios({
            method: "POST",
            url: "modal/setNewUser",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
				response = JSON.parse(data_return);
            
            if (response.code == "02") {
                $("#new").modal("hide");
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    location.reload();
                });                             
            } else if (response.code == "01") {
                iziToast.error({
                        title: 'Ops... ',
                        message: response.message
                });
                return false;
            } else {
                iziToast.error({
                        title: 'Ops... ',
                        message: "Ocorreu algum problema!"
                });
                return false;
            }

        }).catch(function(error){
            console.log(error);
        });

    }

    function setEditUser(id_usu){
        var user_active = document.querySelector('#edit' + id_usu +' .user_active:checked').value;
        var user_name = $('#edit' + id_usu +' input[name="user_name"]').val();
        var user_email = $('#edit' + id_usu +' input[name="user_email"]').val();
        var user_age = $('#edit' + id_usu +' input[name="user_age"]').val();
        
        if (user_name == "" || typeof(user_name) == "undefined") {
            $('input[name="user_name"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        if (user_email == "" || typeof(user_email) == "undefined") {
            $('input[name="user_email"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        if (user_age == "" || typeof(user_age) == "undefined") {
            $('input[name="user_age"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        }

        let items = new URLSearchParams();
        items.append("id_usu", id_usu);
        items.append("user_active", user_active);
        items.append("user_name", user_name);
        items.append("user_email", user_email);
        items.append("user_age", user_age);

        axios({
            method: "POST",
            url: "modal/setEditUser",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
				response = JSON.parse(data_return);
            
            if (response.code == "14") {
                $("#edit" + id_usu).modal("hide");
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    location.reload();
                });                             
            } else if (response.code == "13") {
                iziToast.error({
                        title: 'Ops... ',
                        message: response.message
                });
                return false;
            } else {
                iziToast.error({
                        title: 'Ops... ',
                        message: "Ocorreu algum problema!"
                });
                return false;
            }

        }).catch(function(error){
            console.log(error);
        });

    }

    function setNewPass(id_usu){
        var newpass_email = $('#pass' + id_usu +' input[name="user_email_pass"]').val();
        var user_new_pass_set = $('#pass' + id_usu +' input[name="user_new_pass"]').val();
        var newpass_pass = window.btoa(user_new_pass_set);
        
        if (user_new_pass_set == "" || typeof(user_new_pass_set) == "undefined") {
            $('#pass' + id_usu +' input[name="user_new_pass_set"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo SENHA é obrigatório!"
            });
            return false;
        }

        let items = new URLSearchParams();
        items.append("newpass_email", newpass_email);
        items.append("newpass_pass", newpass_pass);

        axios({
            method: "POST",
            url: "modal/setNewPass",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
                response = JSON.parse(data_return);
            
            if (response.code == "05") {
                $("#pass" + id_usu).modal("hide");
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    location.reload();
                });                             
            } else {
                iziToast.error({
                        title: 'Ops... ',
                        message: "Ocorreu algum problema!"
                });
                return false;
            }

        }).catch(function(error){
            console.log(error);
        });

    }

    function setUserImg(id_usu){
        var user_image = $('#image' + id_usu +' input[name="user_image"]')[0].files[0];
        
        if (user_image == "" || typeof(user_image) == "undefined") {
            $('#image' + id_usu +' input[name="user_image"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo IMAGEM é obrigatório!"
            });
            return false;
        } else {
            $("#loading_post").show();
        }

        var items = new FormData();
        items.append("id_usu", id_usu);
        items.append("user_image", user_image);

        axios({
            method: "POST",
            url: "modal/setUserImg",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
                response = JSON.parse(data_return);

            if (response.code == "17") {
                $("#image" + id_usu).hide();
                $("#loading_post").hide();
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    location.reload();
                }); 
            }

            if(response.code == "18"){
                $("#image" + id_usu).hide();
                $("#loading_post").hide();
                iziToast.error({
                    title: 'Ops... ',
                    message: response.message
                });
                return false;
            }

        }).catch(function(error){
            console.log(error);
        });


    }

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
