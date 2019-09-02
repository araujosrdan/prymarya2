<a href="<?php echo BASEURL; ?>parameter" class="" title="">Voltar</a> <br />
<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
        <p>Editar senha do registro:</p>
        <?php if(!empty($return)): ?>
            <div class="alert alert-success" id="return_message">
        <?php echo $return . " "; ?> <button id="return_message_btn" class="btn btn-primary">Ok</button>
            </div>
        <?php endif; ?>
        <form method="POST" name="passEdit">
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" readonly value="<?php echo $usu['name']; ?>" />
                <label for="pass">Nova senha:</label>
                <input type="password" id="pass" name="pass" class="form-control" required="required" />
                <input type="hidden" id="id_usu" name="id_usu" class="form-control" value="<?php echo $usu['id_usu']; ?>" />
            </div>
            <input type="submit" value="Atualizar" id="passEditDone" name="passEditDone" class="btn btn-primary" />
        </form>
    </div>
<?php endforeach; ?>
