<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('Sancofa.Index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
          {{-- <i class="fas fa-laugh-wink"></i> --}}
          <img src="{{asset('/image/A.png')}}" width="60rem" height="60rem">
        </div>
        <div class="sidebar-brand-text mx-3">Sankofa</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{route('Sancofa.Index')}}">
          <i class="fas fa-fw fa-home"></i>
          <span>Home</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Member Tools
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-user"></i>
          <span>Members</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Member Info</h6>
            <a class="collapse-item" href="{{route('Sancofa.Members.AllMembers')}}">All Members</a>
            <a class="collapse-item" href="{{route('Sancofa.Members.Add')}}">Add New Member</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      @if(Auth::guard('sancofa')->user()->role == 'admin')
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Admin Tools</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Admin:</h6>
            {{-- <a class="collapse-item" href="{{route('Sancofa.Department.RegisteredDepartment')}}">Department</a> --}}
            <a class="collapse-item" href="{{route('Sancofa.ActiveMembers.ListOfActiveMembers')}}">Active Members</a>
            <a class="collapse-item" href="{{route('Sancofa.RankOfReaders')}}">Rank Of Readers</a>
            <a class="collapse-item" href="{{route('Sancofa.Books.RankOfYear')}}">Books Rank</a>
            <a class="collapse-item" href="{{route('Sancofa.Books.CountBooks.Index')}}">Count Books</a>
            <a class="collapse-item" href="{{route('Sancofa.Setting.Home')}}">Setting</a>
            <a class="collapse-item" href="{{route('Sancofa.Others.Index')}}">Others</a>


          </div>
        </div>
      </li>
      @endif

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Book Tool
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-book"></i>
          <span>Books</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Book Info:</h6>
            <a class="collapse-item" href="{{route('Sancofa.Books.Add')}}">Add New Book</a>
            <a class="collapse-item" href="{{route('Sancofa.Books.AllBooks')}}">All Books</a>
            <a class="collapse-item" href="{{route('Sancofa.Books.AllReservedBooks')}}">Reserved Books</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Book and Members:</h6>
            <a class="collapse-item" href="{{route('Sancofa.Books.Borrowing')}}">Lend Book</a>
            <a class="collapse-item" href="{{route('Sancofa.Books.AllBorrowedBooks')}}">Borrowed Book</a>
            <a class="collapse-item" href="{{route('Sancofa.Books.BookStatus')}}">Book Status</a>

          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('Sancofa.Punishment.Show')}}">
          <i class="fas fa-fw fa-coins"></i>
          <span>Punishment</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="{{route('Sancofa.About')}}">
          <i class="fas fa-fw fa-table"></i>
          <span>About Sancofa DLMS</span>
        </a>
        <a class="nav-link" href="{{route('Sancofa.Others.MonthlyPayment')}}">
          <i class="fas fa-fw fa-coins"></i>
          <span>Monthly Payment</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
