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

    public function logIn($login, $pass){
      $query = "SELECT * FROM users WHERE login = :login";
      $query = $this->db->prepare($query);
      $query->bindValue(":login", $login);
      $query->execute();
      if ($query->rowCount() > 0) {
        $returner = $query->fetch();
        if ($returner['blocked'] == "N") {
          $query = "SELECT * FROM users WHERE login = :login AND active = 'Y'";
          $query = $this->db->prepare($query);
          $query->bindValue(":login", $login);
          $query->execute();
          if ($query->rowCount() > 0) {
            $query = $query->fetch();
            if (password_verify($pass, $query['pass'])) {
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
          "message" => "login não cadastrado no sistema!"
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
    public function setNewUser($name_nu, $login_nu, $birthday_nu, $pass_nu){
      $query = "SELECT * FROM users WHERE login = :login_nu";
      // echo $query;exit;
      $query = $this->db->prepare($query);
      $query->bindValue(":login_nu", $login_nu);
      $query->execute();
      if ($query->rowCount() > 0) {
        $response = array(
          "code" => "01",
          "message" => "login já existe no sistema!"
        );
        echo json_encode($response);
        exit;
      } else {
        $query = "INSERT INTO users SET name = :name_nu, login = :login_nu, pass = :pass_nu, birthday = :birthday_nu, blocked = 'N', active = 'Y'";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":name_nu", $name_nu);
        $query->bindValue(":login_nu", $login_nu);
        $query->bindValue(":pass_nu", $pass_nu);
        $query->bindValue(":birthday_nu", $birthday_nu);
        $query->execute();
        $response = array(
          "code" => "02",
          "message" => "Registro gravado com sucesso!"
        );
        echo json_encode($response);
        exit();
      }
    }

    public function setEditUser($user_active, $user_name, $user_login, $user_birthday, $user_pass, $id_usu){
      $query = "SELECT * FROM users WHERE login = :user_login AND id_usu != :id_usu";
      //echo $query;exit;
      $query = $this->db->prepare($query);
      $query->bindValue(":user_login", $user_login);
      $query->bindValue(":id_usu", $id_usu);
      $query->execute();
      if ($query->rowCount() > 0) {
        $response = array(
          "code" => "13",
          "message" => "Outro usuário com este login!"
        );
        echo json_encode($response);
        exit();
      } else {
        if ($user_pass !== '') {
          $query = "UPDATE users SET active= :user_active, name = :user_name, login = :user_login, birthday = :user_birthday, pass = :user_pass WHERE id_usu = :id_usu";
        } else {
          $query = "UPDATE users SET active= :user_active, name = :user_name, login = :user_login, birthday = :user_birthday WHERE id_usu = :id_usu";
        }
        // echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":user_active", $user_active);
        $query->bindValue(":user_name", $user_name);
        $query->bindValue(":user_login", $user_login);
        $query->bindValue(":user_birthday", $user_birthday);
        if ($user_pass !== '') {
          $query->bindValue(":user_pass", $user_pass);
        }
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

    public function setNewPass($login_np, $pass_np){
      $query = "SELECT * FROM users WHERE login = :login_np";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":login_np", $login_np);
        $query->execute();
        if ($query->rowCount() > 0) {
          $query = "UPDATE users SET pass = :pass_np WHERE login = :login_np";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":pass_np", $pass_np);
          $query->bindValue(":login_np", $login_np);
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
            "message" => "#07 - login não cadastrado no sistema!"
          );
          echo json_encode($response);
          exit();
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
