<style>
    .imgrounded {
        border-radius: 7px
    }
</style>

<div class="sidebar">
    <div class="sidebar-inner">
        <div class="sidebar-logo">
            <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                    <a class="sidebar-link td-n" href="/dashboard">
                        <div class="peers ai-c fxw-nw">
                            <div class="peer">
                                <div class="logo"><img src="{{ asset('assets/img/logo.png') }}" class="imgrounded mt-2"
                                        alt="Logo" height="42" width="42"></div>
                            </div>
                            <div class="peer peer-greed">
                                <h5 class="lh-1 mB-0 logo-text">MyClothes</h5>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="peer">
                    <div class="mobile-toggle sidebar-toggle"><a href="" class="td-n"><i
                                class="ti-arrow-circle-left"></i></a></div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu scrollable pos-r">
            
            <li class="nav-item mT-30"><a class="sidebar-link" href="/dashboard"><span class="icon-holder">
                <i class="c-blue-500 ti-home"></i> </span><span class="title">Dashboard</span></a>
            </li>  
            {{-- User --}}
            @if(Auth::user()->role == 'Partner') 
            <li class="nav-item"><a class="sidebar-link" href="/product/myall">
                <span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i></span>
                <span class="title">Products</span></a>
            </li>  
            @endif

            {{-- Admin or Super Admin --}}
            @if(Auth::user()->role == ('Admin')||Auth::user()->role == ('Super Admin')) 
            <li class="nav-item"><a class="sidebar-link" href="/product/all">
                <span class="icon-holder"><i class="c-teal-500 ti-view-list-alt"></i></span>
                <span class="title">Products</span></a>
            </li>  
            
            <li class="nav-item"><a class="sidebar-link" href="/user/all">
                <span class="icon-holder"><i class="c-orange-500 ti-layout-list-thumb"></i></span>
                <span class="title">Partners</span></a>
            </li>  
            <li class="nav-item"><a class="sidebar-link" href="/user/all">
                <span class="icon-holder"><i class="c-red-500 ti-user"></i> </span>
                <span class="title">Users Managements</span></a>
            </li>  
            @endif
         

            <li class="nav-item"><a class="sidebar-link" href="/support">
                <span class="icon-holder"><i class="c-deep-purple-500 ti-comment-alt"></i></span>
                <span class="title">Support</span></a>
            </li>

        </ul>
    </div>
</div>