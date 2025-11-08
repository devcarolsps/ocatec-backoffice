<style>
    .badge-icon{
        display: inline-block;
        padding: .25em .4em;
        font-size: .75em;
        font-weight: 700;
        line-height: 1;
        color: white;
        text-align: center;
        white-space: nowrap;
    }
    .top-0 {
        top: 0 !important;
    }
    .start-100 {
        left: 100% !important;
    }
    .translate-middle {
        -webkit-transform: translate(-50%,-50%) !important;
        transform: translate(-50%,-50%) !important;
    }
</style>
<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        <li class="dropdown notification-list" id="btnTourNotification">
            <a  class="nav-link dropdown-toggle arrow-none" data-bs-toggle="dropdown" href="#" id="topbar-notifydrop" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="dripicons-bell noti-icon"></i>
                <span class="top-0 start-100 translate-middle badge-icon rounded-pill bg-danger" id="totalNotification">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg" aria-labelledby="topbar-notifydrop">

                <!-- item-->
                <div class="dropdown-item noti-title px-3">
                    <h5 class="m-0">
                        <span class="float-end">
                            <a href="javascript: void(0);" class="text-dark">
                                <small>Limpar Tudo</small>
                            </a>
                        </span>Notificações
                    </h5>
                </div>


                <div class="slimscroll" style="max-height: 230px;">
                    <div id="tbody-notification">

                    </div>

                </div>

                <!-- All-->
                <a href="javascript:void(0);" id="btnAllNotification" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                    Ver todos
                </a>

            </div>
        </li>


        <li class="dropdown notification-list">
            <a id="btnTourMyAccount" class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{ isset(Auth::user()->logo) ? asset('storage/logos/'.Auth::user()->logo) : asset('img/logos/sua-foto.png') }}" alt="user-image" class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                    <span class="account-position">{{ date("d/m/Y H:i:s", strtotime(date('Y-m-d H:i:s'))) }}</span>
                </span>
            </a>
            <div   class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Olá !</h6>
                    <h6 class="text-overflow m-0"> </h6>
                </div>
                <hr>
                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout mr-1"></i>
                    <span>Sair</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>


            </div>
        </li>

    </ul>

    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>

</div>
