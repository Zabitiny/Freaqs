<?php
	// used in navBarContainer.php with the search bar
	include("includes/config.php");
	if(isset($_POST['search'])) {
		$key = "%{$_POST['search']}%";
		if($key != '%%') {
			// $query = "SELECT DISTINCT id, title, artist, album 
			// 					FROM songs 
			// 					WHERE title LIKE ? 
			// 					OR artist LIKE ? 
			// 					OR album LIKE ? LIMIT 10";
			
			// $stmt = $con->prepare($query);
			// $stmt->execute([$key,$key,$key]);

			// if($stmt->rowCount() > 0) {
			// 	$results = $stmt->fetchAll();
				// foreach($results as $result) { 
					// 
				 	// <li>
				 	// 	<a href="#"><?=$result['id']</a>
				 	// </li>
			// 	}
			// }
			// else {
			// 	echo "No results";
			// }
			$query = mysqli_query($con, "SELECT *
																FROM songs");
		
			if(mysqli_num_rows($query) > 0) {
				while($row = mysqli_fetch_array($query)) { 
					echo "<li>
						<a href='#'>". $row['id'] ."</a>
					</li>";
				}
			}
			else {
				echo "No results";
			}

		}
		
	}
?>