<?php
//----------------------------------------------------------------------------------------------------
function f1() {
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASSWORD", "");
    define("DBNAME", "cinema");
    define("DBPORT", "3306");
    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST.";port:".DBPORT;
    global $db;
    try {
        $db = new PDO($dsn, DBUSER, DBPASSWORD);
        $db->exec("SET NAMES utf8");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        die($e->getMessage());
    }
}
//----------------------------------------------------------------------------------------------------
function f2($db, $table) { // return an array of all elements of a table passed in parameters
    $request = $db->query("SELECT * FROM ".$table);
    $request = $request->fetchAll(PDO::FETCH_ASSOC);
    return $request;
}
//----------------------------------------------------------------------------------------------------
function f3($request, $fieldsArray) {
    $content = "";
    $count1 = count($request);
    for($i = 0; $i < $count1; $i++) {
        $count2 = count($fieldsArray);
        for($j = 0; $j < $count2; $j++) {
            $content .= $request[$i][$fieldsArray[$j]]." ";
        }
        $content .= "<br>";
    }
    echo($content);
}
//----------------------------------------------------------------------------------------------------
function f4($db, $table) { // return an array with all fields of a table passed in parameters
    $request = $db->query("SHOW COLUMNS FROM ".$table.";");
    $request = $request->fetchAll(PDO::FETCH_ASSOC);
    $count = count($request);
    $array = [];
    for($i = 0; $i < $count; $i++) {
        foreach($request[$i] as $key => $value) {
            if($key == "Field") {
                array_push($array, $value);
            }
        }
    }
    return $array;
}
//----------------------------------------------------------------------------------------------------
function f5($db, $table) {
    f3(f2($db, $table), f4($db, $table));
}
//----------------------------------------------------------------------------------------------------
function f6($db, $fields, $genre) { // show all movies of the genre passed in parameters
    $request = $db->query("SELECT ".$fields." FROM movie_genre INNER JOIN movie ON movie.id = movie_genre.id_movie LEFT JOIN genre ON genre.id = movie_genre.id_genre where id_genre = \"".f7($db, $genre)."\";");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    $j = 0;
    $number = 1;
    echo "<table class=\"f7\">";
    echo "<tr class=\"f6\">";
    echo "<th class=\"f6\">Number</th>";
    echo "<th class=\"f6\">Title</th>";
    echo "<th class=\"f6\">Director</th>";
    echo "<th class=\"f6\">Duration</th>";
    echo "<th class=\"f6\">Release date</th>";
    echo "<tbody>";
    for($i = 0; $i < $count; $i++) {
        array_push($array, $request[$i][0]);
        array_push($array, $request[$i][1]);
        array_push($array, $request[$i][2]);
        array_push($array, $request[$i][3]);
        echo "<tr class=\"f6\">";
        echo "<th class=\"f6\">$number</th>";
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">".f8($array[$j])."</th>";
        $j++;
        echo "<tr class=\"f6\">";
        $number++;
    }
    echo "</tbody>";
    echo "</table>";
    return $array;
}
//----------------------------------------------------------------------------------------------------
function f7($db, $genre) { // return the id of the genre table passed in parameters
    $request = $db->query("SELECT id FROM genre WHERE name = \"".$genre."\";");
    $request = $request->fetch();
    return $request[0];
}
//----------------------------------------------------------------------------------------------------
function f8($string) { // return the update of the date format from "yyyy/mm/dd hh:mm:ss" to "yyyy"
    $update = null;
    for($i = 0; $i < 4; $i++) {
        $update .= $string[$i];
    }
    return $update;
}
//----------------------------------------------------------------------------------------------------
function f9($db, $string) {
    $request = $db->query("SELECT movie.title FROM movie INNER JOIN distributor ON movie.id_distributor = distributor.id where distributor.name like \"%".$string."%\";");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    $j = 0;
    $number = 1;
    echo "<table class=\"f6\">";
    echo "<tr>";
    echo "<th>Number</th>";
    echo "<th>Title</th>";
    echo "<th>Director</th>";
    echo "<th>Duration</th>";
    echo "<th>Release date</th>";
    echo "<tr>";
    for($i = 0; $i < $count; $i++) {
        array_push($array, $request[$i][0]);
        array_push($array, $request[$i][1]);
        array_push($array, $request[$i][2]);
        array_push($array, $request[$i][3]);
        echo "<tr>";
        echo "<th>$number</th>";
        echo "<th>$array[$j]</th>";
        $j++;
        echo "<th>$array[$j]</th>";
        $j++;
        echo "<th>$array[$j]</th>";
        $j++;
        echo "<th>".f8($array[$j])."</th>";
        $j++;
        echo "<tr>";
        $number++;
    }
    echo "</table>";
    return $request;
}
//----------------------------------------------------------------------------------------------------
function f10($db) {
    $request = $db->query("SHOW TABLES;");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    for($i = 0; $i < $count; $i++) {
        array_push($array, $request[$i][0]);
        echo $array[$i];
        echo "<br>";
    }
}
//----------------------------------------------------------------------------------------------------
function f11($db, $fields, $string) {
    $request = $db->query("select ".$fields." from movie where title like \"%".$string."%\";");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    $j = 0;
    $number = 1;
    echo "<table class=\"f6\">";
    echo "<tr>";
    echo "<th>Number</th>";
    echo "<th>Title</th>";
    echo "<th>Director</th>";
    echo "<th>Duration</th>";
    echo "<th>Release date</th>";
    echo "<tr>";
    for($i = 0; $i < $count; $i++) {
        array_push($array, $request[$i][0]);
        array_push($array, $request[$i][1]);
        array_push($array, $request[$i][2]);
        array_push($array, $request[$i][3]);
        echo "<tr>";
        echo "<th>$number</th>";
        echo "<th>$array[$j]</th>";
        $j++;
        echo "<th>$array[$j]</th>";
        $j++;
        echo "<th>$array[$j]</th>";
        $j++;
        echo "<th>".f8($array[$j])."</th>";
        $j++;
        echo "<tr>";
        $number++;
    }
    echo "</table>";
    return $request;
}
//----------------------------------------------------------------------------------------------------
function f12($db, $table) { // return number of elements in a table passed in parameters
    $request = $db->query("SELECT COUNT(name) from ".$table.";");
    $request = $request->fetch();
    return $request[0];
}
//----------------------------------------------------------------------------------------------------
function f13($db, $table) { // echo all options of a select tag
    echo "<option value=\"select\">select</option>";
    $array = [];
    $request = $db->query("SELECT name FROM ".$table." ORDER BY name ASC;");
    $request = $request->fetchAll();
    for($i = 0; $i < f12($db, $table); $i++) {
        array_push($array, $request[$i][0]);
    }
    for($i = 0; $i < f12($db, $table); $i++) {
        echo "<option value=\"".$array[$i]."\">".$array[$i]."</option>";
    }
}
//----------------------------------------------------------------------------------------------------
function f14($db, $fields, $distributor) { // show all movies of the distributor passed in parameters
    $request = $db->query("SELECT ".$fields." FROM movie INNER JOIN distributor ON distributor.id = movie.id_distributor WHERE distributor.name LIKE \"%".$distributor."%\" ORDER BY distributor.name ASC, movie.release_date asc;");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    $j = 0;
    $k = 1;
    echo "<table class=\"f7\">";
    echo "<tr class=\"f6\">";
    echo "<th class=\"f6\">Number</th>";
    echo "<th class=\"f6\">Title</th>";
    echo "<th class=\"f6\">Distributor</th>";
    echo "<th class=\"f6\">Release date</th>";
    echo "<tbody>";
    for($i = 0; $i < $count; $i++) {
        array_push($array, $k);
        array_push($array, $request[$i][0]);
        array_push($array, $request[$i][1]);
        array_push($array, $request[$i][2]);
        echo "<tr class=\"f6\">";
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<tr class=\"f6\">";
        $k++;
    }
    echo "</tbody>";
    echo "</table>";
    return $array;
}
//----------------------------------------------------------------------------------------------------
function f15($db, $string) {
    $request = $db->query("SELECT email, firstname, lastname, birthdate, address, zipcode, city, country FROM user WHERE firstname like \"%".$string."%\" OR lastname like \"%".$string."%\";");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    $j = 0;
    $k = 1;
    echo "<table class=\"f7\">";
    echo "<tr class=\"f6\">";
    echo "<th class=\"f6\">Number</th>";
    echo "<th class=\"f6\">Email</th>";
    echo "<th class=\"f6\">Firstname</th>";
    echo "<th class=\"f6\">Lastname</th>";
    echo "<th class=\"f6\">Birthdate</th>";
    echo "<th class=\"f6\">Address</th>";
    echo "<th class=\"f6\">Zipcode</th>";
    echo "<th class=\"f6\">City</th>";
    echo "<th class=\"f6\">Country</th>";
    echo "<tbody>";
    for($i = 0; $i < $count; $i++) {
        array_push($array, $k);
        array_push($array, $request[$i][0]);
        array_push($array, $request[$i][1]);
        array_push($array, $request[$i][2]);
        array_push($array, $request[$i][3]);
        array_push($array, $request[$i][4]);
        array_push($array, $request[$i][5]);
        array_push($array, $request[$i][6]);
        array_push($array, $request[$i][7]);
        echo "<tr class=\"f6\">";
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<th class=\"f6\">$array[$j]</th>";
        $j++;
        echo "<tr class=\"f6\">";
        $k++;
    }
    echo "</tbody>";
    echo "</table>";
    return $array;
}
//----------------------------------------------------------------------------------------------------
function f16($db) {
    $request = $db->query("SELECT user.id, user.email, user.firstname, user.lastname, subscription.name FROM user INNER JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription ORDER BY subscription.id ASC, user.id ASC, user.firstname ASC, user.lastname ASC");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    $k = 1;
    for($i = 0; $i < $count; $i++) {
        array_push($array, $k);
        $k++;
        array_push($array, $request[$i][0]);
        array_push($array, $request[$i][1]);
        array_push($array, $request[$i][2]);
        array_push($array, $request[$i][3]);
        array_push($array, $request[$i][4]);
    }
    return $array;
}
//----------------------------------------------------------------------------------------------------
function f17($db, $array) {
    $count = count($array);
    echo "<table class=\"f7\">";
    echo "<tr class=\"f6\">";
    echo "<th class=\"f6\">Number</th>";
    echo "<th class=\"f6\">Id</th>";
    echo "<th class=\"f6\">Email</th>";
    echo "<th class=\"f6\">Firstname</th>";
    echo "<th class=\"f6\">Lastname</th>";
    echo "<th class=\"f6\">Subscription</th>";
    echo "<th class=\"f6\">Edit subscription</th>";
    echo "<tbody>";
    for($i = 0; $i < $count; $i++) {
        echo "<tr class=\"f6\">";
        echo "<th class=\"f6\">$array[$i]</th>";
        $i++;
        echo "<th class=\"f6\">$array[$i]</th>";
        $i++;
        echo "<th class=\"f6\">$array[$i]</th>";
        $i++;
        echo "<th class=\"f6\">$array[$i]</th>";
        $i++;
        echo "<th class=\"f6\">$array[$i]</th>";
        $i++;
        echo "<th class=\"f6\">$array[$i]</th>";
        echo "<th class=\"f6\"><form method=\"GET\" action=\"5_subscriptions.php\" class=\"c36\">";
        echo "<select name=\"subscription\" class=\"c37\">";
        f18($db, $array[$i]);
        echo "</select>";
        echo "</form>";
        // echo "<?php if(isset(".$_GET["subscription"].")){f20($db, ".$_GET["subscription"].");}
    }
    echo "<tr class=\"f6\">";
}
//----------------------------------------------------------------------------------------------------
function f18($db, $subscription) { // display all options for subscriptions
    $request = $db->query("SELECT name FROM subscription ORDER BY id ASC;");
    $request = $request->fetchAll();
    $array = [];
    $count = count($request);
    for($i = 0; $i < $count; $i++) {
        array_push($array, $request[$i][0]);
    }
    // echo "<option value=\"$subscription\">$subscription</option>";
    for($i = 0; $i < $count; $i++) {
        $j = 5;
        echo "<option value=\"$array[$i]\">$array[$i]</option>";
    }
}
//----------------------------------------------------------------------------------------------------
function f19($db) {
    $request = $db->query("SELECT id, title, director, YEAR(release_date) FROM movie ORDER BY id ASC;");
    $request = $request->fetchAll(PDO::FETCH_NUM);
    // print_r($request);
    return f21($request);
}
//----------------------------------------------------------------------------------------------------
function f20($db) { // displays all user and their subscription
    $request = "SELECT user.id, user.email, user.firstname, user.lastname, subscription.name FROM user LEFT JOIN membership ON membership.id_user = user.id LEFT JOIN subscription ON subscription.id = membership.id_subscription ORDER BY user.id ASC;";
    $request = $db->query($request);
    $request = $request->fetchAll(PDO::FETCH_NUM);
    return $request;
}
//----------------------------------------------------------------------------------------------------
function f21($array) { // from a 2 dimensions array returns an array ready to be displayable
    $result = [];
    $count1 = count($array);
    for($i = 0; $i < $count1; $i++) {
        $count2 = count($array[$i]);
            for($j = 0; $j < $count2; $j++) {
            array_push($result, $array[$i][$j]);
        }
    }
    return $result;
}
//----------------------------------------------------------------------------------------------------
function f22($arrayFields, $arrayToDisplay) { // display a array with fields passed in arguments
    $count1 = count($arrayFields);
    $count2 = count($arrayToDisplay);
    echo "<table>";
    echo "<tr>";
    for($i = 0; $i < $count1; $i++) {
        echo "<th>".$arrayFields[$i]."</th>";
    }
    echo "</tr>";
    echo "<tbody>";
    $count3 = $count2/$count1;
    $k = 0;
    for($i = 0; $i < $count3; $i++) {
        echo "<tr>";
        for($j = 0; $j < $count1; $j++) {
            echo "<td>".$arrayToDisplay[$k]."</td>";
            $k++;
        }
        echo "</tr>";
    }
    echo "</table>";
}
//----------------------------------------------------------------------------------------------------
function create_subscription($db, $id_user, $id_subscription) {
    $request = "INSERT INTO membership(id_user, id_subscription, date_begin) VALUES($id_user, $id_subscription, NOW());";
    $request = $db->query($request);
}
//----------------------------------------------------------------------------------------------------
function update_subscription($db, $id_user, $id_subscription) {
    $request = "UPDATE membership SET id_subscription = $id_subscription, date_begin = NOW() WHERE id_user = $id_user;";
    $request = $db->query($request);
}
//----------------------------------------------------------------------------------------------------
function delete_subscription($db, $id_user) {
    $request = "DELETE FROM membership WHERE id_user = $id_user;";
    $request = $db->query($request);
}
//----------------------------------------------------------------------------------------------------
function is_subscription_created($db, $id_user) {
    $request = "SELECT * FROM membership WHERE id_user = $id_user;";
    $request = $db->query($request);
    $request = $request->fetch();
    if($request) return true;
    else return false;
}
//----------------------------------------------------------------------------------------------------
function modify_subscription($db, $id_user, $id_subscription) {
    if($id_subscription == 5) delete_subscription($db, $id_user);
    else {
        if(is_subscription_created($db, $id_user)) {
            update_subscription($db, $id_user, $id_subscription);
        }
        else create_subscription($db, $id_user, $id_subscription);
    }
}
//----------------------------------------------------------------------------------------------------
function history_generator($db) {
    $db->query("DROP TABLE IF EXISTS history;");
    $db->query("CREATE TABLE IF NOT EXISTS history(id INT PRIMARY KEY NOT NULL AUTO_INCREMENT, id_user INT NOT NULL, id_movie INT NOT NULL);");
    $array1 = [];
    $count1 = table_count($db, "movie");
    array_push($array1, 0);
    for($i = 1; $i <= $count1; $i++) {
        array_push($array1, $i);
    }
    unset($array1[0]);
    $array2 = [];
    $count2 = table_count($db, "user");
    array_push($array2, 0);
    for($i = 1; $i <= $count2; $i++) {
        array_push($array2, $i);
    }
    unset($array2[0]);
    for($i = 1; $i <= $count2; $i++) {
        for($j = 0; $j < 2; $j++) {
            create_history_element($db, $i, array_rand($array1, 1));
        }
    }
}
//----------------------------------------------------------------------------------------------------
function create_history_element($db, $id_user, $id_movie) {
    $request = "INSERT INTO history(id_user, id_movie) VALUES($id_user, $id_movie);";
    $request = $db->query($request);
}
//----------------------------------------------------------------------------------------------------
function table_count($db, $table) {
    $request = "SELECT COUNT(*) FROM $table;";
    $request = $db->query($request);
    $request = $request->fetch();
    return $request[0];
}
//----------------------------------------------------------------------------------------------------
function show_history($db, $id_user) {
    $request = $db->query("SELECT user.email, user.firstname, user.lastname, movie.title FROM history INNER JOIN movie ON movie.id = history.id_movie INNER JOIN user ON user.id = history.id_user WHERE user.id = $id_user;");
    $request = $request->fetchAll(PDO::FETCH_NUM);
    $request = f21($request);
    return $request;
}
//----------------------------------------------------------------------------------------------------
/*
SELECT user.id, user.email, user.firstname, user.lastname, subscription.name
FROM user
LEFT JOIN membership ON membership.id_user = user.id
LEFT JOIN subscription ON subscription.id = membership.id_subscription
ORDER BY user.id ASC


CREATE DATABASE meetic;
DROP TABLE IF EXITS user;
CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    email VARCHAR(255),
    password VARCHAR(255),
    sex VARCHAR(100) DEFAULT "other"
);
*/