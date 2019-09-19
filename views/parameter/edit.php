<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
        <form method="POST" name="newUser">
            <div class="form-group">
                <p>Editar registro de usuário com ID: <?php echo $usu['id_usu']; ?></p>
                <label for="active">Ativo:</label>
                <input type="radio" name="active" value="Y" class="user_active" <?php echo ($usu['active'] == "Y"?'checked="checked"':''); ?>> Sim
                <input type="radio" name="active" value="N" class="user_active" <?php echo ($usu['active'] == "N"?'checked="checked"':''); ?>> Não
                <br />
                <label for="name">Nome:</label>
                <input type="text" name="user_name" class="form-control" value="<?php echo $usu['name']; ?>" />
                <label for="username">Email:</label>
                <input type="email" name="user_email" class="form-control" value="<?php echo $usu['email']; ?>" />
                <label for="age">Idade:</label>
                <input type="text" name="user_age" class="form-control" value="<?php echo $usu['age']; ?>" />
                <label for="pass">Nova senha:</label>
                <input type="password" name="user_pass" class="form-control" placeholder="Digite nova senha se deseja alterar" />
            </div>
            <button type="button" class="btn btn-success" onclick="setEditUser(<?php echo $usu['id_usu']; ?>)">Confirmar</button>
            <a href="<?php echo BASEURL; ?>parameter" class="btn btn-secondary" title="">Voltar</a>
        </form>
    </div>
<?php endforeach; ?>
<script type="text/javascript">
    function setEditUser(id_usu){
        var user_active = document.querySelector('.user_active:checked').value;
        var user_name = $('input[name="user_name"]').val();
        var user_email = $('input[name="user_email"]').val();
        var user_age = $('input[name="user_age"]').val();
        var user_pass_set = $('input[name="user_pass"]').val();
        var user_pass = window.btoa(user_pass_set);
        
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
        items.append("user_pass", user_pass);

        axios({
            method: "POST",
            url: "../setEditUser",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
				response = JSON.parse(data_return);
            
            if (response.code == "14") {
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    window.location.href = "../../parameter";
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
</script>