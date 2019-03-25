<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select * from movies where title like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchMovies'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($title, $year, $genre, $rating);
                echo "<table border=1><th>Title</th><th>Year</th><th>Genre</th><th>Rating</th>\n";                
		while($stmt->fetch()) {
                        echo "<tr><td>$title</td><td>$year</td><td>$genre</td><td>$rating</td>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>
