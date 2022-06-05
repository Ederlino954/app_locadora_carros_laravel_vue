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
                            <!-- .data pegando quant de paginate -->
                            <table-component
                                :data_br="brands.data"
                                :title_br="{
                                    id: {title: 'ID', type: 'text'},
                                    name:{title: 'Nome', type: 'text'},
                                    image: {title: 'Imagem', type: 'image'},
                                    created_at:{title: 'Criado em', type: 'data'},
                                }"
                            ></table-component>
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
        <!-- início do modal  -->
            <modal-component id="modalBrand" title="Adiconar Marca">

                <template v-slot:alerts>
                    <alert-component type="success" :details="transactionDetails" titleB="Cadastro realizado com sucesso!" v-if="transactionStatus == 'added'"></alert-component>
                    <alert-component type="danger" :details="transactionDetails" titleB="Erro ao tentar cadastrar a Marca" v-if="transactionStatus == 'error'"></alert-component>
                </template>

                <template v-slot:content>
                    <div class="form-group">
                        <input-container-component title="Nome da Marca" id="newName" id-help="newNameHelp" text-help="Opcional. Informe o nome da Marca" >
                            <input type="text" class="form-control" id="newName" aria-describedby="newNameHelp" aria-placeholder="Nome da Marca" v-model="nameB">
                        </input-container-component>
                        {{ nameB }}
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

        <!-- fim do modal  -->
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
                baseUrl : 'http://127.0.0.1:8000/api/v1/brand',
                nameB : '',
                fileImage : [],
                transactionStatus: '', // responsavel pela direção do fluxo de Alertas
                transactionDetails: {},
                brands: { data: [] }, // [] para evitar erro de carregamento assíncrono
            }
        },
        methods: {
            loadList(){
                let config = {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                };
                axios.get(this.baseUrl, config)
                .then(response => {
                    this.brands = response.data
                    console.log(this.brands);
                })
                .catch(errors => {
                    console.log(errors)
                })
            },
            loadImage(e) {
                this.fileImage = e.target.files[0];
            },
            saveBrand() {

                let formData = new FormData();
                formData.append('name', this.nameB);
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
                        this.transactionStatus = 'added'
                        this.transactionDetails = {
                            messageB: 'ID do registro: ' + response.data.id
                        }

                        console.log(response);
                    })
                    .catch(errors => {
                        this.transactionStatus = 'error'
                        this.transactionDetails = {
                            messageB: errors.response.data.message,
                            dataB: errors.response.data.errors
                        }
                        // console.log(.data.message);
                    });
            }
        },
        mounted() {
            this.loadList()
        }

    }
</script>
