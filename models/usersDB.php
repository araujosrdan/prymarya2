<?php
# This file is part of Prymarya 2.

# Prymarya 2 is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

# Prymarya 2 is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License along with Prymarya 2.  If not, see <https://www.gnu.org/licenses/>.

# ---------------------------------------------

# Este arquivo é parte do programa Prymarya 2

# Prymarya 2 é um software livre; você pode redistribuí-lo e/ou
# modificá-lo dentro dos termos da Licença Pública Geral GNU como
# publicada pela Fundação do Software Livre (FSF); na versão 3 da
# Licença, ou (a seu critério) qualquer versão posterior.

# Este programa é distribuído na esperança de que possa ser útil,
# mas SEM NENHUMA GARANTIA; sem uma garantia implícita de ADEQUAÇÃO
# a qualquer MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a
# Licença Pública Geral GNU para maiores detalhes.

# Você deve ter recebido uma cópia da Licença Pública Geral GNU junto
# com este programa, Se não, veja <http://www.gnu.org/licenses/>.
?>
<?php
  /**
   * Classe de manipulação da tabela de usuários
   */
  class usersDB extends model
  {
    //QUERIES DE LEITURA
    public function users_check_session(){
      if (!isset($_SESSION['crud_session_log']) || (isset($_SESSION['crud_session_log'])) && empty($_SESSION['crud_session_log'])) {
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

    public function users_login($username, $pass){
      $query = "SELECT * FROM users WHERE email = :email";
      //echo $query;exit;
      $query = $this->db->prepare($query);
      $query->bindValue(":email", $username);
      $query->execute();
      if ($query->rowCount() > 0) {
        if (isset($_SESSION['crud_sessionlogin_log']) && $_SESSION['crud_sessionlogin_log'] >= 3) {
          $query = "SELECT * FROM users WHERE email = :email";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":email", $username);
          $query->execute();
          if ($query->rowCount() > 0) {
              $query = "UPDATE users SET blocked = 'Y' WHERE email = :email";
              //echo $query;exit;
              $query = $this->db->prepare($query);
              $query->bindValue(":email", $username);
              $query->execute();
          }
          return "Acesso bloqueado por muitas tentativas! Lamentamos o inconveniente.";
        } else {
          $query = "SELECT * FROM users WHERE email = :email";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":email", $username);
          $query->execute();
          if ($query->rowCount() > 0) {
              $query = $query->fetch();
              if(password_verify($pass, $query['pass'])){
                if ($query['blocked'] == 'N') {
                  unset($_SESSION['crud_sessionlogin_log']);
                  $_SESSION['crud_session_log'] = $query['id_usu'];
                  header("Location: " . BASEURL . "home");
                  exit;
                } else {
                  return "Conta bloqueada! Email contato@danerz.com para abrir chamado";
                }
              } else {
                if (!isset($_SESSION['crud_sessionlogin_log'])) {
                  $_SESSION['crud_sessionlogin_log'] = 0;
                }
                $_SESSION['crud_sessionlogin_log']++;
                return "Email e/ou Senha errados! Tentativas: " . $_SESSION['crud_sessionlogin_log'] . ". No terceiro erro haverá bloqueio!";
              }
          }
        }
      } else {
        return "Usuário não existe! Tente novamente";
      }
    }

    public function logOff(){
      unset($_SESSION['crud_session_log']);
      header("Location: " . BASEURL);
    }

    //QUERIES DE MODIFICAÇÃO
    public function addUser($name, $username, $pass, $age, $flag){
      if(isset($_SESSION['crud_session_log'])){
        $query = "SELECT * FROM users WHERE email = :email";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":email", $username);
        $query->execute();
        if ($query->rowCount() > 0) {
          echo "<script>alert('Ops! Este usuário já existe!')</script>";
        } else {
          $query = "INSERT INTO users SET name = :name, email = :email, pass = :pass, age = :age";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":name", $name);
          $query->bindValue(":email", $username);
          $query->bindValue(":pass", $pass);
          $query->bindValue(":age", $age);
          $query->execute();
          if ($flag === "modal") {
            header("Refresh:0");
          } else {
            return "Registro efetuado com sucesso!";
          }
        }
      } else {
        $query = "SELECT * FROM users WHERE email = :email";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":email", $username);
        $query->execute();
        if ($query->rowCount() > 0) {
          echo "<script>alert('Ops! Este usuário já existe!')</script>";
        } else {
          $query = "INSERT INTO users SET name = :name, email = :email, pass = :pass, age = :age";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":name", $name);
          $query->bindValue(":email", $username);
          $query->bindValue(":pass", $pass);
          $query->bindValue(":age", $age);
          $query->execute();
          header("Location: " . BASEURL . "login");
        }
      }
    }

    public function editUser($active, $name, $username, $age, $id, $flag){
      $query = "SELECT * FROM users WHERE email = :email AND id_usu != :id";
      //echo $query;exit;
      $query = $this->db->prepare($query);
      $query->bindValue(":email", $username);
      $query->bindValue(":id", $id);
      $query->execute();
      if ($query->rowCount() > 0) {
        echo "<script>alert('Ops! Este usuário já existe!')</script>";
      } else {
        $query = "UPDATE users SET active= :active, name = :name, email = :email, age = :age WHERE id_usu = :id";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":active", $active);
        $query->bindValue(":name", $name);
        $query->bindValue(":email", $username);
        $query->bindValue(":age", $age);
        $query->bindValue(":id", $id);
        $query->execute();
        if ($flag === "modal") {
          header("Refresh:0");
        } else {
          return "Registro editado com sucesso!";
        }
      }
    }

    public function imageUser($image, $id_usu, $flag){
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
          array_map("unlink", glob($user_folder . "/" . $oldpic['image']));
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
          if ($flag === "modal") {
            header("Refresh:0");
          } else {
            return "Imagem editada com sucesso!";
          }
        } else {
            if ($flag === "modal") {
              echo "<script>alert('Por favor envie apenas imagens JPG ou JPEG!')</script>";
            } else {
              return "Por favor envie apenas imagens JPG ou JPEG!";
            }
          }
      }
    }

    public function passEdit($pass, $id, $flag){
      if (isset($_SESSION['crud_session_log'])) {
        $query = "UPDATE users SET pass = :pass WHERE id_usu = :id";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":pass", $pass);
        $query->bindValue(":id", $id);
        $query->execute();
        if ($flag === "modal") {
          header("Refresh:0");
        } else {
          return "Senha editada com sucesso!";
        }
      } else {
        $query = "SELECT * FROM users WHERE email = :email";
        //echo $query;exit;
        $query = $this->db->prepare($query);
        $query->bindValue(":email", $id);
        $query->execute();
        if ($query->rowCount() > 0) {
          $query = "UPDATE users SET pass = :pass WHERE email = :email";
          //echo $query;exit;
          $query = $this->db->prepare($query);
          $query->bindValue(":pass", $pass);
          $query->bindValue(":email", $id);
          $query->execute();
          return "Senha editada com sucesso!";
        } else {
          return "Este email não está cadastrado no sistema!";
        }
      }
    }

    public function delUser($id){
      if ($_SESSION['crud_session_log'] === $id) {
        $query = "DELETE FROM users WHERE id_usu = '$id'";
        //echo $query;exit;
        $query = $this->db->query($query);
        unset($_SESSION['crud_session_log']);
        header("Location: " . BASEURL);
      } else {
        $query = "DELETE FROM users WHERE id_usu = '$id'";
        //echo $query;exit;
        $query = $this->db->query($query);
        header("Location: " . BASEURL);
      }
    }

  }

?>
