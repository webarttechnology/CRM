			<!-- Sidebar -->
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                	<form action="search.html" class="mobile-view">
						<input class="form-control" type="text" placeholder="Search here">
						<button class="btn" type="button"><i class="fa fa-search"></i></button>
					</form>
					<div id="sidebar-menu" class="sidebar-menu">

						<ul>


							<li class="nav-item nav-profile">
				              <a href="#" class="nav-link">
				                <div class="nav-profile-image">
									@if (Auth::user()->user_image)
									<img alt="" src="{{ url(Auth::user()->user_image) }}">
									@else
									<img alt="" src="{{ url('panel/assets/img/profiles/user-profile.png') }}">
									@endif
				                </div>
				                <div class="nav-profile-text d-flex flex-column">
				                  <span class="font-weight-bold mb-2">{{  Str::limit(Auth::user()->name, 20, '...') }}</span>
				                  <span class="text-white text-small">{{  role()[Auth::user()->role_id] }}</span>
				                </div>
				                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
				              </a>
				            </li>
							<li class="menu-title"> 
								<span>Main</span>
							</li>

							<li>
								<a href="{{ url('/') }}" class=" {{ Request::segment(1) == 'dashboard' ? 'active' : '' }} "><i class="feather-home"></i> <span> Dashboard</span> </a>
							</li>

							<li>
								<a href="#" class="open-chat-module"><i class="feather-message-circle"></i> <span> Chat</span></a>
								<span class="menu-arrow"></span>
							</li>


							@if(Auth::user()->role_id == 3)

							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'task' ? 'active' : '' }}"><i class="feather-grid"></i> <span>Task</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('task.index') }}">Task</a></li>
								</ul>
							</li>
							
							@endif


							@if(Auth::user()->role_id == 4 || Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
							<li class="submenu">
								<a href="#" class="{{ Request::segment(2) == 'client' ? 'active' : '' }}"><i class="feather-users"></i> <span>Client</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('sales.client.list') }}">Client list</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'sales' && Request::segment(2) == 'list'  ? 'active' : '' }}"><i class="feather-grid"></i> <span>Sales</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('sales.new.list') }}">Sales list</a></li>
								</ul>
							</li>
							
							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'group' && Request::segment(2) == 'list'  ? 'active' : '' }}"><i class="feather-grid"></i> <span>Group</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('group.new.list') }}">Group list</a></li>
								</ul>
							</li>
							@endif

							@if(Auth::user()->role_id == 2 || Auth::user()->role_id == 1)

							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'upsales' ? 'active' : '' }}"><i class="feather-trending-up"></i> <span>Upsales</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('upsale.list') }}">Upsales list</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'collection' ? 'active' : '' }}"><i class="feather-shopping-bag"></i> <span>Collection</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('collection.list') }}">Collection list</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'renewal' ? 'active' : '' }}"><i class="feather-repeat"></i> <span>Renewal</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('domain.renewal.list') }}">Renewal list</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#" class="{{ Request::segment(1) == 'employee' ? 'active' : '' }}"><i class="feather-user"></i><span>Employee</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('user.index') }}">Employee list</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#" class=" {{ Request::segment(2) == 'task' ? 'active' : '' }} "><i class="feather-check-square"></i> <span>Development Task</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('developer.task') }}">Task list</a></li>
								</ul>
							</li>

							<li class="submenu">
								<a href="#" class=" {{ Request::segment(1) == 'log' ? 'active' : '' }} "><i class="feather-file-text"></i> <span>Log History</span>
									<span class="menu-arrow"></span>
								</a>
								<ul class="sub-menus">
									<li><a href="{{ route('log.history') }}">Log list</a></li>
								</ul>
							</li>

							@endif


							@if(Auth::user()->role_id == 5 || Auth::user()->role_id == 6 || Auth::user()->role_id == 7 || Auth::user()->role_id == 8)
								<li class="submenu">
									<a href="#" class=" {{ Request::segment(2) == 'task' ? 'active' : '' }} "><i class="feather-check-square"></i><span>Task</span>
										<span class="menu-arrow"></span>
									</a>
									<ul class="sub-menus">
										<li><a href="{{ route('developer.task') }}">Task list</a></li>
									</ul>
								</li>
							@endif    



						</ul>
					</div>
           </div>
  </div>