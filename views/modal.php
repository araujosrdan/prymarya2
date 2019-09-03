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
                        <input type="text" id="new_user_name" name="new_user_name" class="form-control" />
                        <label for="username">Email:</label>
                        <input type="email" id="new_user_email" name="new_user_email" class="form-control" />
                        <label for="age">Idade:</label>
                        <input type="text" id="new_user_age" name="new_user_age" class="form-control" />
                        <label for="pass">Senha:</label>
                        <input type="password" id="new_user_pass" name="new_user_pass" class="form-control" />
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
<table class="table table-stripped table-bordered" style="width: 100%;" id="tbUsuarios">
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
                    <a href="#" data-toggle="modal" data-target="#del<?php echo $usu['id_usu']; ?>" class="btn btn-danger" title="Excluir registro"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
        <!-- MODAL IMAGEM INICIO -->
        <div class="modal fade" id="image<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarRegistro">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="imagetUser" enctype="multipart/form-data">
                            <div class="form-group">
                                <p>Editar imagem de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $usu['name']; ?>" readonly />
                                <label for="image">Nova imagem:</label>
                                <input type="file" accept="image/*" name="user_new_picture" class="form-control" />
                            </div>
                            <button type="button" class="btn btn-success" onclick="setUserPicture(<?php echo $usu['id_usu']; ?>)">Confirmar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL IMAGEM FIM -->
        <!-- MODAL EDITAR INICIO -->
        <div class="modal fade" id="edit<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarRegistro">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="editUser">
                            <div class="form-group">
                                <p>Editar registro de usuário</p>
                                <label for="active">Ativo:</label>
                                <input type="radio" name="active" value="Y" <?php echo ($usu['active'] == "Y"?'checked="checked"':''); ?>> Sim
                                <input type="radio" name="active" value="N"<?php echo ($usu['active'] == "N"?'checked="checked"':''); ?>> Não
                                <br />
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" required="required" value="<?php echo $usu['name']; ?>" />
                                <label for="username">Email:</label>
                                <input type="email" name="username" class="form-control" required="required" value="<?php echo $usu['email']; ?>" />
                                <label for="age">Idade:</label>
                                <input type="text" name="age" class="form-control" required="required" value="<?php echo $usu['age']; ?>" />
                                <input type="hidden" name="id" value="<?php echo $usu['id_usu']; ?>" />
                            </div>
                            <input type="submit" value="Atualizar" name="editUserDone" class="btn btn-primary" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL EDITAR FIM -->
        <!-- MODAL NOVA SENHA INICIO -->
        <div class="modal fade" id="pass<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarSenha">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="passEdit">
                            <div class="form-group">
                                <p>Editar senha de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" readonly value="<?php echo $usu['name']; ?>" />
                                <input type="text" name="id" value="<?php echo $usu['id_usu']; ?>" style="display:none;" />
                                <label for="pass">Nova senha:</label>
                                <input type="password" name="pass" class="form-control" required="required" />
                            </div>
                            <input type="submit" value="Atualizar" name="passEditDone" class="btn btn-primary" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL NOVA SENHA FIM -->
        <!-- MODAL DELETAR INICIO -->
        <div class="modal fade" id="del<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="DeletarRegistro">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="delUser">
                            <div class="form-group">
                                <p>Excluir registro de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" name="name" class="form-control" required="required" value="<?php echo $usu['name']; ?>" readonly />
                                <input type="text" name="id" value="<?php echo $usu['id_usu']; ?>" style="display:none;" />
                            </div>
                            <input type="submit" value="Excluir" name="delUserDone" class="btn btn-danger" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL DELETAR FIM -->
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
            "scrollY" : 200,
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
        var new_user_name = $("#new_user_name").val();
        var new_user_email = $("#new_user_email").val();
        var new_user_age = $("#new_user_age").val();
        var new_user_pass = $("#new_user_pass").val();

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
                iziToast.info({
                        title: 'Ok!',
                        message: response.message
                });
                location.reload();
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

    function setUserPicture(id_usu){
        var user_new_picture = $('input[name="user_new_picture"]')[0].files[0];
        
        if (user_new_picture == "" || typeof(user_new_picture) == "undefined") {
            $('input[name="user_new_picture"]').focus();
            iziToast.error({
                title: 'Ops',
                message: "Campo obrigatório!"
            });
            return false;
        } else {
            $("#loading_post").show();
        }

        var items = new FormData();
        items.append("user_pic", user_pic);

        axios({
            method: "POST",
            url: "config/editProfilePic",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
                response = JSON.parse(data_return);

            if (response.code == "12") {
                $("#loading_post").hide();
                $('#profile_user_pic_change').hide("slow");
                $('#profile_user_pic').show("slow");
                iziToast.success({
                    title: 'Ok!',
                    message: response.message
                });
                var file_path = $("#pi_path").val();
                $("#user_image").attr("src", file_path + "/" + response.image);
				$("#user_image_template").attr("src", file_path + "/" + response.image);
            }

            if(response.code == "13"){
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
</script>
