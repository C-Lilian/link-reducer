<?php

class Database
{
    private static ?PDO $pdo = null; // Instance unique de PDO
    
    /**
     * Retourne la connexion PDO
     *
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            // Construire le DSN PostgreSQL avec les variables d'environnement
            $dsn = sprintf(
                "pgsql:host=%s;port=%s;dbname=%s",
                getenv('DB_HOST'),
                getenv('DB_PORT'),
                getenv('POSTGRES_DB')
            );
            
            // Crée la connexion PDO
            self::$pdo = new PDO(
                $dsn,
                getenv('POSTGRES_USER'),
                getenv('POSTGRES_PASSWORD'),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        }
        
        return self::$pdo; // Crée la connexion PDO
    }
}
