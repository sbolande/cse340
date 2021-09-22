<?
    function phpmotorsConnect(){
        $server = 'mysql';
        $dbname= 'phpmotors';
        $username = 'iClient';
        // $password = 'password';
        $password = 'yurmom';
        $dsn = "mysql:host=$server;dbname=$dbname";
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            $link = new PDO($dsn, $username, $password, $options);
            // optional console.log successful connection
            // echo "<script>console.log('User " . $username . " successfully connected to DB.');</script>";
            return $link;
        } catch(PDOException $e) {
            header('Location: /phpmotors/view/500.php');
            exit;
        }
    }
?>