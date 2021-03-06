<div class="header">
  <nav id="menu" class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a id="brand" class="navbar-brand" href="index.php">Tales of Webseria</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="display_stories.php">Histoires</a>
      </li>
      <?php if (isset($_SESSION['story'])&&isset($_SESSION['page'])) { ?>
      <li class="nav-item">
        <form class="header-form" method="get" action="story.php">
        	<input type="hidden" name="storyId" value="<?php echo $_SESSION['story'] ?>"/>
        	<input type="hidden" name="pageId" value="<?php echo $_SESSION['page'] ?>"/>
	        <button type="submit" class="btn nav-link btn-link">Reprendre</button>
        </form>
      </li>
      <?php } ?>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <div class="search-container">
        <form class="form-inline" method="get" action="../search.php">
          <input class="form-control  mr-sm-2" type="text" placeholder="Chercher une histoire..." name="request">
          <button type="submit" class="btn btn-primary">Chercher</button>
        </form>
      </div>
      <?php if (!isset($_SESSION['username'])) { ?>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      <?php } else { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
          <?php echo $_SESSION['username'];?>
        </a>
      <div class="dropdown-menu">
        <?php if (isset($_SESSION['admin'])) { ?>
        <a class="dropdown-item" href="admin_page.php">Admin</a>
        <?php } ?>
        <a class="dropdown-item" href="user_page.php">Profil</a>
        <a class="dropdown-item" href="saved_stories.php">Parties</a>
      </div>
      </li>
      <li class="nav-item">
        <form class="header-form" name="disconnect" method="post" action="server.php">
          <button type="submit" class="btn btn-link nav-link" name="disconnect">Log out</button>
        </form>
      </li>
      <?php } ?>
    </ul>
  </nav>
</div>
