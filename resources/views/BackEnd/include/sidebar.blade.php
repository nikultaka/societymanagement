<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <li class="active"><a href="dashboard"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
  <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>User Management</span></a>
      <ul>
        <li><a href="block">Block List</a></li>
        <li><a href="member">Member List</a></li>
        <li><a href="house">House List</a></li>
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Receipt Management</span></a>
      <ul>
        <li><a href="payment">Payment List</a></li>
        <li><a href="charges">Charges List</a></li>
        <li><a href="receipt">Receipt List</a></li>
       
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Expenses Management</span> </a>
      <ul>
        <li><a href="expense">Expenses List</a></li>
      </ul>
    </li>
    <li><a href="transfer"><i class="icon icon-tint"></i> <span>Transfer Member</span></a></li>
     <li><a href="report"><i class="icon icon-tint"></i> <span>Report</span></a></li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Document Upload</span> </a>
      <ul>
        <li><a href="">Add Document</a></li>
        <li><a href="">List Document</a></li>
      </ul>
    </li>
    <li class="submenu"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon icon-home"></i> <span>Logout</span></a> </li>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
  </ul>
</div>