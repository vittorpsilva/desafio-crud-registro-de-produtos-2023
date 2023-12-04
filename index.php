<?php
include_once "conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>CRUD de Produtos</title>
</head>
<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 d-flex justify-content-between align-items-center">
                <div>
                    <h4>Listar Produtos</h4>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#cadProdutoModal">
                        Cadastrar
                    </button>
                </div>
            </div>
        </div>
        <hr>

        <span id="msgAlerta"></span>
        <!-- listagem dos produtos -->
        <div class="row">
            <div class="col-lg-12">
                    <span class="listar-produtos"></span>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar -->
    <div class="modal fade" id="cadProdutoModal" tabindex="-1" aria-labelledby="cadProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="cadProdutoModalLabel">Cadastrar Produto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="cad-produto-form">
                <span id="msgAlertaErroCad"></span>
                <div class="mb-3">
                    <label for="nome" class="col-form-label">Nome:</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome do produto">
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="col-form-label">Quantidade:</label>
                    <input type="number" name="quantidade" class="form-control" id="quantidade" placeholder="Digite a quantidade">
                </div>
                <div class="mb-3">
                    <label for="preco" class="col-form-label">Preço:</label>
                    <input type="number" name="preco" class="form-control" id="preco" placeholder="Digite o preço">
                </div>
                <div class="mb-3">
                    <label for="descricao" class="col-form-label">Descrição:</label>
                    <input type="text" name="descricao" class="form-control" id="descricao" placeholder="Digite a descrição do produto">
                </div>
                <input type="hidden" name="dia" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="hora" value="<?php echo date('H:i:s'); ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-outline-success btn-sm" id="cad-produto-btn" value="Cadastrar" />
                </div>
            </form>
        </div>
        
        </div>
    </div>
    </div>

       <!-- Modal Visualizar -->
       <div class="modal fade" id="visProdutoModal" tabindex="-1" aria-labelledby="visProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="visProdutoModalLabel">Detalhes do Produto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <span id="msgAlertaErroVis"></span>
            <dl class="row">
                <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"> <span id="nomeProduto"></span> </dd>

                <dt class="col-sm-3">Quantidade</dt>
                    <dd class="col-sm-9"> <span id="quantidadeProduto"></span> </dd>
                <dt class="col-sm-3">Preço</dt>
                    <dd class="col-sm-9"> <span id="precoProduto"></span> </dd>
                <dt class="col-sm-3">Descrição</dt>
                    <dd class="col-sm-9"> <span id="descricaoProduto"></span> </dd>
                <dt class="col-sm-3">Dia</dt>
                    <dd class="col-sm-9"> <span id="diaProduto"></span> </dd>
                <dt class="col-sm-3">Hora</dt>
                    <dd class="col-sm-9"> <span id="horaProduto"></span> </dd>
            </dl>
        </div>
        
        </div>
    </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editProdutoModal" tabindex="-1" aria-labelledby="editProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="editProdutoModalLabel">Editar Produto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="edit-produto-form">
                <span id="msgAlertaErroEdit"></span>
                    
                <input type="hidden" name="id" id="editid">
                <div class="mb-3">

                    <label for="nome" class="col-form-label">Nome:</label>
                    <input type="text" name="nome" class="form-control" id="editnome" placeholder="Digite o nome do produto">
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="col-form-label">Quantidade:</label>
                    <input type="number" name="quantidade" class="form-control" id="editquantidade" placeholder="Digite a quantidade">
                </div>
                <div class="mb-3">
                    <label for="preco" class="col-form-label">Preço:</label>
                    <input type="number" name="preco" class="form-control" id="editpreco" placeholder="Digite o preço">
                </div>
                <div class="mb-3">
                    <label for="descricao" class="col-form-label">Descrição:</label>
                    <input type="text" name="descricao" class="form-control" id="editdescricao" placeholder="Digite a descrição do produto">
                </div>
                <input type="hidden" name="dia" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="hora" value="<?php echo date('H:i:s'); ?>">
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                    <input type="submit" class="btn btn-warning btn-sm" id="edit-produto-btn" value="Salvar" />
                </div>
            </form>
        </div>
        
        </div>
    </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="js/custom4.js"></script>
    
</body>
</html>