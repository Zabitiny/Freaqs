<div id="navBarContainer">
  <nav class="navBar">

    <a role="link" tabIndex="0" href="index.php" class="logo">
      <img src="assets/images/icons/logo.png" alt="home" title="home">
    </a>

    <div class="navBar-left">
      <a role="link" tabIndex="0" href="feed.php" class="navItemLink" id="feed">Feed</a>
    </div>
    
    <div class="navBar-center">
      
      <div class="searchBar">
        <input id="search" autocomplete="off" role="search"  tabIndex="0" type="text" placeholder="Search">
        <img src="assets/images/icons/search.png" alt="search">
        
        <ul class="dropdown" id="dropdown"></ul>
      </div>
    </div>

    <div class="navBar-right">
      <a role="link" tabIndex="0" href="settings.php" class="navItemLink" id="username"><?php echo $userLoggedIn->getUsername(); ?> </a>
    </div>
    
  </nav>
</div>

<script>
  $(function() {
    $(document).ready(() => {
			function fetchData() {
        var s = $('#search').val();
					$.post('searchDropdown.php', 
						{
							search: s
						},
						(data, status) => {
							$('#dropdown').css('display', 'block');
							$('#dropdown').html(data);
						});
			}
			if($('#search').val() === '') $('#dropdown').css('display', 'none');
			
			$('#search').on('input',  fetchData);
			
			$('#search').on('click ', () => {
				if($('#search').val() != '') fetchData();
			});

			$('body').on('click', () => {
					$('#dropdown').css('display', 'none');
			});
    });
  });
</script>