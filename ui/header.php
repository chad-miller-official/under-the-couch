<header>
	<h1>Under The Couch</h1>

	<nav>
		Welcome, <?= SessionLib::get( 'user_member.name' ) ?: 'guest' ?>!
	</nav>
	<br />

	<nav>
		<ul class="mainnav">
			<li><a href="/index.php">Home</a></li>
			<li><a href="/calendar.php">Calendar</a></li>
			<li>
				Info
					<ul class="subnav">
						<li><a href="/info/about.php">About Us</a></li>
						<li><a href="/info/capabilities.php">Capabilities</a></li>
						<li><a href="/info/gtmn.php">Musician's Network</a></li>
						<li><a href="/info/open_mic.php">Open Mic Night</a></li>
					</ul>
			</li>
			<li>
				Media
					<ul class="subnav">
						<li><a href="/media/photos.php">Photos</a></li>
						<li><a href="/media/videos.php">Videos</a></li>
					</ul>
			</li>
			<li>
				Booking
					<ul class="subnav">
						<li><a href="/booking/perform.php">Bands/Promoters</a></li>
						<li><a href="/booking/gt_org.php">GT Organization</a></li>
						<li><a href="/booking/record.php">Schedule Recording</a></li>
					</ul>
			</li>
			<li>
				Contacts
					<ul class="subnav">
						<li><a href="/contacts/contact.php?name=pres">President</a></li>
						<li><a href="/contacts/contact.php?name=vp">Vice President</a></li>
						<li><a href="/contacts/contact.php?name=gm">General Manager</a></li>
						<li><a href="/contacts/contact.php?name=treas">Treasurer</a></li>
						<li><a href="/contacts/contact.php?name=sec">Secretary</a></li>
						<li><a href="/contacts/contact.php?name=om">Open Mic</a></li>
						<li><a href="/contacts/contact.php?name=it">Webmaster</a></li>
						<li><a href="/contacts/contact.php?name=ba">Booking Agent</a></li>
						<li><a href="/contacts/contact.php?name=eqm">Equipment Manager</a></li>
						<li><a href="/contacts/contact.php?name=mop">Minister of Propaganda</a></li>
						<li><a href="/contacts/contact.php?name=ao">Advertising</a></li>
					</ul>
			</li>

			<? if( !is_logged_in() ): ?>
				<li><a href="/user/login.php">Login</a></li>
			<? else: ?>
				<li><a href="javascript:void(0)" id="logout">Logout</a></li>
			<? endif; ?>

		</ul>
	</nav>
</header>

<br />
