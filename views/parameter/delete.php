<a href="<?php echo BASEURL; ?>parameter" class="" title="">Voltar</a> <br />
<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
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
<?php endforeach; ?>
