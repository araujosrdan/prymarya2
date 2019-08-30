<a href="<?php echo BASEURL; ?>parameter" class="" title="">Voltar</a> <br />
<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
        <form method="POST" name="imageUser" enctype="multipart/form-data" onsubmit="return submitLock();">
            <div class="form-group">
                <p>Editar imagem de usuário com ID: <?php echo $usu['id_usu']; ?></p>
                <label for="name">Nome:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $usu['name']; ?>" readonly />
                <label for="image">Imagem:</label>
                <input type="file" accept="image/*" name="image" id="image" class="form-control" />
                <input type="hidden" id="id_usu" name="id_usu" class="form-control" value="<?php echo $usu['id_usu']; ?>" />
            </div>
            <input type="submit" value="Confirmar" id="imageUserDone" name="imageUserDone" class="btn btn-success" />
        </form>
    </div>
    <?php if(!empty($return)): ?>
        <div class="alert alert-danger return_message" id="return_message">
            <?php echo $return . " "; ?>
        </div>
    <?php endif; ?>
<?php endforeach; ?>
