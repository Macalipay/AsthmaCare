<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="#">
        <img src="/img/logo.png" width="100%" alt="">    
    </a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            {{-- <img src="{{ asset('/img/logo.png')}}" class="img-fluid rounded-circle mb-2" alt="Linda Miller" /> --}}
            <div class="font-weight-bold">{{ Auth::user()->firstname.' '.Auth::user()->lastname}}</div>
            <small>{{Auth::user()->roles->first()->name}}</small>
        </div>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('dashboard')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-chart-pie" style="color: #153d77"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            @role('Admin|Moderator|Doctor|Staff')
            <li class="sidebar-header">
                Monitoring
            </li>
            @endrole

            @role('Admin|Moderator')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('company')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-list" style="color: #153d77"></i> <span class="align-middle">Clinic/Hospital</span>
                </a>
            </li>
            @endrole

            @role('Doctor|Staff|Admin|Moderator')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('patient')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-list" style="color: #153d77"></i> <span class="align-middle">Patient List</span>
                </a>
            </li>
{{-- 
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-history" style="color: #153d77"></i> <span class="align-middle">Patient History</span>
                </a>
            </li> --}}
            @endrole

            @role('Staff|Admin|Moderator')
            <li class="sidebar-item">
                <a class="sidebar-link" href="/doctors">
                    <i class="align-middle mr-2 fa fa-fw fa-users" style="color: #153d77"></i> <span class="align-middle">Doctor</span>
                </a>
            </li>
            @endrole
            
            @role('Admin|Moderator')
            
            <li class="sidebar-item">
                <a class="sidebar-link" href="/staff">
                    <i class="align-middle mr-2 fa fa-fw fa-users" style="color: #153d77"></i> <span class="align-middle">Staff</span>
                </a>
            </li>
            <li class="sidebar-header">
                Accounts
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="/users">
                    <i class="align-middle mr-2 fa fa-fw fa-users" style="color: #153d77"></i> <span class="align-middle">User</span>
                </a>
            </li>
{{-- 
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('users/admin') }}">
                    <i class="align-middle mr-2 fa fa-fw fa-user-tie" style="color: #153d77"></i> <span class="align-middle">Admin</span>
                </a>
            </li> --}}
            @endrole

            @role('Doctor|Staff|Admin|Moderator')
            <li class="sidebar-header">
                Schedulling
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('appointment')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-calendar-alt" style="color: #153d77"></i> <span class="align-middle">Appointment</span>
                </a>
            </li>

            <li class="sidebar-header">
                Maintenance
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="/asthma">
                    <i class="align-middle mr-2 fa fa-fw fa-file-word" style="color: #153d77"></i> <span class="align-middle">Type of Asthma</span>
                </a>
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="/symptoms">
                    <i class="align-middle mr-2 fa fa-fw fa-file-word" style="color: #153d77"></i> <span class="align-middle">Symptoms</span>
                </a>
            </li>
            
            <li class="sidebar-item">
                <a class="sidebar-link" href="/first-aid">
                    <i class="align-middle mr-2 fa fa-fw fa-first-aid" style="color: #153d77"></i> <span class="align-middle">First Aid</span>
                </a>
            </li>
            @endrole('Doctor')
        </ul>
    </div>
</nav>
