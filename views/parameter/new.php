<a href="<?php echo BASEURL; ?>parameter" class="" title="">Voltar</a> <br />
<div class="form_design_one">
    <form method="POST" name="newUser" onsubmit="return submitLock();">
        <div class="form-group">
            <p>Novo registro de usuário</p>
            <?php if(!empty($return)): ?>
                <div class="alert alert-success" id="return_message">
            <?php echo $return . " "; ?> <button id="return_message_btn" class="btn btn-primary">Ok</button>
                </div>
            <?php endif; ?>
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
