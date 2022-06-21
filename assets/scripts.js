/**
 * @ Author: Alberto Sanchez Torreblanca
 * @ Create Time: 30-03-2022 09:11:38
 * @ Modified by: Alberto Sanchez Torreblanca
 * @ Modified time: 01-04-2022 20:03:02
 * @ Description: Script que esconde o muestra el menu cuando pulsamos en "Menu" en pantallas menores a 1000px
 */

window.onload = function() {
    var menuBtn = document.querySelector('header nav span'),
        menu = document.querySelector('header nav ul');

    menuBtn.onclick = function() {
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        } else {
            menu.classList.add('show');
        }
    };
};