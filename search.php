<?php
    include("includes/includedFiles.php");

    if(isset($_GET['userInput'])) {
        $userInput = urldecode($_GET['userInput']);   // gets value from url
    }
    else{
        $userInput = "";
    }
?>

<div class="searchContainer">

    <h4>search for an artist, album, or song</h4>
    <input type="text" class="searchInput" value="<?php echo $userInput; ?>" placeholder="Start Typing..." onfocus="this.selectionStart = this.selectionEnd = this.value.length;">
</div>

<script>
$(".searchInput").focus();

    $(function() {
        // sets value in the url
        $(".searchInput").keyup(function() {
            //reset timer and refresh after 500 miliseconds
            clearTimeout(timer);    
            timer = setTimeout(function() {
                var val = $(".searchInput").val();
                openPage("search.php?userInput=" + val);
            }, 500);
        })
    })
</script>

<?php if($userInput =="") exit(); ?>

<div class="trackListContainer borderBottom">
    <h2>songs</h2>
    <ul class="trackList">

        <?php
            $songsQuery = mysqli_query($con, "SELECT id FROM songs WHERE title LIKE '$userInput%' LIMIT 10");
            if(mysqli_num_rows($songsQuery) == 0) {
                echo "<span class='noResults'> no frequency found matching " . $userInput . "</span>";
            }

            // list out tracks in album
            $songIdArray = array();
            $i = 1;
            // get each result from the query
            while($row = mysqli_fetch_array($songsQuery)) {
                if($i >= 20){
                    break;
                }

                array_push($songIdArray, $row['id']);

                $albumSong = new Song($con, $row['id']);
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

<div class="artistsContainer borderBottom">
    <h2>artists</h2>

    <?php
        $artistsQuery = mysqli_query($con, "SELECT id FROM artists WHERE name LIKE '$userInput%' LIMIT 10");
        if(mysqli_num_rows($artistsQuery) == 0) {
            echo "<span class='noResults'> no artists found matching " . $userInput . "</span>";
        }

        while($row = mysqli_fetch_array($artistsQuery)) {
            $artistFound = new Artist($con, $row['id']);

            echo "<div class='searchResultRow'>

                    <div class='artistName'>

                        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() . "\")'>
                        "
                        . $artistFound->getName() .
                        "
                        </span>
                    </div>
                </div>";
        }
    ?>
</div>

<div class="gridViewContainer">
    <h2>albums</h2>
	<?php 
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE title LIKE '$userInput%' LIMIT 10");
        if(mysqli_num_rows($albumQuery) == 0) {
            echo "<span class='noResults'> no albums found matching " . $userInput . "</span>";
        }

		//goes through each row in albums table
		while($row = mysqli_fetch_array($albumQuery)) { 
			echo "<div class='gridViewItem'>
					<span role='link' tabIndex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
						<img src='" . $row['artworkPath'] . "'>

						<div class='gridViewInfo'>" 
							. $row['title'] .
						"</div>
					</span>
				</div>";
		}
	?>
</div>

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>