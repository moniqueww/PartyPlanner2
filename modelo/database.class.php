<?php
//Include das classes via autoload
include_once '../autoload.php';


/**
 * Classe de conexão ao banco de dados usando PDO no padrão Singleton.
 * Modo de Usar:
 * require_once './Database.class.php';
 * $conn = Database::conexao();
 * E agora use as funções do PDO (prepare, query, exec) em cima da variável $conn.
 */

class Database{
    # Variável que guarda a conexão PDO.
    protected static $conn;
    
    # Private construct - garante que a classe só possa ser instanciada internamente.
    private function __construct()
    {
       
        try
        {
            # Atribui o objeto PDO à variável $conn.
            self::$conn = new PDO("mysql:host=". Config::HOST_NAME."; dbname=".Config::DATABASE_NAME, Config::DATABASE_USER_NAME, Config::DATABASE_PASSWORD);
            # Garante que o PDO lance exceções durante erros.
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            # Garante que os dados sejam armazenados com codificação UFT-8.
            self::$conn->exec('SET NAMES utf8');
        }
        catch (PDOException $e)
        {
            # Envia um e-mail para o e-mail oficial do sistema, em caso de erro de conexão.
            $email = new Email();
            //$email->enviar("gregoripmachado@gmail.com","Mauricio Rosito","Sistema Modelo","Erro no acesso ao banco: ".$e->getMessage(),"gregoripmachado@gmail.com","Mauricio Rosito");
            # Então não carrega nada mais da página.
            die("Connection Error: " . $e->getMessage());
        } 
    }
    
    
    # Método estático - acessível sem instanciação.
    public static function conectar()
    {
        # Garante uma única instância. Se não existe uma conexão, criamos uma nova.
        if (!self::$conn)
        {
            new Database();
        }
        # Retorna a conexão.
        return self::$conn;
    }
    
    # Método estático - acessível sem instanciação.
    public static function desconectar()
    {
        # Se existe uma conexão, setamos como nulo.
        if (self::$conn)
        {
            self::$conn = null;
        }        
    }
}
