<?php
    include '../config.php';
    include DBAPI;
    include PDF;
    /* ===========================
       FUNÇÃO INDEX (Filtragem)
    =========================== */
    function index() {
        global $pacientes;

        if (!empty($_POST["pacientes"])) {
            $valor = $_POST["pacientes"];
            $pacientes = filter("pacientes", "Nome", $valor);
        } else {
            $pacientes = find_all("pacientes");
        }
    }

    /* ===========================
       FUNÇÃO DE UPLOAD
    =========================== */
    function upload($arquivo) {
        try {
            $pasta = "fotos/";
            $nomeOriginal = basename($arquivo["name"]);
            $tipo = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
            $tamanho = $arquivo['size'];
            $tmp = $arquivo['tmp_name'];

            // Extensões válidas
            $permitidos = ["jpg","jpeg","png","gif"];

            if (!in_array($tipo, $permitidos)) {
                throw new Exception("Somente JPG, JPEG, PNG e GIF são permitidos.");
            }

            // Tamanho máximo 5MB
            if ($tamanho > 5000000) {
                throw new Exception("Arquivo muito grande! Máx: 5MB");
            }

            $nomeBase = pathinfo($nomeOriginal, PATHINFO_FILENAME);
            $nomeBase = preg_replace('/[^a-zA-Z0-9_-]/', '', $nomeBase);
            if (empty($nomeBase)) {
                $nomeBase = 'foto';
            }

            $nome = $nomeBase . '.' . $tipo;
            if (strlen($nome) > 30) {
                $nome = substr($nomeBase, 0, 18) . '-' . substr(md5(uniqid('', true)), 0, 6) . '.' . $tipo;
            }

            $destino = $pasta . $nome;
            while (file_exists($destino)) {
                $nome = substr($nomeBase, 0, 18) . '-' . substr(md5(uniqid('', true)), 0, 6) . '.' . $tipo;
                $destino = $pasta . $nome;
            }

            // Realizar upload
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

        if (!empty($_POST['paciente'])) {

            try {
                $paci = $_POST['paciente'];
                $paci['foto'] = "semimagem.jpg";

                if (!empty($_FILES['foto']['name'])) {
                    $nomeArquivo = upload($_FILES['foto']);
                    if ($nomeArquivo) {
                        $paci['foto'] = $nomeArquivo;
                    }
                }

                save('pacientes', $paci);

                header("Location: index.php");
                exit;

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

                if (!empty($_POST['paciente'])) {
                    $paci = $_POST['paciente'];

                    if (!empty($_FILES['foto']['name'])) {
                        $nomearquivo = upload($_FILES['foto']);
                        if ($nomearquivo) {
                            $paci['foto'] = $nomearquivo;
                        }
                    } else {
                        $paci['foto'] = find("pacientes", $id)['foto'] ?? "semimagem.jpg";
                    }
                    update('pacientes', $id, $paci);
                    header("Location: index.php");
                    exit;

                } else {
                    global $paciente;
                    $paciente = find("pacientes", $id);
                }
            } else {
                header("location: index.php");
            }
        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = 'danger';
            header("location: index.php");
        }
    }

    function pdf($p = null){

        $pdf = new PDF();
        $pdf -> AliasNbPages();
        $pdf -> addPage();
        $pdf -> SetFont('Times', '', 12);
        $pacientes = null;

        if ($p){
            $pacientes = filter("pacientes", "nome", $p);
        } else{
            $pacientes = find_all("pacientes");
        }

        $width_cell = array(18,58,59,30,25);
        $height_cell = 15;
        $pdf->SetFillColor(0,153,153);

        $pdf->Cell($width_cell[0],$height_cell, "id", 1,0,'c',true);
        $pdf->Cell($width_cell[1],$height_cell, "nome", 1,0,'c',true);
        $pdf->Cell($width_cell[2],$height_cell, converteTexto("endereço") , 1,0,'c',true);
        $pdf->Cell($width_cell[3],$height_cell, "idade", 1,0,'c',true);
        $pdf->Cell($width_cell[4],$height_cell, "foto", 1,1,'c',true);

        foreach ($pacientes as $paciente) {

            $pdf->Cell($width_cell[0],$height_cell, $paciente["id"] , 1,0,'c', false);
            $pdf->Cell($width_cell[1],$height_cell, converteTexto($paciente['nome']), 1,0,'c', false);
            $pdf->Cell($width_cell[2],$height_cell, converteTexto($paciente['endereco']) , 1,0,'c', false);
            $pdf->Cell($width_cell[3],$height_cell, $paciente['idade'], 1,0,'c', false);

            $boraBillx = $pdf->GetX();
            $boraBilly = $pdf->GetY();

            $Image_max_width = $width_cell[4];  
            $Image_max_height = $height_cell; 

             if (empty($paciente['foto'])) {
                    $pdf->Image("fotos/semimagem.jpg" , $boraBillx ,$boraBilly, $Image_max_width,$Image_max_height);
                    $pdf->Cell($width_cell[4],$height_cell, " ", 1,1,'c', false);
                    
                } else {
                    $pdf->Image("fotos/" . $paciente['foto'],$boraBillx,$boraBilly,$Image_max_width,$Image_max_height);
                    $pdf->Cell($width_cell[4],$height_cell, " ", 1,1,'c', false);            
            }
        }

        $pdf->Output('Lista_dos_pacientes.pdf', 'I');
    }
?>