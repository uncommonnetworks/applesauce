<!DOCTYPE html>
<!--

TABLE OF CONTENTS.

Use search to find needed section.

=====================================================

|  1. $BODY                 |  Body                 |
|  2. $MAIN_NAVIGATION      |  Main navigation      |
|  3. $NAVBAR_ICON_BUTTONS  |  Navbar Icon Buttons  |
|  4. $MAIN_MENU            |  Main menu            |
|  5. $SEARCH_RESULTS_PAGE  |  Search results page  |

=====================================================

-->


<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <base href="/" /> <!-- allows relative links to assets folder -->


    <title>
@section('title')
Applesauce:
@show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Open Sans font from Google CDN -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">

    <!-- Pixel Admin's stylesheets -->
    <link href="assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/widgets.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
    <link href="assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">


    <!-- Get jQuery from Google CDN -->
    <!--[if !IE]> -->
    <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
    <!-- <![endif]-->
    <!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
    <![endif]-->



    <!--[if lt IE 9]>
    <script src="assets/javascripts/ie.min.js"></script>
    <![endif]-->

@yield('head-tags')


</head>


<!-- 1. $BODY ======================================================================================
	
	Body

	Classes:
	* 'theme-{THEME NAME}'
	* 'right-to-left'      - Sets text direction to right-to-left
	* 'main-menu-right'    - Places the main menu on the right side
	* 'no-main-menu'       - Hides the main menu
	* 'main-navbar-fixed'  - Fixes the main navigation
	* 'main-menu-fixed'    - Fixes the main menu
	* 'main-menu-animated' - Animate main menu
-->

@yield('body-tag')


<script>var init = [];</script>


<div id="main-wrapper">


<!-- 2. $MAIN_NAVIGATION ===========================================================================

	Main navigation
-->
<div id="main-navbar" class="navbar navbar-inverse" role="navigation">
@include('common.topnav')
</div> <!-- / #main-navbar -->

<!-- /2. $END_MAIN_NAVIGATION -->


<!-- 4. $MAIN_MENU =================================================================================

		Main menu
		
		Notes:
		* to make the menu item active, add a class 'active' to the <li>
		  example: <li class="active">...</li>
		* multilevel submenu example:
			<li class="mm-dropdown">
			  <a href="#"><span class="mm-text">Submenu item text 1</span></a>
			  <ul>
				<li>...</li>
				<li class="mm-dropdown">
				  <a href="#"><span class="mm-text">Submenu item text 2</span></a>
				  <ul>
					<li>...</li>
					...
				  </ul>
				</li>
				...
			  </ul>
			</li>
-->
<div id="main-menu" role="navigation">
<div id="main-menu-inner">
<div class="menu-content top" id="menu-content-demo">
    <!-- Menu custom content demo
         CSS:        styles/pixel-admin-less/demo.less or styles/pixel-admin-scss/_demo.scss
         Javascript: html/assets/demo/demo.js
     -->
    <div>
        <div class="text-bg"><span class="text-slim">Welcome</span></div>

        <img src="assets/demo/avatars/1.jpg" alt="" class="">
        <!--
        <div class="btn-group">
            <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-envelope"></i></a>
            <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-user"></i></a>
            <a href="#" class="btn btn-xs btn-primary btn-outline dark"><i class="fa fa-cog"></i></a>
            <a href="/users/logoff" class="btn btn-xs btn-danger btn-outline dark"><i class="fa fa-power-off"></i></a>
        </div>
        -->
        <a href="#" class="close">&times;</a>
    </div>
</div>
<ul class="navigation">
    <!--
    <li>
        <a href="index.html"><i class="menu-icon fa fa-dashboard"></i><span class="mm-text">Dashboard</span></a>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-th"></i><span class="mm-text">Layouts</span></a>
        <ul>
            <li>
                <a tabindex="-1" href="layouts-grid.html"><span class="mm-text">Grid</span></a>
            </li>
            <li>
                <a tabindex="-1" href="layouts-main-menu.html"><i class="menu-icon fa fa-th-list"></i><span class="mm-text">Main menu</span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="stat-panels.html"><i class="menu-icon fa fa-tasks"></i><span class="mm-text">Stat panels</span></a>
    </li>
    <li>
        <a href="widgets.html"><i class="menu-icon fa fa-flask"></i><span class="mm-text">Widgets</span></a>
    </li>
    -->
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-desktop"></i><span class="mm-text">Downloads</span></a>
        <ul>
            <li>
                <a tabindex="-1" href="report/meals-checklist"><span class="mm-text">Meals Checklist</span></a>
            </li>
            <li>
                <a tabindex="-1" href="report/sign-in-sheet"><span class="mm-text">Sign-in Sheet</span></a>
            </li>
            <li>
                <a href="report/ow-weekly" tabindex="-1"><span class="mm-text">OW Weekly</span></a>

            </li>
            <li>
                <a tabindex="-1" href="ui-modals.html"><span class="mm-text">Modals</span></a>
            </li>
            <li>
                <a tabindex="-1" href="ui-alerts.html"><span class="mm-text">Alerts &amp; Tooltips</span></a>
            </li>
            <li>
                <a tabindex="-1" href="ui-components.html"><span class="mm-text">Components</span></a>
            </li>
            <li>
                <a tabindex="-1" href="ui-panels.html"><span class="mm-text">Panels</span></a>
            </li>
            <li>
                <a tabindex="-1" href="ui-jqueryui.html"><span class="mm-text">jQuery UI</span></a>
            </li>
            <li>
                <a tabindex="-1" href="ui-icons.html"><span class="mm-text">Icons</span></a>
            </li>
            <li>
                <a tabindex="-1" href="ui-utility-classes.html"><span class="mm-text">Utility classes</span></a>
            </li>
        </ul>
    </li>
    <!--
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-check-square"></i><span class="mm-text">Form components</span></a>
        <ul>
            <li>
                <a tabindex="-1" href="forms-layouts.html"><span class="mm-text">Layouts</span></a>
            </li>
            <li>
                <a tabindex="-1" href="forms-general.html"><span class="mm-text">General</span></a>
            </li>
            <li>
                <a tabindex="-1" href="forms-advanced.html"><span class="mm-text">Advanced</span></a>
            </li>
            <li>
                <a tabindex="-1" href="forms-pickers.html"><span class="mm-text">Pickers</span></a>
            </li>
            <li>
                <a tabindex="-1" href="forms-validation.html"><span class="mm-text">Validation</span></a>
            </li>
            <li>
                <a tabindex="-1" href="forms-editors.html"><span class="mm-text">Editors</span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="tables.html"><i class="menu-icon fa fa-table"></i><span class="mm-text">Tables</span></a>
    </li>
    <li>
        <a href="charts.html"><i class="menu-icon fa fa-bar-chart-o"></i><span class="mm-text">Charts</span></a>
    </li>
    <li class="mm-dropdown open active">
        <a href="#"><i class="menu-icon fa fa-files-o"></i><span class="mm-text">Pages</span><span class="label label-warning">Updated</span></a>
        <ul>
            <li class="active">
                <a tabindex="-1" href="pages-search.html"><span class="mm-text">Search results</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-pricing.html"><span class="mm-text">Plans &amp; pricing</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-faq.html"><span class="mm-text">FAQ</span><span class="label label-success">New</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-profile.html"><span class="mm-text">Profile</span><span class="label label-success">New</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-timeline.html"><span class="mm-text">Timeline</span><span class="label label-success">New</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-signin.html"><span class="mm-text">Sign In</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-signup.html"><span class="mm-text">Sign Up</span><span class="label label-success">New</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-signin-alt.html"><span class="mm-text">Sign In Alt</span><span class="label label-success">New</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-signup-alt.html"><span class="mm-text">Sign Up Alt</span><span class="label label-success">New</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-invoice.html"><span class="mm-text">Invoice</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-404.html"><span class="mm-text">Error 404</span></a>
            </li>
            <li>
                <a tabindex="-1" href="pages-500.html"><span class="mm-text">Error 500</span></a>
            </li>
            <li class="mm-dropdown">
                <a href="#"><i class="menu-icon fa fa-envelope"></i><span class="mm-text">Messages</span><span class="label label-success">New</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="pages-inbox.html"><span class="mm-text">Inbox</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-show-email.html"><span class="mm-text">Show message</span></a>
                    </li>
                    <li>
                        <a tabindex="-1" href="pages-new-email.html"><span class="mm-text">New message</span></a>
                    </li>
                </ul>
            </li>
            <li>
                <a tabindex="-1" href="pages-blank.html"><span class="mm-text">Blank page</span></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="complete-ui.html"><i class="menu-icon fa fa-briefcase"></i><span class="mm-text">Complete UI</span></a>
    </li>
    <li>
        <a href="color-builder.html"><i class="menu-icon fa fa-tint"></i><span class="mm-text">Color Builder</span></a>
    </li>
    <li class="mm-dropdown">
        <a href="#"><i class="menu-icon fa fa-sitemap"></i><span class="mm-text">Menu levels</span><span class="badge badge-primary">6</span></a>
        <ul>
            <li>
                <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.1</span><span class="badge badge-danger">12</span><span class="label label-info">21</span></a>
            </li>
            <li>
                <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.2</span></a>
            </li>
            <li class="mm-dropdown">
                <a tabindex="-1" href="#"><span class="mm-text">Menu level 1.3</span><span class="label label-warning">5</span></a>
                <ul>
                    <li>
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.1</span></a>
                    </li>
                    <li class="mm-dropdown">
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.2</span></a>
                        <ul>
                            <li class="mm-dropdown">
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 3.1</span></a>
                                <ul>
                                    <li>
                                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 4.1</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a tabindex="-1" href="#"><span class="mm-text">Menu level 3.2</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a tabindex="-1" href="#"><span class="mm-text">Menu level 2.2</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </li>
    -->

@yield('context-menu')


</ul> <!-- / .navigation -->


@include('common.tasks-intake')

@include('common.tasks-beds')
@include('common.tasks-lockers')





</div> <!-- / #main-menu-inner -->
</div> <!-- / #main-menu -->
<!-- /4. $MAIN_MENU -->

<div id="content-wrapper">

@yield('page')


</div> <!-- / #content-wrapper -->



<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->






<!-- Pixel Admin's javascripts -->
<script src="assets/javascripts/bootstrap.min.js"></script>
<script src="assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
    init.push(function () {
        $('.add-tooltip').tooltip();


    });
    window.PixelAdmin.start(init);


</script>


@yield('footer-scripts')

</body>
</html>