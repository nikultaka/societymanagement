@include('BackEnd.include.head')   
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Matrix Admin</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome {{ Auth::user()->name }}</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        
        <li class="divider"></li>
        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
    <li class=""><a title="" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<!--<div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>-->
<!--close-top-serch-->
<!--sidebar-menu-->
@include('BackEnd.include.sidebar') 
<!--sidebar-menu-->

<!--main-container-part-->

<!--End-breadcrumbs-->
<!--Main Frame Content Go here-->
<div id="content">
    <div  class="quick-actions_homepage" style="margin-left: 20px;">
    <ul class="quick-actions">
      <li class="bg_lb"> <a href="#"> <i class="icon-dashboard"></i> My Dashboard </a> </li>
      <li class="bg_lg"> <a href="#"> <i class="icon-shopping-cart"></i> Shopping Cart</a> </li>
      <li class="bg_ly"> <a href="#"> <i class=" icon-globe"></i> Web Marketing </a> </li>
      <li class="bg_lo"> <a href="#"> <i class="icon-group"></i> Manage Users </a> </li>
      <li class="bg_ls"> <a href="#"> <i class="icon-signal"></i> Check Statistics</a> </li>
    </ul>
  </div> 
@yield('content')
<!--Action boxes-->
  </div>


<!--end-main-container-part-->

<!--Footer-part-->

@include('BackEnd.include.footer') 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
</body>
</html>
