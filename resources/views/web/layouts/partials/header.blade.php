<main class="wrapper">
    <h1>
        <a href="{{ route('web.home') }}">{!! logo('web') !!}</a>
    </h1>
    <nav>
        <ul>
            <li><a href="{{ route('web.faq') }}">Perguntas frequentes</a></li>
            <li><a href="https://saobento.1doc.com.br/b.php?pg=wp/detalhes&itd=8" target="_blank" rel="noopener noreferrer">Acesso à informação</a></li>
        </ul>
    </nav>  
</main>

<div class="menu-mobile">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#003D6B" width="40px" height="40px">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
    </svg>
</div>

<nav class="nav-menu-mobile">
    <ul>
        <li><a href="{{ route('web.faq') }}">PERGUNTAS FREQUENTES</a></li>
        <li><a href="https://saobento.1doc.com.br/b.php?pg=wp/detalhes&itd=8" target="_blank" rel="noopener noreferrer">ACESSO A INFORMAÇÃO</a></li>
    </ul>
</nav>