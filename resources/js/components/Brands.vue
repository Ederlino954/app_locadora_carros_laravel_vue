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
        
        <modal-component id="modalBrand" title="Adiconar Marca">

            <template v-slot:content>
                <div class="form-group">
                    <input-container-component title="Nome da Marca" id="newName" id-help="newNameHelp" text-help="Opcional. Informe o nome da Marca" >
                        <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp" aria-placeholder="Nome da Marca">
                    </input-container-component>
                </div>

                <div class="form-group">
                    <input-container-component title="Imagem" id="newImage" id-help="newImageHelp" text-help="Selecioe uma imagem no formato PNG" >
                        <input type="file" class="form-control-file" id="newImage" aria-describedby="newImageHelp" aria-placeholder="Selecione uma imagem">
                    </input-container-component>
                </div>
            </template>

            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>

        </modal-component>
    </div>

</template>

<script>

</script>
