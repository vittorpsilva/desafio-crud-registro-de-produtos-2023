<?php
include_once "conexao.php";

//paginação
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_produto = "DELETE FROM produtos WHERE id=:id";
    $result_produto = $conn->prepare($query_produto);
    $result_produto->bindParam(':id', $id);

    if($result_produto->execute()){
        $retorna = ['erro' => false, 'msg' => "<div class='alert alert-success' role='alert'>Produto apagado com sucesso!</div>"];
    } else {
        $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: falha ao excluir do produto</div>"];
    }

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>"];
}

echo json_encode($retorna);