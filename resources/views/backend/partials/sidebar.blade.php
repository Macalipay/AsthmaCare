<nav id="sidebar" class="sidebar">
    <a class="sidebar-brand" href="#">
  <svg>
    <use xlink:href="#ion-ios-pulse-strong"></use>
  </svg>
  AsthmaCare
</a>
    <div class="sidebar-content">
        <div class="sidebar-user">
            <img src="{{ asset('docs/img/avatars/avatar.jpg')}}" class="img-fluid rounded-circle mb-2" alt="Linda Miller" />
            <div class="font-weight-bold">Haringa Christian</div>
            <small>Doctor</small>
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
           

            <li class="sidebar-header">
                Monitoring
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('patient')}}">
                    <i class="align-middle mr-2 fa fa-fw fa-list" style="color: #153d77"></i> <span class="align-middle">Patient List</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-history" style="color: #153d77"></i> <span class="align-middle">Patient History</span>
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
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-users" style="color: #153d77"></i> <span class="align-middle">Employee</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-user-tie" style="color: #153d77"></i> <span class="align-middle">Admin</span>
                </a>
            </li>

            <li class="sidebar-header">
                Schedulling
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-calendar-alt" style="color: #153d77"></i> <span class="align-middle">Appointment</span>
                </a>
            </li>

            <li class="sidebar-header">
                Reports
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-user-clock" style="color: #153d77"></i> <span class="align-middle">Logs</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-user-check" style="color: #153d77"></i> <span class="align-middle">Accept Patients</span>
                </a>
            </li>

            <li class="sidebar-header">
                Maintenance
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="#">
                    <i class="align-middle mr-2 fa fa-fw fa-file-word" style="color: #153d77"></i> <span class="align-middle">Type of Asthma</span>
                </a>
            </li>
           
            <li class="sidebar-item">
                <a class="sidebar-link" href="/symptoms">
                    <i class="align-middle mr-2 fa fa-fw fa-file-word" style="color: #153d77"></i> <span class="align-middle">Symptoms</span>
                </a>
            </li>
        </ul>
    </div>
</nav>