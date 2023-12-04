<?php
include_once "conexao.php";

//paginação
$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_NUMBER_INT);

if (!empty($pagina)) {

        // Cálculo do início da visualização
        $qnt_result_pg = 3; //Quantidade de registro por página
        $inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

    $query_produtos = "SELECT nome, quantidade, preco, descricao, dia, hora, id FROM produtos ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
    $result_produtos = $conn ->prepare($query_produtos);
    $result_produtos->execute();

    $dados = "<div class='table-responsive'>
                <table class='table table-stripped table-bordered'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Quantidade</th>
                            <th>Preço</th>
                            <th>Descrição</th>
                            <th>Dia</th>
                            <th>Hora</th>
                            
                        </tr>
                </thead>
                <tbody>";


        while($row_produto = $result_produtos->fetch(PDO::FETCH_ASSOC)){
            extract($row_produto);
            $dados .= "<tr>
                        <td>$nome</td>
                        <td>$quantidade</td>
                        <td>$preco</td>
                        <td>$descricao</td>
                        <td>$dia</td>
                        <td>$hora</td>
                        
                        <td>
                            <button id='$id' class='btn btn-primary btn-sm' onclick='visProduto($id)'>Ver Detalhes</button>
                            
                            <button id='$id' class='btn btn-warning btn-sm' onclick='editProduto($id)'>Editar</button>
                            
                            <button id='$id' class='btn btn-danger btn-sm' onclick='apagarProduto($id)'>Apagar</button></td>
                    </tr>";
        }

    $dados .= "</tbody>
            </table>
        </div>";

    // Paginação - Somar a quantidade de produtos
    $query_pg = "SELECT COUNT(id) AS num_result FROM produtos";
    $result_pg = $conn->prepare($query_pg);
    $result_pg->execute();
    $row_pg = $result_pg->fetch(PDO::FETCH_ASSOC);

    //Quantidade de páginas
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    $max_links = 2;

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination pagination-sm justify-content-center">';
    $dados .= "<li class='page-item'><a href='#' class='page-link' onclick='listarProdutos(1)'>Primeira</a></li>";
    
    for($pagina_ant = $pagina - $max_links; $pagina_ant <= $pagina - 1; $pagina_ant++){
        if($pagina_ant >= 1){
            $dados .= "<li class='page-item'><a class='page-link' onclick='listarProdutos($pagina_ant)' href='#'>$pagina_ant</a></li>";
        }
        
    }
    
    $dados .= "<li class='page-item active'><a class='page-link' href='#'>$pagina</a></li>";
    for($pagina_dep = $pagina + 1; $pagina_dep <= $pagina + $max_links; $pagina_dep++){
        if($pagina_dep <= $quantidade_pg){
            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='listarProdutos($pagina_dep)'>$pagina_dep</a></li>";
        }
    }

    $dados .= "<li class='page-item'> <a class='page-link' href='#' onclick='listarProdutos($quantidade_pg)'>Última</a></li>";
      
      $dados .= '</ul></nav>';

    echo $dados; 

} else {
    echo "<div class='alert alert-danger' role='alert'>Erro: Nenhum produto encontrado!</div>";
}