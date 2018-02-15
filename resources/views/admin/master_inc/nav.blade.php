<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<section id="shortcut">
	<ul>
		<li>
			<a href="/inbox.php" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
		</li>
		<li>
			<a href="/calendar.php" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
		</li>
		<li>
			<a href="/gmap-xml.php" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
		</li>
		<li>
			<a href="/invoice.php" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
		</li>
		<li>
			<a href="/gallery.php" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
		</li>
		<li>
			<a href="/profile.php" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
		</li>
	</ul>
</section>
<!-- END SHORTCUT AREA -->

<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
<aside id="left-panel">

	<!-- User info -->
	<div class="login-info">
		<span> <!-- User image size is adjusted inside CSS, it should stay as is -->

			<a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
				<img src="{{URL::to('/assets/admin/')}}/img/avatars/male.png" alt="me" class="online" />
				<span>
					eduard.robu
				</span>
				<i class="fa fa-angle-down"></i>
			</a>

		</span>
	</div>
	<!-- end user info -->

	<!-- NAVIGATION : This navigation is also responsive

	To make this navigation dynamic please make sure to link the node
	(the reference to the nav > ul) after page load. Or the navigation
	will not initialize.
	-->
	<nav>
		<!-- NOTE: Notice the gaps after each icon usage <i></i>..
		Please note that these links work a bit different than
		traditional hre="" links. See documentation for details.
		-->
		<!-- NAVIGATION : This navigation is also responsive -->
		<ul>
			@foreach ($config_menu as $menu)
				<li class="@if (isset($menu['active']) && $menu['active']) active @endif   @if (isset($menu['submenus']) && count($menu['submenus']) > 0) @endif">
					<a href="@if (isset($menu['submenus']) && count($menu['submenus']) > 0)# @else /{{$menu['url']}}@endif"><i class="fa fa-lg fa-fw {{ $menu['class'] }}"></i> <span class="menu-item-parent">{{ $menu['name'] }}</span></a>


					@if (isset($menu['submenus']) && count($menu['submenus']))
						<ul>
							@foreach($menu['submenus'] as $menu_item)
								<li class="@if (isset($menu_item['active']) && $menu_item['active']) active @endif">
									<a href="/{{ $menu_item['url'] }}">{{ $menu_item['name'] }}</a>
								</li>
							@endforeach
						</ul>
					@endif
				</li>
			@endforeach
		</ul>
		<!-- END NAVIGATION -->


	</nav>
	<span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>

</aside>
<!-- END NAVIGATION -->