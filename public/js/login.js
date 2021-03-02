(async (containerLogin) => {
    
    document.addEventListener('click', (event) => {
        const esqueciMinhaSenha = document.getElementById('esqueciMinhaSenha');
        if (esqueciMinhaSenha && esqueciMinhaSenha.contains(event.target)) {
            renderPageEsqueciSenha(containerLogin);
        }
    });

    document.addEventListener('click', (event) => {
        const btnRecuperarSenha = document.getElementById('btnRecuperarSenha'); 
        if (btnRecuperarSenha && btnRecuperarSenha.contains(event.target)) {
            event.preventDefault();
            const email = document.querySelector('[type="email"]').value.toLowerCase();
            const alertLogin = document.getElementById('loginAlert');
            if (email === '') {
                renderAlert(alertLogin, 'E-mail em branco, informe o seu endereço de e-mail!', 'warning-login');
            } else if (Helper.emailIsValid(email)) {
                
                loadingOn();

                Http.get(`${URL}/login/recuperar_senha/${email}`).then((json) => {
                    if (json.emailNotExist) {
                        renderAlert(alertLogin, 'O E-mail informado não consta na base de dados!', 'warning-login');
                    } else {
                        renderAlert(alertLogin, 'E-mail enviado com sucesso!<br> Verifique sua caixa de entrada, como também sua caixa de SPAM e siga as orientações', 'success-login');
                        document.querySelector('[type="email"]').value = '';
                    }
                    loadingOff();
                });
            } else {
                renderAlert(alertLogin, 'E-mail inválido, informe o seu endereço de e-mail corretamente!', 'danger-login');
            }
            
        }
    });

})(document.querySelector('.bloco-login'));