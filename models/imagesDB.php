<?php
  /**
   * Classe de manipulação da tabela de imagens
   */
  class imagesDB extends model
  {
    public function getImages($id){
      $returner = array();
      $query = "SELECT LPAD(id_img,3,'0') AS cod_img, img.* FROM images img WHERE fid_usu = '$id' ORDER BY cod_img DESC";
      $query = $this->db->query($query);
      if ($query->rowCount() > 0) {
        $returner = $query->fetchAll();
      }
      return $returner;
    }

    //QUERIES DE MODIFICAÇÃO
    public function addImage($images, $id){
      if (count($images) > 0) {
        $user_folder = 'media/images/' . $id;
        if (is_dir($user_folder)) {
            chmod($user_folder, 0777);
        } else {
            mkdir($user_folder, 0777);
            chmod($user_folder, 0777);
        }
        for ($q = 0; $q < count($images['tmp_name']); $q++) {
            $type = $images['type'][$q];
            if (in_array($type, array('image/jpeg', 'image/png'))) {
              $tmpname = md5(time().rand(0, 999)) . '.jpg';
              $tmppath = $user_folder . "/" . $tmpname;
              move_uploaded_file($images['tmp_name'][$q], $tmppath);
              list($width_orig, $height_orig) = getimagesize($tmppath);
              $ratio = $width_orig / $height_orig;
              $width = 500;
              $height = 500;
              if (($width / $height) > $ratio) {
                  $width = $height * $ratio;
              } else {
                  $height = $width / $ratio;
              }
              $img = imagecreatetruecolor($width, $height);
              if ($type == 'image/jpeg') {
                  $origin = imagecreatefromjpeg($tmppath);
              } elseif ($type == 'image/png') {
                  $origin = imagecreatefrompng($tmppath);
              }
              imagecopyresampled($img, $origin, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
              imagejpeg($img, $tmppath, 80);
              $query = "INSERT INTO images SET fid_usu = '$id', addr = '$tmpname'";
              //echo $query;exit;
              $query = $this->db->query($query);
              header("Refresh:0");
            } else {
              return "Por favor envie apenas imagens JPG ou JPEG!";
            }
        }
      }
    }

    public function editImage($pic_id, $name, $description){
      $query = "UPDATE images SET name = :name, description = :description WHERE id_img = :id_img";
      $query = $this->db->prepare($query);
      $query->bindValue(":name", $name);
      $query->bindValue(":description", $description);
      $query->bindValue(":id_img", $pic_id);
      $query->execute();
      header("Refresh:0");
    }

    public function deleteImage($pic_id){
      $query = "SELECT fid_usu, addr FROM images WHERE id_img = '$pic_id'";
      //echo $query;exit;
      $query = $this->db->query($query);
      $array = $query->fetch();
      $user_folder = 'media/images/' . $array['fid_usu'];
      chmod($user_folder, 0777);
      $pic = $array['addr'];
      $query = "DELETE FROM images WHERE id_img = '$pic_id'";
      //echo $query;exit;
      $query = $this->db->query($query);
      array_map("unlink", glob($user_folder . "/" . $pic));
      $folder_check = scandir($user_folder);
      if (count($folder_check) > 2) {
        header("Refresh:0");
      } else {
        rmdir($user_folder);
        header("Refresh:0");
      }
    }

  }

?>
