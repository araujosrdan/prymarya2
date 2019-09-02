<a href="<?php echo BASEURL; ?>parameter" class="" title="">Voltar</a> <br />
<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
        <form method="POST" name="newUser">
            <div class="form-group">
                <p>Editar registro de usuário com ID: <?php echo $usu['id_usu']; ?></p>
                <?php if(!empty($return)): ?>
                    <div class="alert alert-success" id="return_message">
                <?php echo $return . " "; ?> <button id="return_messager_btn" class="btn btn-primary">Ok</button>
                    </div>
                <?php endif; ?>
                <label for="active">Ativo:</label>
                <input type="radio" id="active" name="active" value="Y" <?php echo ($usu['active'] == "Y"?'checked="checked"':''); ?>> Sim
                <input type="radio" id="active" name="active" value="N"<?php echo ($usu['active'] == "N"?'checked="checked"':''); ?>> Não
                <br />
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $usu['name']; ?>" required="required" />
                <label for="username">Email:</label>
                <input type="email" id="username" name="username" class="form-control" value="<?php echo $usu['email']; ?>" required="required" />
                <label for="age">Idade:</label>
                <input type="text" id="age" name="age" class="form-control" value="<?php echo $usu['age']; ?>" required="required" />
                <input type="hidden" id="id_usu" name="id_usu" class="form-control" value="<?php echo $usu['id_usu']; ?>" />
            </div>
            <input type="submit" value="Confirmar" id="editUserDone" name="editUserDone" class="btn btn-success" />
        </form>
    </div>
<?php endforeach; ?>
