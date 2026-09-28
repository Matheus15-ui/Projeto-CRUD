<?php

    /* ===========================
       CONEXÃO PDO
    =========================== */
    function open_database() {
        try {
            $conn = new PDO(DB_DSN, DB_USER, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $conn;
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    function close_database($conn) {
        $conn = null;
    }

    /* ===========================
       BUSCAR UM OU TODOS
    =========================== */
    function find($table = null, $id = null) {

        $database = open_database();

        try {
            if ($id) {
                $stmt = $database->prepare("SELECT * FROM $table WHERE id = :id");
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);
                $stmt->execute();

                return $stmt->fetch();
            } else {
                $stmt = $database->query("SELECT * FROM $table");
                return $stmt->fetchAll();
            }

        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
        } finally {
            close_database($database);
        }
    }

    /* ===========================
       BUSCAR TODOS
    =========================== */
    function find_all($table) {
        return find($table);
    }

    /* ===========================
       FILTRO SEGURO
    =========================== */
    function filter($table, $campo, $valor) {

        $database = open_database();

        try {
            $sql = "SELECT * FROM $table WHERE $campo LIKE :valor";
            $stmt = $database->prepare($sql);

            $stmt->bindValue(":valor", "%$valor%", PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetchAll();

        } catch (Exception $e) {
            $_SESSION['message'] = $e->getMessage();
            $_SESSION['type'] = 'danger';
            return [];
        } finally {
            close_database($database);
        }
    }

    /* ===========================
       INSERT
    =========================== */
    function save($table = null, $data = null) {

        $database = open_database();

        $columns = implode(",", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";

        try {
            $stmt = $database->prepare($sql);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            $stmt->execute();

            $_SESSION['message'] = 'Registro cadastrado com sucesso.';
            $_SESSION['type'] = 'success';

            return $database->lastInsertId();

        } catch (PDOException $e) {
            $_SESSION['message'] = 'Erro ao cadastrar: ' . $e->getMessage();
            $_SESSION['type'] = 'danger';
        } finally {
            close_database($database);
        }
    }

    /* ===========================
       UPDATE
    =========================== */
    function update($table = null, $id = 0, $data = null) {

        $database = open_database();

        $fields = [];

        foreach ($data as $key => $value) {
            if ($key === 'id') continue;
            $fields[] = "$key = :$key";
        }

        $set = implode(", ", $fields);
        $sql = "UPDATE $table SET $set WHERE id = :id";

        try {
            $stmt = $database->prepare($sql);

            foreach ($data as $key => $value) {
                if ($key === 'id') continue;
                $stmt->bindValue(":$key", $value);
            }

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            $_SESSION['message'] = 'Registro atualizado com sucesso.';
            $_SESSION['type'] = 'success';

            return true;

        } catch (PDOException $e) {
            $_SESSION['message'] = 'Erro ao atualizar: ' . $e->getMessage();
            $_SESSION['type'] = 'danger';

            return false;
        } finally {
            close_database($database);
        }
    }

    /* ===========================
       DELETE
    =========================== */
    function remove($table = null, $id = null) {

        $database = open_database();

        try {
            if ($id) {
                $stmt = $database->prepare("DELETE FROM {$table} WHERE id = :id");
                $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $_SESSION['message'] = "Registro removido com sucesso.";
                    $_SESSION['type'] = 'success';
                    return true;
                } else {
                    $_SESSION['message'] = "Nenhum registro foi removido.";
                    $_SESSION['type'] = 'warning';
                    return false;
                }
            }

        } catch (PDOException $e) {
            $_SESSION['message'] = "Erro ao remover: " . $e->getMessage();
            $_SESSION['type'] = 'danger';
            return false;

        } finally {
            close_database($database);
        }
    }

    /* ===========================
       LIMPAR MENSAGENS
    =========================== */
    function clear_messages() {
        $_SESSION['message'] = null;
        $_SESSION['type'] = null;
    }

    /* ===========================
       CRIPTOGRAFIA SEGURA
    =========================== */
    function criptografia($senha){
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    /* ===========================
       VERIFICAR SENHA
    =========================== */
    function verificar_senha($senha, $hash){
        return password_verify($senha, $hash);
    }
?>