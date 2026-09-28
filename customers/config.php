
<?php
//**Manual dos bancos de dados  */
    if (session_status() === PHP_SESSION_NONE) session_start();
    /** O nome do banco de dados*/
	//define("DB_NAME", "if0_40531218_wda_crud");
	const DB_NAME = "if0_40531218_wda_crud";

	/** nome do host do MySQL */
	const DB_HOST = "";

	/** String de conexão do PDO */
	const DB_DSN = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";

	/** Usuário do banco de dados MySQL */
	define('DB_USER', 'root');

	/** Senha do banco de dados MySQL */
	define('DB_PASSWORD', '');

    /** caminho absoluto para a pasta do sistema **/
    
    if ( !defined("ABSPATH") )
        define("ABSPATH", dirname(__FILE__) . "/");
        
    /** caminho no server para o sistema **/
    
    if ( !defined("BASEURL") )
        define("BASEURL", "/projetoEto/");
        
    /** caminho do arquivo de banco de dados **/
    
    if ( !defined("DBAPI") )
        define("DBAPI", ABSPATH . "inc/databasen.php");
    
    /** caminhos dos templates de header e footer **/
    define('HEADER_TEMPLATE', ABSPATH . 'inc/header.php');
    define('FOOTER_TEMPLATE', ABSPATH . 'inc/footer.php');
        
?>