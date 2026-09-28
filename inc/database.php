<?php

    mysqli_report(MYSQLI_REPORT_STRICT | MYSQLI_REPORT_ERROR);

    function open_database() {
        try {
            $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            return $conn;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }

    function close_database($conn) {
        try {
            mysqli_close($conn);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

/**
 *  Pesquisa um Registro pelo ID em uma Tabela
 */
  function find($table, $id = null) {
        $database = open_database();

        try {
            if ($id) {
                $sql = "SELECT * FROM {$table} WHERE id = {$id}";
                $result = $database->query($sql);

                $data = $result->fetch_assoc();

                return $data ?: null;
            } else {
                $sql = "SELECT * FROM {$table}";
                $result = $database->query($sql);

                $data = [];

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }

                return $data;
            }
        } catch (Exception $e) {
            return null;
        } finally {
            close_database($database);
        }
    }

  /**
   *  Pesquisa Todos os Registros de uma Tabela
   */
  function find_all( $table ) {
      return find($table);
  }

 /**
*  Insere um registro no BD
*/
  function save($table = null, $data = null) {

      $database = open_database();

      $columns = null;
      $values = null;

      //print_r($data);

      foreach ($data as $key => $value) {
        $columns .= trim($key, "'") . ",";
        $values .= "'$value',";
      }

      // remove a ultima virgula
      $columns = rtrim($columns, ',');
      $values = rtrim($values, ',');

      $sql = "INSERT INTO $table ($columns) VALUES ($values);";

      try {
        $database->query($sql);

        $_SESSION['message'] = 'Registro cadastrado com sucesso.';
        $_SESSION['type'] = 'success';

      } catch (Exception $e) { 

        $_SESSION['message'] = 'Nao foi possivel realizar a operacao.';
        $_SESSION['type'] = 'danger';
      } 

      close_database($database);
  }

  function clear_messages() {
    $_SESSION['message'] = null;
    $_SESSION['type'] = null;
  }

  //Criptografia
  function criptografia($senha){
      
      /*
          ==> Criptografia Blowfish
          http://www.linhadecodigo.com.br/artigo/3532/criptografando-senhas-usando-bcrypt-blowfish-no-php.aspx
      */
      
      //Aplicando a criptografia
      $cust0 = "08";
      $salt = "CflfilePArK1BJomM0F6aJ";

      $hash = crypt($senha, "");
  }

  /**
   *  Remove uma linha de uma tabela pelo ID do registro
   */
  /**
 *  Visualização de um Cliente
 */
  
  /**
   *  Atualizar um registro pelo ID em uma tabela
   */
  function update($table = null, $id = 0, $data = null) {
    $database = open_database();

    $items = [];
    foreach ($data as $key => $value) {
      if ($key === 'id') continue; // não atualizar o id
      // escapar valor para evitar quebra de SQL
      $val = $database->real_escape_string($value);
      $items[] = "`$key`='$val'";
    }
    $items = implode(", ", $items);

    $sql  = "UPDATE `" . $database->real_escape_string($table) . "`";
    $sql .= " SET $items";
    $sql .= " WHERE id=" . (int)$id . ";";

    try {
      $database->query($sql);
      $_SESSION['message'] = 'Registro atualizado com sucesso.';
      $_SESSION['type'] = 'success';
    } catch (Exception $e) {
      $_SESSION['message'] = $e->GetMessage();
      $_SESSION['type'] = 'danger';
    }

    try {
      if ($database->query($sql) === TRUE) {
        $_SESSION['message'] = 'Registro atualizado com sucesso.';
        $_SESSION['type'] = 'success';
        close_database($database);
        return true;
      } else {
        $_SESSION['message'] = 'Erro ao atualizar: ' . $database->error;
        $_SESSION['type'] = 'danger';
        error_log("UPDATE ERROR: " . $sql . " -- " . $database->error);
        close_database($database);
        return false;
      }
    } catch (Exception $e) {
      $_SESSION['message'] = $e->GetMessage();
      $_SESSION['type'] = 'danger';
      error_log("UPDATE EXCEPTION: " . $e->getMessage() . " -- SQL: " . $sql);
      close_database($database);
      return false;
    }
  }

  /**
   *  Remove uma linha de uma tabela pelo ID do registro
   */
  function remove( $table = null, $id = null ) {

    $database = open_database();
    
    try {
      if ($id) {
          $sql = "DELETE FROM $table WHERE id=" . (int)$id . ";";
          if ($database->query($sql)) {    
            $_SESSION['message'] = "Registro Removido com Sucesso.";
            $_SESSION['type'] = 'success';
          }
      }
    } catch (Exception $e) { 
      $_SESSION['message'] = $e->GetMessage();
      $_SESSION['type'] = 'danger';
    }

    close_database($database);
  }

  //Pesquisa um Registro pelo ID em uma Tabela
  function filter( $table = null, $p = null ) {
    
    $database = open_database();
    $found = null;

    try {
      if ($p) {
        $sql = "SELECT * FROM $table WHERE $p";
        $result = $database->query($sql);

        if ($result && $result->num_rows > 0) {
          $found = [];
          while ($row = $result->fetch_assoc()) {
            $found[] = $row;
          } 
        }      
      } else {
        throw new Exception("Você tem dado em casa? Porque aqui não tem nenhum");
      }
    } catch (Exception $e) {
      $_SESSION['message'] = $e->GetMessage();
      $_SESSION['type'] = 'danger';
    }
    
    close_database($database);
    return $found;
  }
?>