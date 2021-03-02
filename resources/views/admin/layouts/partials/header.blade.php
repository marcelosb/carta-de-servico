<div id="menuIcon" class="menu--icon">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#242939" width="20px" height="20px">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"/>
    </svg>
</div>
<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        @if(Auth::user()->avatar === 'default')
            <img src="{{ asset('images/avatar.svg') }}" width="30px" height="30px" alt="Avatar padrão">
        @else
            <img class="rounded-circle" src="{{ asset(Auth::user()->avatar) }}" width="30px" height="30px" alt="Avatar">
        @endif
        {{ Auth::user()->name }}
    </button>
    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item text-center" href="{{ route('dashboard.user.profile.index') }}">Meus dados</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <a class="dropdown-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-transparent w-100 border-0 text-white">Sair</button>
                </form>
            </a>
        </li>
    </ul>
</div>