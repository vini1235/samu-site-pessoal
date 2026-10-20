<?php

include_once '../../conexao/conexao.php';

$cpf = filter_input(INPUT_GET, 'cpf',FILTER_SANITIZE_SPECIAL_CHARS);
if(!empty($cpf)){
    
    $limit = 1;
    $result_aluno = "SELECT * FROM cadastro_geral WHERE cpf =:cpf LIMIT :limit";
    
    $resultado_aluno = $conn->prepare($result_aluno);
    $resultado_aluno->bindParam(':cpf', $cpf, PDO::PARAM_STR);
    $resultado_aluno->bindParam(':limit', $limit, PDO::PARAM_INT);
    $resultado_aluno->execute();
    
    $array_valores = array();
    
    if($resultado_aluno->rowCount() != 0){
        $row_aluno = $resultado_aluno->fetch(PDO::FETCH_ASSOC);
        $array_valores['nome_aluno'] = $row_aluno['nome_aluno']; 
        $array_valores['rg'] = $row_aluno['rg']; 
    }else{
        $array_valores['nome_aluno'] = 'Aluno não encontrado';        
    }
    echo json_encode($array_valores);
}