<style>
.panel-list li ul li {
	padding: 5px 20px 5px 20px;
}
</style>
<div id="hoeapp-container" hoe-lpanel-effect="default">
	<aside id="hoe-left-panel" hoe-position-type="absolute"
		style="height: 50px; overflow: scroll">
		<div class="profile-box">
			<div class="media">
				<a class="pull-left" href="#/home" style="text-decoration: none">
					<div class="media-body">
						<h5 class="media-heading">
							Welcome! <b style="color: #06f"><?=$this->session->userdata('name');?></b>
						</h5>
						<small style="color: #06f">Administrator</small>
					</div>
				</a>
			</div>
		</div>
		<ul class="nav panel-list">

			<li><a accesskey="h" href="#/home"><i class="fa fa-dashboard"></i>
				<span class="menu-text">Das<u><b>h</b></u>board
				</span><span class="selected"></span></a>
			</li>
			<li class="sidepadding"><a accesskey="m" href="#/blog"><i
			class="fa fa-bullhorn"></i><span class="menu-text">Blog</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/booking"><i
			class="fa fa-list"></i><span class="menu-text">Bookings</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/contact"><i
			class="fa fa-list"></i><span class="menu-text">Contacts</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/newsletter"><i
			class="fa fa-list"></i><span class="menu-text">Newsletter</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/reviews"><i
			class="fa fa-photo"></i><span class="menu-text">Reviews</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/city"><i
			class="fa fa-photo"></i><span class="menu-text">City</span><span
			class="selected"></span></a></li>
			 
			<li class="sidepadding"><a accesskey="m" href="#/offers"><i
			class="fa fa-bullhorn"></i><span class="menu-text">Offers</span><span
			class="selected"></span></a></li>
			<!--<li class="sidepadding"><a accesskey="m" href="#/ship_main"><i
			class="fa fa-truck"></i><span class="menu-text">Shipment Orders</span><span
			class="selected"></span></a></li>
			<li class="sidepadding"><a accesskey="m" href="#/ship_tracking"><i
			class="fa fa-arrows-alt"></i><span class="menu-text">Shipment Tracking</span><span
			class="selected"></span></a></li>  -->
			<li class="sidepadding"><a accesskey="m" href="#/gallery"><i
			class="fa fa-photo"></i><span class="menu-text">Gallery</span><span
			class="selected"></span></a></li>
		</ul>
	</aside>
	<section id="main-content">