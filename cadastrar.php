<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty ($dados['nome'])){
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite o nome.</div>"];

} elseif (empty($dados['quantidade'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite a quantidade.</div>"];

} elseif (empty($dados['preco'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite o preço.</div>"];

} elseif (empty($dados['descricao'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite a descrição.</div>"];

} else {
    $query_produto = "INSERT INTO produtos (nome, quantidade, preco, descricao, dia, hora) VALUES (:nome, :quantidade, :preco, :descricao, :dia, :hora)";
    $cad_produto = $conn->prepare($query_produto);
    $cad_produto->bindParam(':nome', $dados['nome']);
    $cad_produto->bindParam(':quantidade', $dados['quantidade']);
    $cad_produto->bindParam(':preco', $dados['preco']);
    $cad_produto->bindParam(':descricao', $dados['descricao']);
    $cad_produto->bindParam(':dia', $dados['dia']);
    $cad_produto->bindParam(':hora', $dados['hora']);

    $cad_produto->execute();

    if($cad_produto->rowCount()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'> Produto cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Falha no cadastro do produto.</div>"];
    }
}

echo json_encode($retorna);