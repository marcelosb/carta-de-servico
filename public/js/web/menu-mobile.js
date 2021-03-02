(() => {

	let body = document.querySelector('body');
	let verdadeiro = true;
	let navMenuMobile = document.querySelector('.nav-menu-mobile');
	let menuMobile = document.querySelector('.menu-mobile');
	
	menuMobile.addEventListener('click', (event) => {
	    if (verdadeiro) {
	        navMenuMobile.classList = 'nav-menu-mobile nav-link-active';
	        navMenuMobile.style.display = 'block';
	        navMenuMobile.addEventListener('animationend', (event) => {
	        	navMenuMobile.style.display = 'block';
	        });
	        body.style.overflowY = 'hidden';
	        verdadeiro = false;
	    } else {
	        navMenuMobile.classList = 'nav-menu-mobile nav-link-desactive';
	        navMenuMobile.addEventListener('animationend', (event) => {
	        	navMenuMobile.style.display = 'none';
	        });
	        body.style.overflowY = 'auto';
	        verdadeiro = true;
	    }
	});

})();