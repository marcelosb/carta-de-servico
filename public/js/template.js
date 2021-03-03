(() => {

    const menuIcon = document.getElementById('menuIcon');
    const barraLateral = document.getElementById('barraLateral');
    const blocoCinzaTransparente = document.querySelector('.bloco--cinza--transparente');
    
    menuIcon.addEventListener('click', () => {  
        // se a largura da tela for menor ou igual a 1024px
        let larguraDaTela = window.outerWidth;
        if (larguraDaTela >= 0 && larguraDaTela <= 1024) {
            if (!barraLateral.classList.contains('menu--mobile--on')) {
                barraLateral.classList.add('menu--mobile--on');
                barraLateral.classList.remove('menu--mobile--off');
            } else {
                barraLateral.classList.remove('menu--mobile--on');
                barraLateral.classList.add('menu--mobile--off');
            }
            blocoCinzaTransparente.style.display = 'block';
        } else {
            if (!barraLateral.classList.contains('menu--off')) {
                barraLateral.classList.add('menu--off');
                barraLateral.classList.remove('menu--on');
            } else {
                barraLateral.classList.remove('menu--off');
                barraLateral.classList.add('menu--on');
            }
        }
        
    });
    
    blocoCinzaTransparente.addEventListener('click', () => {  
        blocoCinzaTransparente.style.display = 'none';
        if (!barraLateral.classList.contains('menu--mobile--off')) {
            barraLateral.classList.add('menu--mobile--off');
            barraLateral.classList.remove('menu--mobile--on');
        } else {
            barraLateral.classList.remove('menu--mobile--off');
            barraLateral.classList.add('menu--mobile--on');
        }
    });

    if (document.querySelector('.menu-direito')) {
        const menuDireito = document.querySelector('.menu-direito');
        const menuDropDown = document.querySelector('.menu-direito-dropdown')
        menuDireito.addEventListener('click', () => {
            if (menuDropDown.style.display === 'block') {
                menuDropDown.style.display = 'none';
            } else {
                menuDropDown.style.display = 'block';
            }
        });
        menuDireito.addEventListener('mouseleave', () => { menuDropDown.style.display = 'none'; });
    }
    if (document.querySelector('.menu-direito-mobile')) {
        const menuDireitoMobile = document.querySelector('.menu-direito-mobile');
        const menuDropDownMobile = document.querySelector('.menu-direito-dropdown-mobile');
        menuDireitoMobile.addEventListener('click', () => {
            if (menuDropDownMobile.style.display === 'block') {
                menuDropDownMobile.style.display = 'none';
            } else {
                menuDropDownMobile.style.display = 'block';
            }
        });
        menuDireitoMobile.addEventListener('mouseleave', () => { menuDropDownMobile.style.display = 'none'; });
    }

    if (document.querySelector('.menu-direito-not-admin')) {
        const menuDireitoNotAdmin = document.querySelector('.menu-direito-not-admin');
        const menuDireitoDropDownNotAdmin = document.querySelector('.menu-direito-dropdown-not-admin')
        menuDireitoNotAdmin.addEventListener('click', () => {
            if (menuDireitoDropDownNotAdmin.style.display === 'block') {
                menuDireitoDropDownNotAdmin.style.display = 'none';
            } else {
                menuDireitoDropDownNotAdmin.style.display = 'block';
            }
        });
        menuDireitoNotAdmin.addEventListener('mouseleave', () => { menuDireitoDropDownNotAdmin.style.display = 'none'; });
    }

    // MUDA A COR DE FUNDO, DO TEXTO E DO ICONE DO MENU SELECIONADO
    const UrlCurrent = window.location.href;

    // ABRE O SUBMENU
    const listSubmenu = document.getElementById('listSubmenu');
    listSubmenu.addEventListener('click', function() {
        const submenu = document.querySelector('.submenu');

        if (!submenu.classList.contains('submenu--on')) {
            submenu.classList.add('submenu--on');
            submenu.classList.remove('submenu--off');
        } else {
            submenu.classList.remove('submenu--on');
            submenu.classList.add('submenu--off');
        }
        
    });
    
})();