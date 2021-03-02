(() => {
	
	const btn = document.getElementById('btnScrollTop');

	window.addEventListener('scroll', () => {
		if (window.pageYOffset > 300) {
		  	if (!btn.classList.contains('scrollDown')) {
		  		btn.classList.remove('scrollTop');
				btn.style.display = 'block';
		  		btn.classList.add('scrollDown');
			}
		} else {
		  	if (btn.classList.contains('scrollDown')) {
		  		btn.classList.remove('scrollDown');
		  		btn.classList.add('scrollTop');
		  	}
	  	}
	});


	btn.addEventListener('click', () => {
		let currentPosition = window.pageYOffset, count = 1;
		const auxCurrentPosition = currentPosition;
		
		window.requestAnimationFrame(scrollTop);
		function scrollTop() {
			if (currentPosition >= 500 && currentPosition <= auxCurrentPosition) {
				count = count + 3;
				currentPosition -= count;
				window.scrollTo(0, currentPosition);
				window.requestAnimationFrame(scrollTop);
			} else if (currentPosition >= 200 && currentPosition <= 499) {
				count = count + 4;
				currentPosition -= count;
				window.scrollTo(0, currentPosition);
				window.requestAnimationFrame(scrollTop);
			} else if (currentPosition >= 100 && currentPosition <= 199) {
				count = count + 3;
				currentPosition -= count;
				window.scrollTo(0, currentPosition);
				window.requestAnimationFrame(scrollTop);
			} else if (currentPosition <= 99) {
				currentPosition = currentPosition - 3;
				if (currentPosition > 0) {
					window.scrollTo(0, currentPosition);
					window.requestAnimationFrame(scrollTop);
				} else {
					window.scrollTo(0, 0);
				}
			}
		}

	});

	// DEFINIR O FOOTER SEMPRE NO FIM DA PÁGINA
	const headerHeight = document.querySelector('header').offsetHeight;
	const footerHeight = document.querySelector('footer').offsetHeight;
	const headerAndFooterHeight = headerHeight + footerHeight;

	const main = document.querySelector('header + main');
	main.style.minHeight = `calc(100vh - ${headerAndFooterHeight}px)`;

})();