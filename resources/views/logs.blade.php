<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Логи</title>
        <style>
            td:nth-child(5), td:mth-child(6){text-align: center;}
            table{position: absolute;border-spacing: 0; border-collapse: collapse; width: 70%; box-shadow: 0px 4px 100px rgb(255 255 255 / 25%);}
            td, th{padding: 10px; border: 1px solid #2b2b2b}
            tr:nth-child(odd) { background-color: #c1b7b7 }
        </style>
        
    </head>
    <body>
        <?php
        $db_server = '127.0.0.1';
        $db_user = 'root';
        $db_port = 3307;
        $db_password = 'root';
        $db_name = 'task8';

        try {
        $db = new PDO("mysql:host=$db_server;port=$db_port;dbname=$db_name", $db_user, $db_password, array(PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"));
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'SELECT id, time, duration, ip, url, method, input FROM logs';
        $statement = $db->prepare($sql);

        $statement->execute();

        $result_array = $statement->fetchAll();

        echo "<div class=\"table\">";
        echo "<table><tr><th>id</th><th>time</th><th>duration</th><th>ip</th><th>url</th><th>method</th><th>input</th></tr>";
        foreach($result_array as $result_row) {
            echo "<tr>";
            echo "<td align=\"center\">" . $result_row['id'] . "</td>";
            echo "<td align=\"center\">" . $result_row['time'] . "</td>";
            echo "<td align=\"center\">" . $result_row['duration'] . "</td>";
            echo "<td align=\"center\">" . $result_row['ip'] . "</td>";
            echo "<td align=\"center\">" . $result_row['url'] . "</td>";
            echo "<td align=\"center\">" . $result_row['method'] . "</td>";
            echo "<td align=\"center\">" . $result_row['input'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";

    }
     catch(PDOException $e) {
        echo "Ошибка при создании записи в базе данных: " . $e->getMessage();
    }
    $db = null;
    ?>    
    </body>
</html>