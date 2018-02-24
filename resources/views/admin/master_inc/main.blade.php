<!-- MAIN PANEL -->
<main id="main" role="main">
	<!-- RIBBON -->
	<section id="ribbon">

		<span class="ribbon-button-alignment"> 
			<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh" rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true"><i class="fa fa-refresh"></i></span> 
		</span>

		<!-- breadcrumb -->
		<ol class="breadcrumb">
			@yield('breadcrumbs')
		</ol>
		<!-- end breadcrumb -->

	</section>
	<!-- END RIBBON -->

	<!-- MAIN CONTENT -->
	<section id="content">

		@yield('content')

	</section>
	<!-- END MAIN CONTENT -->
</main>