


<?php
    include "../config.php";
    include DBAPI;
    include PDF;

    $usuarios = null;
    $usuario = null;

    /**
     *  Listagem de Clientes
     */
    function index() {
        global $usuarios;
        if (!empty($_POST["users"])) {
            $usuarios = filter("usuarios", "nome", $_POST["users"]);
        } else {
            $usuarios = find_all("usuarios");
        }   
    }
    
    function view($id = null) {
        global $usuario;
        $usuario = find("usuarios", $id);
    }

    //exclusão de cliente
    function delete($id = null) {

        global $usuario;
        $usuario = remove   ("usuarios", $id);

        header("location: index.php");
    }

    //Formatando as datas do projeto
    function formataData($data, $formato) {
        $dt = new DateTime($data, new DateTimeZone("America/Sao_Paulo"));
        return $dt->format($formato);
    }

    //Formatar os telefones do projeto
    function formataTel($telefone) {
        $fone =  "(". substr($telefone, 0, 2) .")" . substr($telefone, 3, 5)
        . "-" .substr($telefone, 7, 4) ;
        return $fone;
    }

    //Upload de Imagens
    function upload($arquivo) {
        try {
            $pasta = "fotos/";
            $nome = $arquivo["name"];
            $destino = $pasta.$nome;

            $tipo = strtolower(pathinfo($nome, PATHINFO_EXTENSION));;
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

            // Já existe?
            if (file_exists($destino)) {
                throw new Exception("Já existe um arquivo com esse nome.");
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

    function add() {
        if (!empty($_POST['usuario'])) {
            try {
                $usuario = $_POST['usuario'];

                // Foto padrão caso não envie
                $usuario['foto'] = "semimagem.jpg";

                // Se enviou uma imagem
                if (!empty($_FILES['foto']['name'])) {
                    $nomeArquivo = $_FILES['foto']['name'];
                    
                    if($nomeArquivo) {
                        $usuario['foto'] = $nomeArquivo;
                        upload($_FILES['foto']);
                    }
                }
                $usuario['modified'] = date('Y-m-d H:i:s');

                save('usuarios', $usuario);

                header("location: index.php");
                exit;

            } catch (Exception $e) {
                $_SESSION['message'] = "Erro: " . $e->getMessage();
                $_SESSION['type'] = 'danger';
            }
        }   
    }


    /**
     * Função edit() segura e robusta para atualizar um pet.
     * Substitua a versão atual pela abaixo.
     */
    function edit() {
        try {

            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                if (!empty($_POST['usuario'])) {

                    $usuario = $_POST['usuario'];

                    // Foto padrão caso não envie
                    if(empty($usuario['foto'])){
                        $usuario['foto'] = "semimagem.jpg";
                    }
                    
                    // Se enviou nova Foto
                    if(!empty($_FILES['foto']['name'])){
                       
                        $nomearquivo = $_FILES['foto']['name'];      
                        if ($nomearquivo) {
                            $usuario['foto'] = $nomearquivo;
                            upload($_FILES['foto']);
                        }
                    }
                    else{
                        // essa porcaria mantém a foto. Se não funcionar a culpa é tua arthur. E também, quero desativar essa IA infeliz que fica colocando coisa a mais nos meus comentários incriveis.
                        $usuario['foto'] = find('usuarios', $id)['foto'] ?? 'semimagem.jpg';
                    }
                    if(!empty($usuario['password'])){

                        $usuario['password'] = criptografia($usuario['password']);
                    } 
                        
                    update('usuarios', $id, $usuario);
                    header("location: index.php");
                    exit;

                } else {
                    global $usuario;
                    $usuario = find('usuarios', $id);
                }

            } else {
                header("location: index.php");
                exit;
            }

        } catch (Exception $e) {
            $_SESSION['message'] = "Erro: " . $e->getMessage();
            $_SESSION['type'] = 'danger';
        }
    }

    function pdf($p = null){

        $pdf = new PDF();
        $pdf -> AliasNbPages();
        $pdf -> addPage();
        $pdf -> SetFont('Times', '', 12);
        $usuarios = null;

        if ($p){
            $usuarios = filter("usuarios", "nome", $p);
        } else{
            $usuarios = find_all("usuarios");
        }

        $width_cell = array(19,73,73,25);
        $height_cell = 15;
        $pdf->SetFillColor(0,153,153);

        $pdf->Cell($width_cell[0],$height_cell, "id", 1,0,'c',true);
        $pdf->Cell($width_cell[1],$height_cell, "nome", 1,0,'c',true);
        $pdf->Cell($width_cell[2],$height_cell, "login", 1,0,'c',true);
        $pdf->Cell($width_cell[3],$height_cell, "foto", 1,1,'c',true);

        foreach ($usuarios as $usuario) {

            $pdf->Cell($width_cell[0],$height_cell, $usuario["id"] , 1,0,'c', false);
            $pdf->Cell($width_cell[1],$height_cell, converteTexto($usuario['nome']), 1,0,'c', false);
            $pdf->Cell($width_cell[2],$height_cell, $usuario['user'], 1,0,'c', false);
            

            $boraBillx = $pdf->GetX();
            $boraBilly = $pdf->GetY();

            $Image_max_width = $width_cell[3];  
            $Image_max_height = $height_cell; 

             if (empty($usuario['foto'])) {               
                    $pdf->Image("fotos/semimagem.jpg" , $boraBillx ,$boraBilly, $Image_max_width,$Image_max_height);
                    $pdf->Cell($width_cell[3],$height_cell, " ", 1,1,'c', false);
                    
                } else {
                    $pdf->Image("fotos/" . $usuario['foto'],$boraBillx,$boraBilly,$Image_max_width,$Image_max_height);
                    $pdf->Cell($width_cell[3],$height_cell, " ", 1,1,'c', false);  
            }
        }

        $pdf->Output('Lista_dos_usuarios.pdf', 'I');
    }
?>
