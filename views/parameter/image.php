<?php foreach($user_selected as $usu): ?>
    <div class="form_design_one">
        <form method="POST" name="imageUser" enctype="multipart/form-data">
            <div class="form-group">
                <p>Editar imagem de usuário com ID: <?php echo $usu['id_usu']; ?></p>
                <label for="name">Nome:</label>
                <input type="text" name="name" class="form-control" value="<?php echo $usu['name']; ?>" readonly />
                <label for="image">Imagem:</label>
                <input type="file" accept="image/*" name="user_image" class="form-control" />
            </div>
            <button type="button" class="btn btn-primary" onclick="setUserImg(<?php echo $usu['id_usu']; ?>)">Confirmar</button>
            <a href="<?php echo BASEURL; ?>parameter" class="btn btn-secondary" title="">Voltar</a>
        </form>
    </div>
<?php endforeach; ?>
<script type="text/javascript">
    function setUserImg(id_usu){
        var user_image = $('input[name="user_image"]')[0].files[0];
        
        if (user_image == "" || typeof(user_image) == "undefined") {
            $('input[name="user_image"]').focus();
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
            url: "../setUserImg",
            data: items
        }).then(res => {
            var data_return = JSON.stringify(res.data);
                response = JSON.parse(data_return);

            if (response.code == "17") {
                $("#loading_post").hide();
                Swal.fire({
                    type: "success",
                    text: response.message
                }).then(() => {
                    window.location.href = "../../parameter";
                }); 
            }

            if(response.code == "18"){
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
