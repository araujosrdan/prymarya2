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
   * CONTROLADOR DA TELA COM FUNÇÕES MODAL DO SISTEMA.
   */
  class modalController extends controller
  {

    public function __construct(){
        parent::__construct();
        $users = new usersDB();
        $users->users_check_session();
        global $user_in;
        $user_in = intval($_SESSION['crud_session_log']);
    }

    public function index(){
      $data_set = array('erro' => '');
      $users = new usersDB();
      $data_set['users'] = $users->getUsers();

    if(isset($_POST['newUserDone'])){
      if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $username = addslashes($_POST['username']);
      }
      $name = addslashes(htmlspecialchars($_POST['name']));
      $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      $age = addslashes(htmlspecialchars($_POST['age']));
      $flag = "modal";
      $users = new usersDB();
      $users->addUser($name, $username, $pass, $age, $flag);
    }

    if (isset($_POST['imageUserDone'])) {
      $image = $_FILES['image'];
      $id_usu = $_POST['id_usu'];
      $flag = "modal";
      $users = new usersDB();
      $users->imageUser($image, $id_usu, $flag);
    }

    if (isset($_POST['editUserDone'])) {
      if (filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)) {
        $username = addslashes($_POST['username']);
      }
      $active = $_POST['active'];
      $name = addslashes(htmlspecialchars($_POST['name']));
      $age = addslashes(htmlspecialchars($_POST['age']));
      $id = $_POST['id'];
      $flag = "modal";
      $users = new usersDB();
      $users->editUser($active, $name, $username, $age, $id, $flag);
    }

    if (isset($_POST['passEditDone'])) {
      $pass = addslashes(password_hash($_POST['pass'], PASSWORD_BCRYPT));
      $id = $_POST['id'];
      $flag = "modal";
      $users = new usersDB();
      $users->passEdit($pass, $id, $flag);
    }

    if (isset($_POST['delUserDone'])) {
      $id = $_POST['id'];
      $users = new usersDB();
      $users->delUser($id);
    }
      $this->loadTemplate('modal', $data_set);
    }

  }

?>
