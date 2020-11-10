<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part" style="width: 35%">
            <a class="logo" href="#">
                <span class="for_mobile">SK</span>
                <span class="hidden-xs">
                    <span style="margin-left: 8px;font-weight: bold">Setia Kawan</span>
                </span>
            </a>
        </div>
        <ul class="nav navbar-top-links navbar-left">
            <li>
                <a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs">
                    <i class="ti-close ti-menu"></i>
                </a>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                    <b class="hidden-xs">{{ Auth::user()->name }}</b>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated slideInDown">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-text">
                                <h4>{{ Auth::user()->name }}</h4>
                                <p class="text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                    </li>
                    <!--                    <li role="separator" class="divider"></li>
                    <li><a href="#" ><i class="fa fa-user"></i> Edit Profil</a></li>-->
                    <li role="separator" class="divider"></li>
                    <li>
                        <a href="#" data-toggle="modal" data-target=".logoutModal">
                            <i class="fa fa-power-off"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
