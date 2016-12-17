<header>
	<? if( !file_exists( "{$GLOBALS['webroot']}/media/oldbanner-fixed.gif" ) ): ?>
		<h1 id="site-title">Under The Couch</h1>
	<? else: ?>
		<img src="/media/oldbanner-fixed.gif" id="banner-img">
		<img/>
	<? endif ?>
	<nav>
		<ul class="main-nav">
			<li><a href="/index.php" class="main-nav-drop-head">Home</a></li>
            <li class="main-nav-drop">
                <a href="#" class="main-nav-drop-head">Dashboards</a>
                <div class="main-nav-drop-content">
                    <a href="/dashboard/calendar">Calendar</a>
                    <? if( access_allowed( 'dashboard/booking/index.php' ) ): ?>
                        <a href="/dashboard/booking">Booking Requests</a>
                    <? endif; ?>
					<? if( access_allowed( 'dashboard/admin/index.php' ) ): ?>
                        <a href="/dashboard/admin">Admin Dashboard</a>
                    <? endif; ?>
                </div>
            </li>
            <li class="main-nav-drop">
                <a href="#" class="main-nav-drop-head">Info</a>
                <div class="main-nav-drop-content">
    				<a href="/info/about.php">About Us</a>
    				<a href="/info/capabilities.php">Capabilities</a>
    				<a href="/info/gtmn.php">Musician's Network</a>
    				<a href="/info/open_mic.php">Open Mic Night</a>
					<div class="main-nav-flip">
						<a href="#" class="main-nav-flip-head">Social Media</a>
						<div class="main-nav-flip-content">
							<a href="https://www.facebook.com/underthecouch">Facebook</a>
							<a href="https://twitter.com/underthecouch/">Twitter</a>
						</div>
					</div>
    			</div>
            </li>
            <li class="main-nav-drop">
    			<a href="#" class="main-nav-drop-head">Booking</a>
                <div class="main-nav-drop-content">
    				<a href="/booking/perform.php">Bands/Promoters</a>
    				<a href="/booking/gt_org.php">GT Organization</a>
    				<a href="/booking/record.php">Schedule Recording</a>
    			</div>
            </li>
			<li class="main-nav-drop">
                <a href="#" class="main-nav-drop-head">Contacts</a>
                <div class="main-nav-drop-content">
    				<a href="/contacts/contact.php?name=pres">President</a>
    				<a href="/contacts/contact.php?name=vp">Vice President</a>
    				<a href="/contacts/contact.php?name=gm">General Manager</a>
    				<a href="/contacts/contact.php?name=treas">Treasurer</a>
    				<a href="/contacts/contact.php?name=sec">Secretary</a>
    				<a href="/contacts/contact.php?name=om">Open Mic</a>
    				<a href="/contacts/contact.php?name=it">Webmaster</a>
    				<a href="/contacts/contact.php?name=ba">Booking Agent</a>
    				<a href="/contacts/contact.php?name=eqm">Equipment Manager</a>
    				<a href="/contacts/contact.php?name=mop">Minister of Propaganda</a>
    				<a href="/contacts/contact.php?name=ao">Advertising</a>
                </div>
			</li>
			<? if( !is_logged_in() ): ?>
				<li class="main-nav-personal">
					<a href="/user/login.php" class="main-nav-drop-head">Login</a></li>
			<? else: ?>
				<li class="main-nav-personal">
					<a href="javascript:void(0)" class="main-nav-drop-head" id="logout">Logout</a></li>
				<li class="main-nav-personal">
					<a href="/user/profile.php" class="main-nav-drop-head" id="profile">Profile</a></li>
			<? endif; ?>
			<li id="welcome">
				<b>Welcome, <?= SessionLib::get( 'user_member.first_name' ) ?: 'guest' ?>!</b>
			</li>
		</ul>
	</nav>
</header>
