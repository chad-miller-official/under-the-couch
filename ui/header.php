<header>
	<h1>Under The Couch</h1>
	<nav>
		Welcome, <?= SessionLib::get( 'user_member.name' ) ?: 'guest' ?>!
	</nav>
	<br />
	<nav>
		<ul class="main-nav">
			<li><a href="/index.php" class="main-nav-drop-head">Home</a></li>
			<li><a href="/calendar.php" class="main-nav-drop-head">Calendar</a></li>
            <li class="main-nav-drop">
                <a href="#" class="main-nav-drop-head">Dashboards</a>
                <div class="main-nav-drop-content">
                    <? if( access_allowed( 'dashboard/booking/index.php' ) ): ?>
                        <a href="/booking/requests.php">Booking Requests</a>
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
				<li><a href="/user/login.php" class="main-nav-drop-head">Login</a></li>
			<? else: ?>
				<li><a href="javascript:void(0)" class="main-nav-drop-head" id="logout">Logout</a></li>
			<? endif; ?>
		</ul>
	</nav>
</header>
<br />
