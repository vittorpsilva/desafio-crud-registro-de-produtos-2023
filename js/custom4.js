const tbody = document.querySelector(".listar-produtos");
const cadForm = document.getElementById("cad-produto-form");
const editForm = document.getElementById("edit-produto-form");
const msgAlertaErroCad = document.getElementById("msgAlertaErroCad");
const msgAlertaErroEdit = document.getElementById("msgAlertaErroEdit");
const msgAlerta = document.getElementById("msgAlerta");
const cadModal = new bootstrap.Modal(document.getElementById("cadProdutoModal"));

const listarProdutos = async(pagina) => {
    const dados = await fetch("./list.php?pagina=" + pagina);
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}

listarProdutos(1);

// cadastro de produtos
cadForm.addEventListener("submit", async (e) =>{
    e.preventDefault();

    const dadosForm = new FormData(cadForm);
    dadosForm.append("add", 1);

    document.getElementById("cad-produto-btn").value = "Salvando..."

    const dados = await fetch("cadastrar.php", {
        method:"POST",
        body: dadosForm,
    });

    const resposta = await dados.json();

    if(resposta['erro']){
        msgAlertaErroCad.innerHTML = resposta['msg'];
    } else {
        msgAlerta.innerHTML = resposta['msg'];
        cadForm.reset();
        cadModal.hide();
        listarProdutos(1);
    }
    document.getElementById("cad-produto-btn").value = "Cadastrar"
});

async function visProduto(id){
    // console.log("Acessou: " + id);

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const visModal = new bootstrap.Modal(document.getElementById("visProdutoModal"));
        visModal.show();

        document.getElementById("nomeProduto").innerHTML = resposta['dados'].nome;
        document.getElementById("quantidadeProduto").innerHTML = resposta['dados'].quantidade;
        document.getElementById("precoProduto").innerHTML = resposta['dados'].preco;
        document.getElementById("descricaoProduto").innerHTML = resposta['dados'].descricao;
        document.getElementById("diaProduto").innerHTML = resposta['dados'].dia;
        document.getElementById("horaProduto").innerHTML = resposta['dados'].hora;
    }
}

async function editProduto(id){
    msgAlertaErroEdit.innerHTML = "";

    const dados = await fetch('visualizar.php?id=' + id);
    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlerta.innerHTML = resposta['msg'];
    } else {
        const editModal = new bootstrap.Modal(document.getElementById("editProdutoModal"));
        editModal.show();

        document.getElementById("editid").value = resposta['dados'].id;
        document.getElementById("editnome").value = resposta['dados'].nome;
        document.getElementById("editquantidade").value = resposta['dados'].quantidade;
        document.getElementById("editpreco").value = resposta['dados'].preco;
        document.getElementById("editdescricao").value = resposta['dados'].descricao;
    }
}

// editar produto
editForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    document.getElementById("edit-produto-btn").value = "Salvando..."

    const dadosForm = new FormData(editForm);
    // console.log(dadosForm);
    /*for (var dadosFormEdit of dadosForm.entries()){
        console.log(dadosFormEdit[0] + " - " + dadosFormEdit[1]);
    }*/

    const dados = await fetch("editar.php", {
        method: "POST",
        body:dadosForm
    })

    const resposta = await dados.json();
    //console.log(resposta);

    if(resposta['erro']){
        msgAlertaErroEdit.innerHTML = resposta['msg'];
    } else {
        msgAlertaErroEdit.innerHTML = resposta['msg'];
        listarProdutos(1);
    }

    document.getElementById("edit-produto-btn").value = "Salvar"

});

async function apagarProduto(id){
    
    var confirmar = confirm("Tem certeza que deseja excluir o produto selecionado?");

    if(confirmar == true){
        const dados = await fetch('apagar.php?id=' + id);

        const resposta = await dados.json();
        if(resposta['erro']){
            msgAlerta.innerHTML = resposta['msg'];
        } else{
            msgAlerta.innerHTML = resposta['msg'];
            listarProdutos(1);
        }
    }
}