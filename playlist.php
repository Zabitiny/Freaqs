<!-- page for displaying albums -->

<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])){
    $playlistId = $_GET['id']; //id from url is now in albumId
}
else {
    header("Location: index.php");
}

/*accessing db for artist name
$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");   //fetched album data with matching id
$album = mysqli_fetch_array($albumQuery);*/

$playlist = new Playlist($con, $playlistId);
$owner = new User($con, $playlist->getOwner());
?>

<div class="entityInfo">
    
    <div class="leftSection">
        <div class="playlistImage">
            <img src="assets/images/icons/playlist.png" alt="playlist artwork">
        </div>
    </div>

    <div class="rightSection">
        <h2><?php echo $playlist->getName(); ?></h2>
        <p>By <?php echo $playlist->getOwner(); ?></p>
        <p><?php echo $playlist->getNumSongs(); ?> songs</p>
        <button class="button" onclick="deletePlaylist('<?php echo $playlistId?>')">delete playlist</button>

    </div>

</div>

<div class="trackListContainer">

    <ul class="trackList">

        <?php
            //list out tracks in album
            $songIdArray = $playlist->getSongIds();
            $i =1;
            foreach($songIdArray as $songId) {
                $playlistSong = new Song($con, $songId);
                $songArtist = $playlistSong->getArtist();

                echo "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>

                        <div class='trackInfo'>
                            <span class='trackName'>" . $playlistSong->getTitle() .  "</span>
                            <span class='artistName'>" . $songArtist->getName() . "</span>
                        </div>

                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='" . $playlistSong->getId() . "'>
                            <img class='optionsButton' src='assets/images/icons/more.png' alt='options' onclick='showOptionsMenu(this)'>
                        </div>

                        <div class='trackDuration'>
                            <span class='duration'>" . $playlistSong->getDuration() . "</span>
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

<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">remove from playlist</div>
</nav>