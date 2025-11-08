<meta http-equiv="Cache-control" content="no-cache">
<meta http-equiv="Expires" content="-1">

<div class="leftside-menu menuitem-active">
    <!-- LOGO -->
    <a href="#" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="{{ asset('img/logos/oca-branco.png') }}" alt="logo" height="45">
        </span>
        <span class="logo-sm">
            <img src="{{ asset('img/logos/icon-branco.png') }}" alt="icone" height="45">
        </span>
    </a>


    <div class="h-100 show" id="leftside-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                         aria-label="scrollable content" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <ul class="metismenu side-nav mm-show">
                                <hr>
                                <li class="side-nav-item">
                                    <a href="/" class="side-nav-link" aria-expanded="false">
                                        <i class="uil-home-alt"></i>
                                        <span> Painel </span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a style="cursor:pointer" href="{{ url("/perfil") }}"
                                       class="side-nav-link">
                                        <i class="uil-user"></i>
                                        <span> Minha Conta </span>
                                    </a>
                                </li>

                                <li class="side-nav-title side-nav-item">Navegação</li>

                                <li class="side-nav-item">
                                    <a data-bs-toggle="collapse" href="#sidebarExtendedUIEmpreendimento" aria-expanded="true" aria-controls="sidebarExtendedUIEmpreendimento" class="side-nav-link">
                                        <i class="uil-package"></i>
                                        <span> Empreendimentos </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="collapse" id="sidebarExtendedUIEmpreendimento" style="">
                                        <ul class="side-nav-second-level">
                                            <li>
                                                <a href="{{ route('empreendimentos.hospedagens') }}">Nova hospedagens</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 1136px;">
            </div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: visible;">
            <div class="simplebar-scrollbar" style="width: 0px;">
            </div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;">
            </div>
        </div>
    </div>

</div>
<script>

</script>
