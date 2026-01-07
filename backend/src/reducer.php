<?php

class Reducer
{
    private PDO $db;
    
    public function __construct()
    {
        $this->db = Database::getConnection(); // Connexion à la DB
    }
    
    /**
     * Raccourcir une URL
     *
     * @param string $url
     * @return string
     */
    public function reduce(string $url): string
    {
        $tries = 0;
        do {
            $code = $this->generateCode(); // Génère un code aléatoire de 25 caractères
            
            $stmt = $this->db->prepare(
                "INSERT INTO links (original_url, short_code) VALUES (:url, :code)"
            );
            
            try {
                $stmt->execute(['url' => $url, 'code' => $code]);
                
                break;
            } catch (PDOException $e) {
                if ($e->getCode() === '23505') { // code unique violation PostgreSQL
                    $tries++;
                    
                    if ($tries > 5) throw $e; // abandon après 5 essais
                } else {
                    throw $e; // autre erreur
                }
            }
        } while (true);
        
        return $code;
    }
    
    /**
     * Retourne l'URL originale à partir du code
     *
     * @param string $code
     * @return string|null
     */
    public function resolve(string $code): ?string
    {
        $stmt = $this->db->prepare(
            "SELECT original_url FROM links WHERE short_code = :code"
        );
        $stmt->execute(['code' => $code]);
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['original_url'] : null; // null si non trouvé
    }
    
    /**
     * // Génère un code aléatoire
     *
     * @param integer $length
     * @return string
     */
    private function generateCode(int $length = 25): string
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle(str_repeat($chars, 5)), 0, $length);
    }
}
