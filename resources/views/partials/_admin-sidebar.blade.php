<div class="container-fluid">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.home') }}">  <i class="fas fa-tachometer-alt"></i> Dashboard</a>
        </li> <div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.loans') }}"> <i class="fas fa-hand-holding-usd"></i> Loans</a>
        </li> <div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.users') }}"> <i class="fas fa-users"></i> Users</a>
        </li> <div class="dropdown-divider"></div>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('show.send-email-form') }}"> <i class="fas fa-envelope"></i> Send an Email</a>
        </li> <div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('show.send-text-form') }}"> <i class="fas fa-sms"></i> Send Text Message</a>
        </li><div class="dropdown-divider"></div>


        <li class="nav-item">
            <a class="nav-link" href="{{ route('referral.code') }}"><i class="fas fa-qrcode"></i> Generate Referral Code</a>
        </li><div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('assign.referral-code-form') }}"><i class="fas fa-qrcode"></i> Assign Referral code To User Code</a>
        </li><div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('groups.index') }}"><i class="fas fa-users"></i> Groups</a>
        </li><div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('groups.create') }}"> <i class="far fa-plus-square"></i> Create Group</a>
        </li><div class="dropdown-divider"></div>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.register') }}"> <i class="far fa-plus-square"></i> Create Admin</a>
        </li><div class="dropdown-divider"></div>



    </ul>
</div>
