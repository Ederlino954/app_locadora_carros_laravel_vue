<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Inicio do card de busca -->
                    <card-component title="Busca de Marcas">
                        <template v-slot:contentCard>
                            <div class="form-row ">

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
                        </template>

                        <template v-slot:footerCard>
                            <div class="card shadow p-1 mb-2 bg-body rounded">
                                <button type="submit" class="btn btn-primary btn-sm ">Pesquisar</button>
                            </div>
                        </template>

                    </card-component>
                <!-- fim do card de busca -->

                <!-- inicio do card de listagem de marcas -->
                    <card-component title="Relação de Marcas">

                        <template v-slot:contentCard>
                            <table-component></table-component>
                        </template>

                        <template v-slot:footerCard>
                            <div class="card shadow p-1  bg-body rounded">
                                <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#modalBrand">Adicionar</button>
                            </div>
                        </template>

                    </card-component>
                <!-- fim do card de listagem de marcas -->
            </div>

        </div>
        <modal-component id="modalBrand" title="Adiconar Marca"></modal-component>
    </div>

</template>

<script>

</script>
