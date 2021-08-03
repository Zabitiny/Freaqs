<?php
	// used in navBarContainer.php with the search bar
	include("includes/config.php");
	include("includes/classes/Artist.php");
	include("includes/classes/Album.php");
	include("includes/classes/Song.php");
	include("includes/classes/Playlist.php");

	if(isset($_POST['search'])) {
		$input = "{$_POST['search']}%";
		if($input != '%') {
			$songQuery = mysqli_query($con, "SELECT id
																			FROM songs
																			WHERE title LIKE '$input'");
			$artistQuery = mysqli_query($con, "SELECT id
																				FROM artists
																				WHERE name LIKE '$input'");
			$albumQuery = mysqli_query($con, "SELECT id
																				FROM albums
																				WHERE title LIKE '$input'");
			$playlistQuery = mysqli_query($con, "SELECT id
																					FROM playlists
																					WHERE name LIKE '$input'");
			if(mysqli_num_rows($songQuery) > 0
				|| mysqli_num_rows($artistQuery) > 0
				|| mysqli_num_rows($albumQuery) > 0
				|| mysqli_num_rows($playlistQuery) > 0) {
				while($row = mysqli_fetch_array($songQuery)) { 
					$song = new Song($con, $row['id']);
					$songArtist = $song->getArtist();
					$songAlbum = $song->getAlbum();
					echo "<li style='background: url(". $songAlbum->getArtworkPath() .") no-repeat 0 0; background-size: 25px 25px;'>
							<a href='album.php?id=". $songAlbum->getId() ."'>
								<div class='searchItem'>"
									. $songArtist->getName() ." - \"". $song->getTitle() . "\"" .
								"</div>
							</a>
						</li>";
				}
				while($row = mysqli_fetch_array($artistQuery)) {
					$artist = new Artist($con, $row['id']);
					echo "<li style='background: url(assets/images/icons/search.png) no-repeat 0 0; background-size: 25px 25px;'>
							<a href='artist.php?id=". $artist->getId() ."'> 
								<div class='searchItem'>"	
									. $artist->getName() .
								"</div>
							</a>
						</li>";
				}
				while($row = mysqli_fetch_array($albumQuery)) {
					$album = new Album($con, $row['id']);
					echo "<li style='background: url(". $album->getArtworkPath() .") no-repeat 0 0; background-size: 25px 25px;'>
							<a href='album.php?id=". $album->getId() ."'> 
								<div class='searchItem'>"	
									. $album->getTitle() .
								"</div>
							</a>
						</li>";
				}
				while($row = mysqli_fetch_array($playlistQuery)) {
					$playlist = new Playlist($con, $row['id']);
					echo "<li style='background: url(assets/images/icons/playlist.png) no-repeat 0 0; background-size: 25px 25px;'>
							<a href='playlist.php?id=". $playlist->getId() ."'> 
								<div class='searchItem'>"	
									. $playlist->getName() .
								"</div>
							</a>
						</li>";
				}
			}
			else {
				echo "No results";
			}
		}
		
	}
?>