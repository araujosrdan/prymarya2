/*
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
*/
//Rotina para impedir mais de um clique em formulários
function submitLock() {
    if (!statSend) {
        statSend = true;
        return true;
    } else {
        alert('Você já clicou! Aguarde por favor.');
        return false;
    }
}

//Rotina para tratar mensagem de retorno positivo
$(document).ready(function() {
    $('#return_message_btn').click(function() {
        $('#return_message').fadeOut('slow');
        return false;
    });
});

//Mensagem para erro ao logar no sistema.
$().ready(function() {
	setTimeout(function () {
		$('.return_message').fadeOut('slow');
	}, 2500);
});

//Rotina para fazer logo e links do welcome surgirem devagar
$().ready(function() {
	setTimeout(function () {
		$('#logo_welcome').fadeIn('slow');
	}, 1500);
});

$().ready(function() {
	setTimeout(function () {
		$('#logo_links').fadeIn('slow');
	}, 2500);
});
