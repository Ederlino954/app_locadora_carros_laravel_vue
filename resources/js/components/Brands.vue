<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                    <!-- Inicio do card de busca -->
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

                    <!-- fim do card de busca -->

                    <!-- inicio do card de listagem de marcas -->

                <div class="card shadow-lg p-3 mb-5 bg-body rounded">
                    <div class="card-header ">Relação de Marcas</div>

                    <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>

                    </div>

                    <div class="card-footer" >
                        <div class="card">
                            <button type="button" class="btn btn-primary btn-sm ">Adicionar</button>
                        </div>
                    </div>
                </div>
                    <!-- fim do card de listagem de marcas -->
            </div>

        </div>
    </div>

</template>

<script>

</script>
