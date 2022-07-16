<?php
    require "functions.php";
    f1();
?>
<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
    	<link rel="stylesheet" type="text/css" href="../css/3_distributors.css"/>
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300;400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Karla:wght@300&display=swap" rel="stylesheet">
        <title>distributors</title>
    </head>
    <body>
        <header class="c2">
            <div class="c3">cinema</div>
            <nav id="menu">
                <ul>
                    <li><a href="0_home.php">home</a></li>
                    <li><a href="1_movies.php">movies</a></li>
                    <li><a href="2_genres.php">genres</a></li>
                    <li class="color-2f90f7"><a href="3_distributors.php">distributors</a></li>
                    <li><a href="4_members.php">members</a></li>
                    <li><a href="5_subscriptions.php">subscriptions</a></li>
                    <li><a href="6_update_subscription.php">update subscription</a></li>
                    <li><a href="7_history.php">history</a></li>
                </ul>
            </nav>
            <div class="c4">
                <svg xmlns="http://www.w3.org/2000/svg" style="display:none">
                    <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-search-13" viewBox="0 0 40 40">
                        <path d="M26.804 29.01c-2.832 2.34-6.465 3.746-10.426 3.746C7.333 32.756 0 25.424 0 16.378 0 7.333 7.333 0 16.378 0c9.046 0 16.378 7.333 16.378 16.378 0 3.96-1.406 7.594-3.746 10.426l10.534 10.534c.607.607.61 1.59-.004 2.202-.61.61-1.597.61-2.202.004L26.804 29.01zm-10.426.627c7.323 0 13.26-5.936 13.26-13.26 0-7.32-5.937-13.257-13.26-13.257C9.056 3.12 3.12 9.056 3.12 16.378c0 7.323 5.936 13.26 13.258 13.26z" fill-rule="evenodd"/>
                    </symbol>
                    <symbol xmlns="http://www.w3.org/2000/svg" id="sbx-icon-clear-2" viewBox="0 0 20 20">
                        <path d="M8.96 10L.52 1.562 0 1.042 1.04 0l.522.52L10 8.96 18.438.52l.52-.52L20 1.04l-.52.522L11.04 10l8.44 8.438.52.52L18.96 20l-.522-.52L10 11.04l-8.438 8.44-.52.52L0 18.96l.52-.522L8.96 10z" fill-rule="evenodd"/>
                    </symbol>
                </svg>
                <form method="GET" class="searchbox sbx-medium" id="id3">
                    <div role="search" class="sbx-medium__wrapper">
                        <input type="search" name="search" placeholder="search" autocomplete="off" required="required" class="sbx-medium__input" id="id4">
                        <button type="submit" title="Submit your search query." class="sbx-medium__submit">
                            <svg role="img" aria-label="Search">
                                <use xlink:href="#sbx-icon-search-13"></use>
                            </svg>
                        </button>
                        <button type="reset" title="Clear the search query." class="sbx-medium__reset">
                            <svg role="img" aria-label="Reset">
                                <use xlink:href="#sbx-icon-clear-2"></use>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </header>
        <form method="GET" action="3_distributors.php" id="id1">
            <select name="distributor" class="c1" id="id2">
                <?php
                    f13($db, "distributor");
                ?>
            </select>
        </form>
            <?php
                if(isset($_GET["distributor"])) {
                    f14($db, "movie.title, distributor.name, YEAR(movie.release_date)", $_GET["distributor"]);
                }
                if(isset($_GET["search"])) {
                    f14($db, "movie.title, distributor.name, YEAR(movie.release_date)", $_GET["search"]);
                }
            ?>
        <script src="../js/3_distributors.js"></script>
    </body>
</html>