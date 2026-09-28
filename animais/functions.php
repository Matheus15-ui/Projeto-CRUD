<?php
    require_once('../config.php');
    require_once(DBAPI);

    /* ===========================
       FUNÇÃO INDEX (Filtragem)
    =========================== */
    function index() {
        global $pets;

        if (!empty($_POST["pets"])) {
            $valor = $_POST["pets"];
            $pets = filter("pets", "Nome", $valor);
        } else {
            $pets = find_all("pets");
        }
    }

    /* ===========================
       FUNÇÃO DE UPLOAD
    =========================== */
    function upload($arquivo) {
        try {
            $pasta = "fotos/";
            $nome = $arquivo["name"];
            $destino = $pasta.$nome;

            $tipo = strtolower(pathinfo($nome, PATHINFO_EXTENSION));
            $tamanho = $arquivo['size'];
            $tmp = $arquivo['tmp_name'];

            $permitidos = ["jpg","jpeg","png","gif"];

            if (!in_array($tipo, $permitidos)) {
                throw new Exception("Somente JPG, JPEG, PNG e GIF são permitidos.");
            }

            if ($tamanho > 5000000) {
                throw new Exception("Arquivo muito grande! Máx: 5MB");
            }

            if (file_exists($destino)) {
                throw new Exception("Já existe um arquivo com esse nome.");
            }

            if (!move_uploaded_file($tmp, $destino)) {
                throw new Exception("Falha ao enviar a imagem.");
            }

            return $nome;

        } catch (Exception $e) {
            $_SESSION['message'] = "Erro no upload: " . $e->getMessage();
            $_SESSION['type'] = "danger";
            return null;
        }
    }

    /* ===========================
       FUNÇÃO ADD
    =========================== */
    function add() {

        if (!empty($_POST['pet'])) {

            try {
                $pet = $_POST['pet'];

                if (!empty($_FILES['foto']['name'])) {
                    $nomeArquivo = upload($_FILES['foto']);
                    if ($nomeArquivo) {
                        $pet['Foto'] = $nomeArquivo;
                    }
                }

                $pet['modified'] = date('Y-m-d H:i:s');
                save('pets', $pet);

                header("location: index.php");

            } catch (Exception $e) {
                $_SESSION['message'] = "Erro: " . $e->getMessage();
                $_SESSION['type'] = 'danger';
            }
        }
    }

    /* ===========================
       FUNÇÃO EDIT
    =========================== */
    function edit() {
        try {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if (!empty($_POST['pet'])) {
                    $pet = $_POST['pet'];

                    if (empty($pet['Foto'])) {
                        $pet['Foto'] = "semimagem.jpg";
                    }

                    if (!empty($_FILES['Foto']['name'])) {
                        $nomearquivo = upload($_FILES['Foto']);
                        if ($nomearquivo) {
                            $pet['Foto'] = $nomearquivo;
                        }
                    }

                    update('pets', $id, $pet);
                    header("location: index.php");
                    exit;

                } else {
                    global $pet;
                    $pet = find("pets", $id);
                }
            } else {
                header("location: index.php");
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }