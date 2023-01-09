<div class="header navbar">
    <div class="header-container">
        <ul class="nav-left">
            <li><a id="sidebar-toggle" class="sidebar-toggle" href="javascript:void(0);"><i class="ti-menu"></i></a></li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown">
                <a href="" class="dropdown-toggle no-after peers fxw-nw ai-c lh-1" data-toggle="dropdown">
                    <div class="peer mR-10"><span class="fsz-sm c-grey-900">Welcome <strong>{{Auth::user()->name}}</strong></span></div>
                    <div class="peer mR-10"><img src="{{ asset('assets/img/'.Auth::user()->image) }}" 
                        alt="User avatar" class="imgrounded" height="35" width="35" style="border: 2px solid rgb(177, 255, 162); border-radius: 13px;"></div>
                </a>

                <ul class="dropdown-menu fsz-sm">
                    
                    <li><a href="{{ route('profile', AUTH::user()->id) }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                class="ti-user mR-10"></i> <span>Profile</span></a></li>
                    
                    <li><a href="{{ route('logout') }}" class="d-b td-n pY-5 bgcH-grey-100 c-grey-700"><i
                                class="ti-power-off mR-10"></i> <span>Logout</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
