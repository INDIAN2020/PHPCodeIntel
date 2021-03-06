<?php

namespace PHPIntel\SQLite;

use \PDO;
use \Exception;

/*
* SQLite
*/
class SQLite
{

    public static function getDBHandle($filepath) {
        $file_exists = file_exists($filepath);
        $db = new PDO("sqlite:{$filepath}");

        // create the tables if they don't exist yet
        if (!$file_exists) {
            $db->exec("
CREATE TABLE IF NOT EXISTS entity (
    label TEXT,
    completion TEXT,

    scope TEXT,
    type TEXT,
    class TEXT,
    filepath TEXT
)");
            $db->exec("CREATE INDEX IF NOT EXISTS entity_completion_idx ON entity (completion)");
        }

        return $db;
    }
}
