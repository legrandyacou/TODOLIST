<?php
try {
    $dbtodolist = new PDO("mysql:host=localhost;dbname=todolist;charset=utf8mb4","root",""
    ,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE =>PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES =>false,
    ]
    );
} catch ( PDOException $e) {
    error_log($e-> getMessage());
    http_response_code(500);
    exi("Impossible de  se connecter a la base de donnee .");
}
?>