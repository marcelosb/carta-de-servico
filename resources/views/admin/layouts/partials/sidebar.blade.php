<span class="logo" url="{{ route('dashboard.home') }}"><span>P</span>ainel</span>
<nav>
    <ul>	

        <li>
            <a href="{{ route('dashboard.home') }}" class="{{ isActive('dashboard$') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                    <path fill="none" d="M0 0h24v24H0V0z"/>
                    <path fill="{{ isActiveIcon('dashboard$') }}" d="M12 5.69l5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3L2 12h3v8h6v-6h2v6h6v-8h3L12 3z"/>
                </svg>
                Home
            </a>
        </li>
        
        @if(hasPermission('visualizar secretaria'))
            <li>
                <a href="{{ route('dashboard.secretaries.index') }}" class="{{ isActive('secretaries') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0V0z"/>
                        <path fill="{{ isActiveIcon('secretaries') }}" d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"/>
                    </svg>
                    Secretarias
                </a>
            </li>
        @endif
        
        
        @if(hasPermission('visualizar serviço'))
            <li>
                <a href="{{ route('dashboard.services.index') }}" class="{{ isActive('services') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24">
                        <path fill="none" d="M0 0h24v24H0V0z"/>
                        <path fill="{{ isActiveIcon('services') }}" d="M8 16h8v2H8zm0-4h8v2H8zm6-10H6c-1.1 0-2 .9-2 2v16c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm4 18H6V4h7v5h5v11z"/>
                    </svg>
                    Serviços
                </a>
            </li>
        @endif
        

        @if(hasPermission('visualizar perguntas frequentes'))
            <li>
                <a href="{{ route('dashboard.faq.edit') }}" class="{{ isActive('faq') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="20px" height="20px">
                        <path  fill="none" d="M0 0h24v24H0V0z"/>
                        <path fill="{{ isActiveIcon('faq') }}" d="M20 17.17L18.83 16H4V4h16v13.17zM20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2z"/>
                    </svg>
                    FAQs
                </a>
            </li>
        @endif
        

        @if(hasPermission('visualizar usuário'))
            <li>
                <a href="{{ route('dashboard.users.index') }}" class="{{ isActive('users') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path fill="{{ isActiveIcon('users') }}" d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
                    </svg>
                    Usuários
                </a>
            </li>
        @endif

        <li id="listSubmenu">
            <a style="display:flex; justify-content:space-between; color: #899e9c;" class="{{ isActive('permissions') }}">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px" style="margin-right:15px">
                        <path d="M0 0h24v24H0z" fill="none"/>
                        <path fill="{{ isActiveIcon('permissions') }}" d="M12.65 10C11.83 7.67 9.61 6 7 6c-3.31 0-6 2.69-6 6s2.69 6 6 6c2.61 0 4.83-1.67 5.65-4H17v4h4v-4h2v-4H12.65zM7 14c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z"/>
                    </svg>
                    Acesso
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="18px" height="18px" style="margin-left: 4px">
                    <path d="M0 0h24v24H0V0z" fill="none"/>
                    <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                </svg>
            </a>
            <ul class="submenu" >
                <li><a href="#">Perfis</a></li>
                <li><a href="{{ route('dashboard.permissions.index') }}">Permissões</a></li>
            </ul>
        </li>
        
        <li>
            <a href="{{ route('dashboard.configurations.edit') }}" class="{{ isActive('configurations') }}">
                <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" viewBox="0 0 24 24" fill="#899e9c" width="18px" height="18px">
                    <g>
                        <path d="M0,0h24v24H0V0z" fill="none"/>
                        <path fill="{{ isActiveIcon('configurations') }}"  d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                    </g>
                </svg>
                Configurações
            </a>
        </li>
        

    </ul>
</nav>