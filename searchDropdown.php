<?php
	// used in navBarContainer.php with the search bar
	include("includes/config.php");
	if(isset($_POST['s'])) {
		$key = "%{$_POST['s']}%";
		$query = "SELECT DISTINCT id, title, artist, album 
							FROM songs 
							WHERE title LIKE ? 
							OR artist LIKE ? 
							OR album LIKE ? LIMIT 10";
		
		$stmt = $con->prepare($query);
		$stmt->execute([$key,$key,$key]);

		if($stmt->rowCount() > 0) {
			$results = $stmt->fetchAll();
			foreach($results as $result) { ?>
				<li>
					<a href="#"><?=$result['id']?></a>
				</li>
			<?php
			}
		}
		else {
			echo "No results";
		}
	}
	// $query = mysqli_query($con, "SELECT DISTINCT id, title, artist, album FROM songs WHERE title LIKE '%$userInput%' 
	// 																																					OR artist LIKE '%$userInput%' 
	// 																																					OR album LIKE '%$userInput%' LIMIT 10");
	// if(mysqli_num_rows($query) == 0) echo "<li class='noResults'> no frequency found matching " . $userInput . "</span>";

	// // collection for the results
	// $resultArray = array();
	// $i = 1;
	// // get each result from the query
	// while($row = mysqli_fetch_array($query)) {
	// 	if($i > 20) break;

	// 	$song = new Song($con, $row['id']);
	// 	$artist = $song->getArtist();
	// 	$album = $song->getAlbum();

	// 	echo "<li class='list-group'>
	// 					<a href='album.php?id=" . $album->getId() . "' >
	// 						<img src='" . $album->getArtworkPath() . "'>
	// 						<span class='resultInfo'>" . $artist->getName() . " - " . $song->getTitle() . "
	// 					</a>
	// 				</li>";
	// 	$i++;
	// }
?>