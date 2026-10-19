<?php
// Intentar leer las variables de entorno de Azure, si no, usar localhost
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'lista_compras';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: '';

try {
    // Configurar las opciones para requerir conexión SSL
    $options = [
        PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Azure maneja el certificado internamente
    ];

    // Se añaden las opciones al final de la conexión PDO
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8", 
        $username, 
        $password,
        $options
    );
    
    // Configurar PDO para que lance excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>