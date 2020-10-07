<!-- page for displaying albums -->

<?php include("includes/includedFiles.php"); 

if(isset($_GET['id'])){
    $albumId = $_GET['id']; //id from url is now in albumId
}
else {
    header("Location: index.php");
}

/*accessing db for artist name
$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE id='$albumId'");   //fetched album data with matching id
$album = mysqli_fetch_array($albumQuery);*/

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
    
    <div class="leftSection">
        <img src="<?php echo $album->getArtworkPath(); ?>" alt="album artwork">
    </div>

    <div class="rightSection">
        <h2><?php echo $album->getTitle(); ?></h2>
        <p>By 
            <?php echo "<span class='artistName' role='link' tabIndex='0' onclick='openPage(\"artist.php?id=" . $artist->getId() . "\")'>" . $artist->getName() . "</span>"; ?>
        </p>
        <p><?php echo $album->getNumSongs();?> songs</p>

    </div>

</div>

<div class="trackListContainer">

    <ul class="trackList">

        <?php
            //list out tracks in album
            $songIdArray = $album->getSongIds();
            $i =1;
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
                            <span class='artistName' role='link' tabIndex='0' onclick='openPage(\"artist.php?id=" . $albumArtist->getId() . "\")'>" . $albumArtist->getName() . "</span>
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


<nav class="optionsMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistsDropdown($con, $userLoggedIn->getUsername()); ?>
</nav>