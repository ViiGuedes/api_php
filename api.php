<?php
    header("Content-Type: application/json, charset=UTF-8");//DEFINE O TIPO DE RESPOSTA

    $metodo = $_SERVER['REQUEST_METHOD'];
    //echo "metodo de requisicao" . $metodo;

    //RECUPERA O ARQUIVO JSON NA MESMA PASTA DO PROJETO
    $arquivo = 'usuaios.json';
    
    //VERIFICA SE O ARQUIVO EXISTE, SE NÃO EXISTIR CRIA UM COM ARRAY VAZIO
    if(!file_exists($arquivo)){
        file_put_contents($arquivo,json_encode([],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    }

    //LE O CONTEUDO DO ARQUIVO JSON
    $$usuarios = json_decode(file_get_contents($arquivo), true);

    //CONTEUDO

    $usuarios = [
    ["id" =>1, "nome"=> "Maria Souza", "email"=>"maria@email.com"],
    ["id" =>2, "nome"=> "Joao Silva", "email"=>"joao@email.com"]

    ];

    // echo "Método da requisição: ". $metodo;

    switch ($metodo) {
        case 'GET':
            //echo "AQUI AÇÕES DO MÉTODO GET";
            //Converte para JSON e retorna 
            echo json_encode($usuarios);
            break;
      
        case 'POST':
            //echo "AQUI AÇÕES DO MÉTODO POST";
            $dados = json_decode (file_get_contents('php://input'),true);
            //print_r($dados);

        if (!isset ($dados["id"]) || !isset($dados["nome"]) || !isset($dados["email"])){
            http_resposta_code(400);
            echo json_(["erro" => "Dados incompletos."], JSON_UNESCAPED_UNICODE);
            exit;
        }
        
            $novoUsuario = [
            "id" => $dados ["id"],
            "nome" => $dados["nome"],
            "email" => $dados ["email"]
            ];

        $suarios[] = $novoUsuario;
        
        file_put_encode(["mensagem" => "Usuario inserido com sucesso!" , "usuarios" => $usuarios], JSON_UNESCAPED_UNICODE);
        break;

            //aray_push($usuarios, $novoUsuario);
            //echo json_encode('Usuario inserido com sucesso! ');
            //print_r($usuarios);
            
            break;

        default:
            //echo "MÉTODO NÃO ENCONTRADO!";
            //break;
            http_response_code(405);//Metodo nao permitido
            echo json_encode(["erro" => "metodo nao permitido!"], JSON_UNESCAPED_UNICODE);
            break;
    }

    //CONTEUDO
    // $usuarios = [
    //     ["id" => 1, "nome" => "Fulano", "email" => "fulano@email"],
    //     ["id" => 2, "nome" => "Ciclano", "email" => "ciclano@email"]



    // ];
    
    // echo json_encode($usuarios);







?>