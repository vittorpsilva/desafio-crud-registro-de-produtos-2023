<?php

include_once "conexao.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if(empty ($dados['id'])){
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: tente mais tarde.</div>"];

} elseif (empty ($dados['nome'])){
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite o nome.</div>"];

} elseif (empty($dados['quantidade'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite a quantidade.</div>"];

} elseif (empty($dados['preco'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite o preço.</div>"];

} elseif (empty($dados['descricao'])) {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Digite a descrição.</div>"];

} else {
    // solicitação de atualização no banco de dados
    $query_produto = "UPDATE produtos SET nome=:nome, quantidade=:quantidade, preco=:preco, descricao=:descricao, dia=:dia, hora=:hora WHERE id=:id";
    $edit_produto = $conn->prepare($query_produto);
    $edit_produto->bindParam(':nome', $dados['nome']);
    $edit_produto->bindParam(':quantidade', $dados['quantidade']);
    $edit_produto->bindParam(':preco', $dados['preco']);
    $edit_produto->bindParam(':descricao', $dados['descricao']);
    $edit_produto->bindParam(':dia', $dados['dia']);
    $edit_produto->bindParam(':hora', $dados['hora']);
    $edit_produto->bindParam(':id', $dados['id']);

    if($edit_produto->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'> Produto editado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Falha na edição do produto.</div>"];
    }
}

echo json_encode($retorna);