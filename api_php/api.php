<?php
    header("Content-Type: application/json");

    $metodo = $_SERVER['REQUEST_METHOD'];

    $arquivo = 'usuaios.json';
    
    if(!file_exists($arquivo)){
        file_put_contents($arquivo,json_encode([],JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    }

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
            $novoUsuario = [
            "id" => $dados ["id"],
            "nome" => $dados["nome"],
            "email" => $dados ["email"]
            ];


            aray_push($usuarios, $novoUsuario);
            echo json_encode('Usuario inserido com sucesso! ');
            print_r($usuarios);
            
            break;

        default:
            echo "MÉTODO NÃO ENCONTRADO!";
            break;
    }

    // $usuarios = [
    //     ["id" => 1, "nome" => "Fulano", "email" => "fulano@email"],
    //     ["id" => 2, "nome" => "Ciclano", "email" => "ciclano@email"]



    // ];
    
    // echo json_encode($usuarios);







?>