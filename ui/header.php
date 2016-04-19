<header>
	<h1>Under The Couch</h1>

	<nav>
		Welcome, <?= $GLOBALS['session_member']['name'] ?: 'guest' ?>!
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
						<li><a href="/info/mn.php">Musician's Network</a></li>
						<li><a href="/info/openmic.php">Open Mic Night</a></li>
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
						<li><a href="/booking/gtorg.php">GT Organization</a></li>
						<li><a href="/booking/record.php">Schedule Recording</a></li>
					</ul>
			</li>
			<li>
				Contacts
					<ul class="subnav">
						<li><a href="/contacts/contact.php?name=president">President</a></li>
						<li><a href="/contacts/contact.php?name=vicepresident">Vice President</a></li>
						<li><a href="/contacts/contact.php?name=generalmanager">General Manager</a></li>
						<li><a href="/contacts/contact.php?name=treasurer">Treasurer</a></li>
						<li><a href="/contacts/contact.php?name=secretary">Secretary</a></li>
						<li><a href="/contacts/contact.php?name=openmic">Open Mic</a></li>
						<li><a href="/contacts/contact.php?name=it">Webmaster</a></li>
						<li><a href="/contacts/contact.php?name=booking">Booking Agent</a></li>
						<li><a href="/contacts/contact.php?name=equipment">Equipment Manager</a></li>
						<li><a href="/contacts/contact.php?name=mop">Minister of Propaganda</a></li>
						<li><a href="/contacts/contact.php?name=advertising">Advertising</a></li>
						<li><a href="/contacts/contact.php?name=historian">Historian</a></li>
					</ul>
			</li>

			<? if( !is_logged_in() ): ?>
				<li><a href="/login.php">Login</a></li>
			<? else: ?>
				<li><a href="/logout.php">Logout</a></li>
			<? endif; ?>

		</ul>
	</nav>
</header>

<br />
