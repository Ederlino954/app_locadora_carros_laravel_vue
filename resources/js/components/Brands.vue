<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-header ">Busca de Marcas</div>

                    <div class="card-body">

                        <div class="form-row">
                            <div class="col mb-3">
                                <label for="inputId" class="form-label">ID</label>
                                <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" aria-placeholder="ID">
                                <div id="idHelp" class="form-text text-muted">Opcional. Informe o id do registro</div>
                            </div>
                            <div class="col mb-3">
                                <label for="inputNome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="inputId" aria-describedby="nomeHelp" aria-placeholder="Nome da marca">
                                <div id="nomeHelp" class="form-text text-muted">Opcional. Informe o nome da marca</div>
                            </div>
                        </div>

                        <div class="card shadow p-2 mb-2 bg-body rounded">
                            <button type="submit" class="btn btn-primary btn-sm ">Pesquisar</button>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>

</template>

<script>

</script>
