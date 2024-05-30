<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">

        <ul class="side-menu metismenu">
            <li>
                <a class="active" href=""><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-bookmark"></i>
                    <span class="nav-label">My Transaction</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse" aria-expanded="false">
                    <li><a href="">Booked Ticket History</a></li>
                    <li><a href="">Complete Booking</a></li>
                    <li><a href="">Failed Transaction History</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                    <span class="nav-label">PNR Status </span></a>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-eye-slash"></i>
                    <span class="nav-label"> Chnage Password</span></a>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">Profile Update</span></a>
            </li>
            <li>

                <a class="sidebar-item-icon fa fa-power-off" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <span class="nav-label"> {{ __('Logout') }}</span>
                </a>

            </li>
        </ul>
    </div>
</nav>
