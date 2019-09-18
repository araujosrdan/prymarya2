<?php
  /**
   * Classe de manipulação da tabela de usuários
   */
  class usersDB extends model
  {
    //QUERIES DE LEITURA
    public function users_check_session(){
      if (!isset($_SESSION['prymarya2_session_log']) || (isset($_SESSION['prymarya2_session_log'])) && empty($_SESSION['prymarya2_session_log'])) {
        header("Location: " . BASEURL . "welcome");
        exit;
      }
    }

    public function getUsers(){
      $returner = array();
      $query = "SELECT LPAD(id_usu,3,'0') AS cod_usu, usu.* FROM users usu ORDER BY cod_usu";
      $query = $this->db->query($query);
      if ($query->rowCount() > 0) {
        $returner = $query->fetchAll();
      }
      return $returner;
    }

    public function getUserSelected($id){
      $returner = array();
      $query = "SELECT * FROM users WHERE id_usu = '$id'";
      //echo $query;exit;
      $query = $this->db->query($query);
      if ($query->rowCount() > 0) {
        $returner = $query->fetchAll();
      }
      return $returner;
    }

    public function logIn($login_email, $login_pass){
      $query = "SELECT * FROM users WHERE email = :login_email";
      $query = $this->db->prepare($query);
      $query->bindValue(":login_email", $login_email);
      $query->execute();
      if ($query->rowCount() > 0) {
        $returner = $query->fetch();
        if ($returner['blocked'] == "N") {
          $query = "SELECT * FROM users WHERE email = :login_email AND active = 'Y'";
          $query = $this->db->prepare($query);
          $query->bindValue(":login_email", $login_email);
          $query->execute();
          if ($query->rowCount() > 0) {
            $query = $query->fetch();
            if (password_verify($login_pass, $query['pass'])) {
              $_SESSION['prymarya2_session_log'] = $query['id_usu'];
              $response = array(
                "code" => "08",
                "message" => "[Acesso permitido]"
              );
              echo json_encode($response);
              exit;
            } else {
              unset($_SESSION['prymarya2_session_log']);
              $response = array(
                "code" => "09",
                "message" => "Senha informada incorreta!"
              );
              echo json_encode($response);
              exit;
            }
          } else {
            unset($_SESSION['prymarya2_session_log']);
            $response = array(
              "code" => "10",
              "message" => "Conta inativa!"
            );
            echo json_encode($response);
            exit;
          }
        } else {
            $response = array(
              "code" => "11",
              "message" => "Conta bloqueada!"
            );
            echo json_encode($response);
            exit;
        }
      } else {
        unset($_SESSION['prymarya2_session_log']);
        $response = array(
          "code" => "12",
          "message" => "Email não cadastrado no sistema!"
        );
        echo json_encode($response);
        exit;
      }
    }

    public function logOff(){
      unset($_SESSION['prymarya2_session_log']);
      header("Location: " . BASEURL);
    }

    //QUERIES DE MODIFICAÇÃO
    public function setNewUser($new_user_name, $new_user_email, $new_user_age, $new_user_pass){
      $query = "SELECT * FROM users WHERE email = :new_user_email";
      //echo $query;exit;
      $query = $this->db->prepare($query);
      $query->bindValue(":new_user_email", $new_user_email);
      $query->execute();
      if ($query->rowCount() > 0) {
        $response = array(
          "code" => "01",
          "message" => "Email já existe no sistema!"
        );
        echo json_encode($response);
        exit;
      } else {
        $query = "INSERT INTO users SET name = :new_user_name, email = :new_user_email, pass = :new_user_pass, age = :new_user_age";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":new_user_name", $new_user_name);
        $query->bindValue(":new_user_email", $new_user_email);
        $query->bindValue(":new_user_pass", $new_user_pass);
        $query->bindValue(":new_user_age", $new_user_age);
        $query->execute();
        $response = array(
          "code" => "02",
          "message" => "Registro gravado com sucesso!"
        );
        echo json_encode($response);
        exit();
      }
    }

    public function setEditUser($user_active, $user_name, $user_email, $user_age, $id_usu){
      $query = "SELECT * FROM users WHERE email = :user_email AND id_usu != :id_usu";
      //echo $query;exit;
      $query = $this->db->prepare($query);
      $query->bindValue(":user_email", $user_email);
      $query->bindValue(":id_usu", $id_usu);
      $query->execute();
      if ($query->rowCount() > 0) {
        $response = array(
          "code" => "13",
          "message" => "Outro usuário com este email!"
        );
        echo json_encode($response);
        exit();
      } else {
        $query = "UPDATE users SET active= :user_active, name = :user_name, email = :user_email, age = :user_age WHERE id_usu = :id_usu";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":user_active", $user_active);
        $query->bindValue(":user_name", $user_name);
        $query->bindValue(":user_email", $user_email);
        $query->bindValue(":user_age", $user_age);
        $query->bindValue(":id_usu", $id_usu);
        $query->execute();
        $response = array(
          "code" => "14",
          "message" => "Usuário atualizado com sucesso!"
        );
        echo json_encode($response);
        exit();
      }
    }

    public function setUserImg($image, $id_usu){
      if (count($image) > 0) {
        $user_folder = 'media/user/' . $id_usu;
        if (is_dir($user_folder)) {
            chmod($user_folder, 0777);
        } else {
            mkdir($user_folder, 0777);
            chmod($user_folder, 0777);
        }
        $query = "SELECT image FROM users WHERE id_usu = :id";
        $query = $this->db->prepare($query);
        $query->bindValue(":id", $id_usu);
        $query->execute();
        $oldpic = $query->fetch();
        if (!empty($oldpic)) {
          chmod($user_folder, 0777);
          @array_map("unlink", glob($user_folder . "/" . $oldpic['image']));
        }
        $type = $image['type'];
        if (in_array($type, array('image/jpeg', 'image/png'))) {
          $tmpname = md5(time().rand(0, 999)) . '.jpg';
          $tmppath = $user_folder . "/" . $tmpname;
          move_uploaded_file($image['tmp_name'], $tmppath);
          list($width_orig, $height_orig) = getimagesize($tmppath);
          $ratio = $width_orig / $height_orig;
          $width = 150;
          $height = 150;
          if (($width / $height) > $ratio) {
              $width = $height * $ratio;
          } else {
              $height = $width / $ratio;
          }
          $img = imagecreatetruecolor($width, $height);
          $origin = imagecreatefromjpeg($tmppath);
          imagecopyresampled($img, $origin, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
          imagejpeg($img, $tmppath, 80);
          $query = "UPDATE users SET image = :image WHERE id_usu = :id";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":image", $tmpname);
          $query->bindValue(":id", $id_usu);
          $query->execute();
          $response = array(
            "code" => "17",
            "message" => "Imagem do registro atualizada com sucesso!"
          );
          echo json_encode($response);
          exit();
        } else {
          $response = array(
            "code" => "17",
            "message" => "Envie apenas imagens JPG ou JPEG!"
          );
          echo json_encode($response);
          exit();
          }
      }
    }

    public function setNewPass($newpass_email, $newpass_pass){
      if (isset($_SESSION['prymarya2_session_log'])) {
        $id_usu = $_SESSION['prymarya2_session_log'];
        $query = "UPDATE users SET pass = :newpass_pass WHERE id_usu = :id_usu";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":newpass_pass", $newpass_pass);
        $query->bindValue(":id_usu", $id_usu);
        $query->execute();
        $response = array(
          "code" => "05",
          "message" => "#05 - Senha gravada com sucesso!"
        );
        echo json_encode($response);
        exit();
      } else {
        $query = "SELECT * FROM users WHERE email = :newpass_email";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":newpass_email", $newpass_email);
        $query->execute();
        if ($query->rowCount() > 0) {
          $query = "UPDATE users SET pass = :newpass_pass WHERE email = :newpass_email";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":newpass_pass", $newpass_pass);
          $query->bindValue(":newpass_email", $newpass_email);
          $query->execute();
          $response = array(
            "code" => "06",
            "message" => "#06 - Senha gravada com sucesso!"
          );
          echo json_encode($response);
          exit();
        } else {
          $response = array(
            "code" => "07",
            "message" => "Email não cadastrado no sistema!"
          );
          echo json_encode($response);
          exit();
        }
      }
    }

    public function setDelUser($id_usu){
      if ($_SESSION['prymarya2_session_log'] === $id_usu) {
        $query = "DELETE FROM users WHERE id_usu = '$id_usu'";
        //echo $query;exit;
        $query = $this->db->query($query);
        unset($_SESSION['prymarya2_session_log']);
        $response = array(
          "code" => "15",
          "message" => "Registro deletado com sucesso. Adeus!"
        );
        echo json_encode($response);
        exit();
      } else {
        $query = "DELETE FROM users WHERE id_usu = '$id_usu'";
        //echo $query;exit;
        $query = $this->db->query($query);
        $response = array(
          "code" => "16",
          "message" => "Registro deletado com sucesso!"
        );
        echo json_encode($response);
        exit();
      }
    }

  }

?>
