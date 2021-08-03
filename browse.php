<?php include("includes/includedFiles.php"); ?>

<h1 class="pageHeadingBig">You Might Also Like</h1>

<div class="gridViewContainer">

	<?php 
		$albumQuery = mysqli_query($con, "SELECT * 
																			FROM albums 
																			ORDER BY RAND() LIMIT 10");

		// goes through each row in albums table
		while($row = mysqli_fetch_array($albumQuery)) { 
			echo "<div class='gridViewItem'>
					<a role='link' tabIndex='0' href='album.php?id=" . $row['id'] . "'>
						<img src='" . $row['artworkPath'] . "'>
						<div class='gridViewInfo'>" 
							. $row['title'] .
						"</div>
					</a>
				</div>";
		}
	?>
</div>