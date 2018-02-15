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

		<div class="row">

			@yield('heading')

			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				<ul id="sparks" class="">
					<li class="sparks-info">
						<h5> My Income <span class="txt-color-blue">$1</span></h5>
						<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
							1
						</div>
					</li>
					<li class="sparks-info">
						<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;100%</span></h5>
						<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
							100
						</div>
					</li>
					<li class="sparks-info">
						<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;3</span></h5>
						<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
							1, 2, 3
						</div>
					</li>
				</ul>
			</div>
		</div>

		@yield('content')

	</section>
	<!-- END MAIN CONTENT -->
</main>