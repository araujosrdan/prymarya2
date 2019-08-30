<h2><a href="<?php echo BASEURL; ?>" class="" title="">Home</a> > CRUD via Modal</h2>
<hr />
<?php if(!empty($return)): ?>
    <div class="alert alert-success" id="return_message">
<?php echo $return . " "; ?> <a href="<?php echo BASEURL; ?>/modal" class="btn btn-success">Atualizar para ver</a>
    </div>
<?php endif; ?>
<table class="display" id="tbUsuarios">
    <thead>
        <td class="header_treat">Código:</td>
        <td class="header_treat">Img:</td>
        <td class="header_treat">Email:</td>
        <td class="header_treat">Nome:</td>
        <td class="header_treat">Idade:</td>
        <td class="header_treat">Ativo:</td>
        <td class="header_treat" style="text-align:right">Opções</td>
    </thead>
    <tbody>
        <?php foreach($users as $usu): ?>
            <tr>
                <td><?php echo $usu['cod_usu']; ?></td>
                <?php if($usu['image'] != ''): ?>
                  <td align="center"><img src="<?php echo BASEURL; ?>media/user/<?php echo $usu['id_usu']; ?>/<?php echo $usu['image']; ?>" class="img-thumbail" style="height:3rem;width:3rem;" /> </td>
                <?php else: ?>
                  <td title="Sem imagem disponível" align="center"><span class="glyphicon glyphicon-picture"></span> </td>
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
                    <a href="#" data-toggle="modal" data-target="#image<?php echo $usu['id_usu']; ?>" class="btn btn-dark" title="Editar imagem"><span class="glyphicon glyphicon-user"></span></a>
                    <a href="#" data-toggle="modal" data-target="#edit<?php echo $usu['id_usu']; ?>" class="btn btn-dark" title="Editar registro"><span class="glyphicon glyphicon-edit"></span></a>
                    <a href="#" data-toggle="modal" data-target="#pass<?php echo $usu['id_usu']; ?>" class="btn btn-dark" title="Editar senha"><span class="glyphicon glyphicon-check"></span></a>
                    <a href="#" data-toggle="modal" data-target="#del<?php echo $usu['id_usu']; ?>" class="btn btn-white" title="Excluir registro"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        <!-- MODAL NOVO INICIO -->
        <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-labelledby="NovoRegistro">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="newUser" onsubmit="return submitLock();">
                            <div class="form-group">
                                <p>Novo registro de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" required="required" />
                                <label for="username">Email:</label>
                                <input type="email" id="username" name="username" class="form-control" required="required" />
                                <label for="age">Idade:</label>
                                <input type="text" id="age" name="age" class="form-control" required="required" />
                                <label for="pass">Senha:</label>
                                <input type="password" id="pass" name="pass" class="form-control" required="required" />
                            </div>
                            <input type="submit" value="Confirmar" id="newUserDone" name="newUserDone" class="btn btn-success" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL NOVO FIM -->
        <!-- MODAL IMAGEM INICIO -->
        <div class="modal fade" id="image<?php echo $usu['id_usu']; ?>" tabindex="-1" role="dialog" aria-labelledby="EditarRegistro">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form method="POST" name="imagetUser" enctype="multipart/form-data" onsubmit="return submitLock();">
                            <div class="form-group">
                                <p>Editar imagem de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" value="<?php echo $usu['name']; ?>" readonly />
                                <label for="image">Nova imagem:</label>
                                <input type="file" accept="image/*" name="image" id="image" class="form-control" />
                                <input type="hidden" name="id_usu" id="id_usu" value="<?php echo $usu['id_usu']; ?>" />
                            </div>
                            <input type="submit" value="Atualizar imagem" id="imageUserDone" name="imageUserDone" class="btn btn-primary" />
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
                        <form method="POST" name="editUser" onsubmit="return submitLock();">
                            <div class="form-group">
                                <p>Editar registro de usuário</p>
                                <label for="active">Ativo:</label>
                                <input type="radio" id="active" name="active" value="Y" <?php echo ($usu['active'] == "Y"?'checked="checked"':''); ?>> Sim
                                <input type="radio" id="active" name="active" value="N"<?php echo ($usu['active'] == "N"?'checked="checked"':''); ?>> Não
                                <br />
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" required="required" value="<?php echo $usu['name']; ?>" />
                                <label for="username">Email:</label>
                                <input type="email" id="username" name="username" class="form-control" required="required" value="<?php echo $usu['email']; ?>" />
                                <label for="age">Idade:</label>
                                <input type="text" id="age" name="age" class="form-control" required="required" value="<?php echo $usu['age']; ?>" />
                                <input type="hidden" name="id" id="id" value="<?php echo $usu['id_usu']; ?>" />
                            </div>
                            <input type="submit" value="Atualizar" id="editUserDone" name="editUserDone" class="btn btn-primary" />
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
                        <form method="POST" name="passEdit" onsubmit="return submitLock();">
                            <div class="form-group">
                                <p>Editar senha de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" readonly value="<?php echo $usu['name']; ?>" />
                                <input type="text" name="id" id="id" value="<?php echo $usu['id_usu']; ?>" style="display:none;" />
                                <label for="pass">Nova senha:</label>
                                <input type="password" id="pass" name="pass" class="form-control" required="required" />
                            </div>
                            <input type="submit" value="Atualizar" id="passEditDone" name="passEditDone" class="btn btn-primary" />
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
                        <form method="POST" name="delUser" onsubmit="return submitLock();">
                            <div class="form-group">
                                <p>Excluir registro de usuário</p>
                                <label for="name">Nome:</label>
                                <input type="text" id="name" name="name" class="form-control" required="required" value="<?php echo $usu['name']; ?>" readonly />
                                <input type="text" name="id" id="id" value="<?php echo $usu['id_usu']; ?>" style="display:none;" />
                            </div>
                            <input type="submit" value="Excluir" id="delUserDone" name="delUserDone" class="btn btn-danger" />
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
<a href="#" data-toggle="modal" data-target="#new" class="btn btn-primary" title="Novo registro">
    <span class="glyphicon glyphicon-tag"></span>
    Novo resgistro
</a>

<script>
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
    $('#tbUsuarios')
    .removeClass( 'display' )
    .addClass('table table-striped table-bordered');
</script>
