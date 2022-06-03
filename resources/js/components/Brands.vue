<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-header ">Busca de Marcas</div>

                    <div class="card-body">

                        <div class="form-row">
                            <div class="col mb-3">

                                <input-container-component title="ID" id="inputId" id-help="idHelp" text-help="Opcional. Informe o id do registro" >
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" aria-placeholder="ID">
                                </input-container-component>

                            </div>

                            <div class="col mb-3">

                                <input-container-component title="Nome da Marca" id="inputNome" id-help="nomeHelp" text-help="Opcional. Informe o nome da Marca" >
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" aria-placeholder="Nome da Marca">
                                </input-container-component>

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
