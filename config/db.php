<?php	
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "xpress-auth-rest-api";

    $dbConn = mysqli_connect($servername, $username, $password, $db) or die('MySQL connect failed. ' . mysqli_connect_error());

    function dbQuery($sql) {
        global $dbConn;
        $result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
        return $result;
    }

    function dbFetchAssoc($result) {
        return mysqli_fetch_assoc($result);
    }

    function dbNumRows($result) {
        return mysqli_num_rows($result);
    }

    function closeConn() {
        global $dbConn;
        $dbConn->close;
    }
?>
