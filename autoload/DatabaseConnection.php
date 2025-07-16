<?php
class DatabaseConnection {
    public static function connect() {
        $dbfile = __DIR__ . '/../data.sqlite';
        $pdo = new PDO('sqlite:' . $dbfile);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Auto-create the table if it doesn't exist
        $createTableSQL = "CREATE TABLE IF NOT EXISTS simpleModel (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            colour TEXT NOT NULL
        )";
        $pdo->exec($createTableSQL);

        return $pdo;
    }
}
?>
