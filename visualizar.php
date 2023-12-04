<?php
include_once "conexao.php";

//paginação
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_produto = "SELECT id, nome, quantidade, preco, descricao, dia, hora FROM produtos WHERE id =:id LIMIT 1";
    $result_produto = $conn->prepare($query_produto);
    $result_produto->bindParam(':id', $id);
    $result_produto->execute();

    // para ler o que está dentro
    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);

    $retorna = ['erro' => false, 'dados' => $row_produto];

} else {
    $retorna = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>"];
}

echo json_encode($retorna);