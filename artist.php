<?php
    include("includes/includedFiles.php");
    if(isset($_GET['id'])){
			$artistId = $_GET['id']; //id from url is now in albumId
    }
    else {
			header("Location: index.php");  //TODO: error page
    }

    $artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">
	<div class="centerSection">
		<div class="artistInfo">
			<h1 class="artistName"><?php echo $artist->getName(); ?></h1>
			<div class="headerButtons">
				<button class="button green" onclick="playFirstSong()">play</button>
			</div>
		</div>
	</div>
</div>

<div class="trackListContainer borderBottom">
	<h2>songs</h2>
	<ul class="trackList">

		<?php
			//list out tracks in album
			$songIdArray = $artist->getSongIds();
			$i=1;
			foreach($songIdArray as $songId) {
				$albumSong = new Song($con, $songId);
				$albumArtist = $albumSong->getArtist();

				echo "<li class='tracklistRow'>
								<div class='trackCount'>
									<img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
									<span class='trackNumber'>$i</span>
								</div>

								<div class='trackInfo'>
									<span class='trackName'>" . $albumSong->getTitle() .  "</span>
									<span class='artistName'>" . $albumArtist->getName() . "</span>
								</div>

								<div class='trackOptions'>
									<input type='hidden' class='songId' value='" . $albumSong->getId() . "'>
									<img class='optionsButton' src='assets/images/icons/more.png' alt='options' onclick='showOptionsMenu(this)'>
								</div>

								<div class='trackDuration'>
									<span class='duration'>" . $albumSong->getDuration() . "</span>
								</div>
							</li>";
				$i++;
			}
		?>

		<script>
			var tempSongIds = '<?php echo json_encode($songIdArray); ?>';
			tempPlaylist = JSON.parse(tempSongIds);
		</script>

	</ul>
</div>

<div class="gridViewContainer">
    <h2>albums</h2>
	<?php 
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artist='$artistId'");

		//goes through each row in albums table
		while($row = mysqli_fetch_array($albumQuery)) { 
			echo "<div class='gridViewItem'>
					<a role='link' tabIndex='0' href='album.php?id=". $row['id'] ."'>
						<img src='" . $row['artworkPath'] . "'>
						<div class='gridViewInfo'>" 
							. $row['title'] .
						"</div>
					</a>
				</div>";
		}
	?>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>