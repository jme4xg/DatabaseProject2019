<?php
        require "dbutil.php";
        $db = DbUtil::loginConnection();

        $stmt = $db->stmt_init();

        if($stmt->prepare("select artist, date, time, price, genre, name, capacity from concert natural join concert_venue natural join place where artist like ?") or die(mysqli_error($db))) {
                $searchString = '%' . $_GET['searchConcert'] . '%';
                $stmt->bind_param(s, $searchString);
                $stmt->execute();
                $stmt->bind_result($artist, $date, $time, $price, $genre, $name, $capacity);
                echo "<table border=1><th>Artist</th><th>Date</th><th>Time</th><th>Price</th><th>Genre</th><th>Venue Name</th><th>Venue Capactiy</th>\n";
                while($stmt->fetch()) {
                        echo "<tr><td>$artist</td><td>$date</td><td>$time</td><td>$price</td><td>$genre</td><td>$name</td><td>$capacity</td></tr>";
                }
                echo "</table>";

                $stmt->close();
        }

        $db->close();


?>
