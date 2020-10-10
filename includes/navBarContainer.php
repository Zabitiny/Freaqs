<div id="navBarContainer">
  <nav class="navBar">
    <div class="navBar-left">
      <a role="link" tabIndex="0" href="index.php" class="logo">
        <img src="assets/images/icons/logo.png" alt="home">
      </a>


      <a role="link" tabIndex="0" href="feed.php" class="navItemLink" id="feed">Feed</a>
    </div>
    <div class="navBar-center">
          <a role='link' tabIndex='0' href="search.php" class="navItemLink" id="search">Search
            <img src="assets/images/icons/search.png" class="icon" alt="search">
          </a>
    </div>
    <div class="navBar-right">
      <a role="link" tabIndex="0" href="settings.php" class="navItemLink" id="username"><?php echo $userLoggedIn->getUsername(); ?> </a>
    </div>
  </nav>
</div>