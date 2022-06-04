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
                        <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp" aria-placeholder="Nome da Marca" v-model="nameBrand">
                    </input-container-component>
                    {{ nameBrand }}
                </div>

                <div class="form-group">
                    <input-container-component title="Imagem" id="newImage" id-help="newImageHelp" text-help="Selecioe uma imagem no formato PNG" >
                        <input type="file" class="form-control-file" id="newImage" aria-describedby="newImageHelp" aria-placeholder="Selecione uma imagem" @change="loadImage($event)">
                    </input-container-component>
                    {{ fileImage }}
                </div>
            </template>

            <template v-slot:footer>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="saveBrand()">Salvar</button>
            </template>

        </modal-component>
    </div>

</template>

<script>
    export default {
        computed: {
                token() {

                // recuperando os tokens de autorização dos kookies
                let token = document.cookie.split(';').find(indice => {
                    return indice.includes('token=') // true quando o indice inicia com token=
                })

                token = token.split('=')[1];
                token = token.split('SameSite')[0];
                token = 'Bearer ' + token
                console.log(token)

                return token
            }
        },
        data() {
            return {
                baseUrl: 'http://127.0.0.1:8000/api/v1/brand',
                nameBrand: '',
                fileImage: []
            }
        },
        methods: {

            loadImage(e) {
                this.fileImage = e.target.files[0];
            },
            saveBrand() {

                let formData = new FormData();
                formData.append('name', this.nameBrand);
                formData.append('image', this.fileImage);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                };

                axios.post(this.baseUrl, formData, config)
                    .then(response => {
                        console.log(response);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }
    }
</script>
