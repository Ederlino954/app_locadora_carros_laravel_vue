<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Inicio do card de busca teste -->
                <!-- {{ $store.state.teste }} teste -->
                <!-- <button @click="$store.state.teste = 'Modifiquei o valor da store do vuex - teste' ">teste</button> -->
                    <card-component title="Busca de Marcas">
                        <template v-slot:contentCard>
                            <div class="form-row ">

                                <div class="col mb-3">
                                    <input-container-component title="ID" id="inputId" id-help="idHelp" text-help="Informe o id do registro" >
                                        <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" aria-placeholder="ID" v-model="search.id" >
                                    </input-container-component>
                                </div>

                                <div class="col mb-3">
                                    <input-container-component title="Nome da Marca" id="inputNome" id-help="nomeHelp" text-help="Informe o nome da Marca" >
                                        <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" aria-placeholder="Nome da Marca" v-model="search.name">
                                    </input-container-component>
                                </div>

                            </div>
                        </template>

                        <template v-slot:footerCard>
                            <div class="card shadow p-1 mb-2 bg-body rounded">
                                <button type="submit" class="btn btn-primary btn-sm " @click="search_b()">Pesquisar</button>
                            </div>
                        </template>

                    </card-component>
                <!-- fim do card de busca -->
                <!-- -------------------------------- -->
                <!-- inicio do card de listagem de marcas -->
                    <card-component title="Relação de Marcas">

                        <template v-slot:contentCard>
                            <!-- .data pegando quant de paginate -->
                            <table-component
                                :data_br="brands.data"
                                :view="{ visible: true, dataToggle: 'modal', dataTarget: '#modalBrandView' }"
                                :update="{ visible: true, dataToggle: 'modal', dataTarget: '#modalBrandUpdate' }"
                                :remove="{ visible: true, dataToggle: 'modal', dataTarget: '#modalBrandRemove' }"
                                :title_br="{
                                    id: {title: 'ID', type: 'text'},
                                    name:{title: 'Nome', type: 'text'},
                                    image: {title: 'Imagem', type: 'image'},
                                    created_at:{title: 'Criado em', type: 'data'},
                                }"
                            ></table-component>
                        </template>

                        <template v-slot:footerCard>
                            <button type="button" class="btn btn-primary btn-sm float-right border mt-1 " data-toggle="modal" data-target="#modalBrand">Adicionar</button>
                            <paginate-component>
                                <li v-for="l, key in brands.links" :key="key"
                                    :class="l.active ? 'page-item active' : 'page-item'"
                                    @click="pagination(l)"
                                >
                                    <a class="page-link" v-html="l.label"></a>
                                    <!-- {{ l.active }} -->
                                </li>
                            </paginate-component>
                        </template>

                    </card-component>
                <!-- fim do card de listagem de marcas -->
            </div>

        </div>
        <!-- início do modal inclusão marca -->
            <modal-component id="modalBrand" title="Adiconar Marca">

                <template v-slot:alerts>
                    <alert-component type="success" :details="transactionDetails" titleB="Cadastro realizado com sucesso!" v-if="transactionStatus == 'added'"></alert-component>
                    <alert-component type="danger" :details="transactionDetails" titleB="Erro ao tentar cadastrar a Marca" v-if="transactionStatus == 'error'"></alert-component>
                </template>

                <template v-slot:content>
                    <div class="form-group">
                        <input-container-component title="Nome da Marca" id="newName" id-help="newNameHelp" text-help="Informe o nome da Marca" >
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

        <!-- fim do modal inclusão marca  -->
        <!-- ---------------------------------- -->
        <!-- inicio do modal visualização marca  -->
            <modal-component id="modalBrandView" title="Visualizar Marca">

                <template v-slot:alerts>

                </template>

                <template v-slot:content>

                    <input-container-component title="ID">
                        <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                    </input-container-component>

                    <input-container-component title="Nome da marca">
                        <input type="text" class="form-control" :value="$store.state.item.name" disabled>
                    </input-container-component>

                    <div class="card ">
                        <input-container-component title="Imagem" class="text-center">
                            <img :src="'/storage/'+$store.state.item.image" v-if="$store.state.item.image">
                        </input-container-component>
                    </div>

                    <input-container-component title="Criado em">
                        <input type="text" class="form-control" :value="$store.state.item.created_at" disabled>
                    </input-container-component>

                </template>

                <template v-slot:footer>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </template>

            </modal-component>
        <!-- fim do modal visualização marca  -->
        <!-- -------------------------------- -->
        <!-- inicio do modal remoção marca  -->
            <modal-component id="modalBrandRemove" title="Remover Marca">

                <template v-slot:alerts>
                    <alert-component type="success"  titleB="Transação realizada com sucesso!" :details="$store.state.transaction" v-if="$store.state.transaction.status == 'success'"></alert-component>
                    <alert-component type="danger"  titleB="Erro ao tentar fazer a transação" :details="$store.state.transaction" v-if="$store.state.transaction.status == 'error'"></alert-component>
                </template>

                <template v-slot:content v-if="$store.state.transaction.status != 'success'">
                    <input-container-component title="ID">
                        <input type="text" class="form-control" :value="$store.state.item.id" disabled>
                    </input-container-component>

                    <input-container-component title="Nome da marca">
                        <input type="text" class="form-control" :value="$store.state.item.name" disabled>
                    </input-container-component>

                </template>

                <template v-slot:footer>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger" @click="remove()" v-if="$store.state.transaction.status != 'success'">Remover</button>
                </template>

            </modal-component>
        <!-- fim do modal remoção marca   -->
        <!-- ------------------------------ -->
        <!-- início do modal atualização marca -->
            <modal-component id="modalBrandUpdate" title="Atualizar Marca">

                <template v-slot:alerts>
                    <alert-component type="success"  titleB="Transação realizada com sucesso!" :details="$store.state.transaction" v-if="$store.state.transaction.status == 'success'"></alert-component>
                    <alert-component type="danger"  titleB="Erro ao tentar fazer a transação" :details="$store.state.transaction" v-if="$store.state.transaction.status == 'error'"></alert-component>
                </template>

                <template v-slot:content>
                    <div class="form-group">
                        <input-container-component title="Nome da Marca" id="updateName" id-help="updateNameHelp" text-help="Informe o nome da Marca" >
                            <input type="text" class="form-control" id="updateName" aria-describedby="updateNameHelp" aria-placeholder="Nome da Marca" v-model="$store.state.item.name">
                        </input-container-component>
                    </div>

                    <div class="form-group">
                        <input-container-component title="Imagem" id="updateImage" id-help="updateImageHelp" text-help="Selecioe uma imagem no formato PNG" >
                            <input type="file" class="form-control-file" id="updateImage" aria-describedby="updateImageHelp" aria-placeholder="Selecione uma imagem" @change="loadImage($event)">
                        </input-container-component>
                    </div>

                </template>

                <template v-slot:footer>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" @click="update()">Atualizar</button>
                </template>

            </modal-component>

        <!-- fim do modal atualização marca  -->

    </div>

</template>

<script>
import InputContainer from './InputContainer.vue';
    export default {
  components: { InputContainer },
        data() {
            return {
                baseUrl : 'http://127.0.0.1:8000/api/v1/brand',
                paginateUrl: '',
                filterUrl : '',
                nameB : '',
                fileImage : [],
                transactionStatus: '', // responsavel pela direção do fluxo de Alertas
                transactionDetails: {},
                brands: { data: [] }, // [] para evitar erro de carregamento assíncrono
                search: { id: '', name: '' }

            }
        },
        methods: {
            update(){

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                let formData = new FormData();
                formData.append('_method', 'patch')
                formData.append('name', this.$store.state.item.name)

                if ('image', this.fileImage[0]) {
                    formData.append('image', this.fileImage[0])
                }

                let url = this.baseUrl + '/' + this.$store.state.item.id;

                axios.post(url, formData, config)
                    .then(response => {
                         this.$store.state.transaction.status = 'success'
                        this.$store.state.transaction.message = 'registro de marca atualizado com suceso!'
                        updateImage.value = '' // limpa o campo de seleção de arquivos utilizando o id do input
                        this.loadList()
                    })
                    .catch(errors => {
                        this.$store.state.transaction.status = 'error'
                        this.$store.state.transaction.message = errors.response.data.message
                        this.$store.state.transaction.dataB = errors.response.data.errors
                    })


            },
            remove(){
                let confirmation = confirm('Deseja realmente remover esta marca?')

                if (!confirmation) return false;

                let formData = new FormData();
                formData.append('_method', 'DELETE')

                let url = this.baseUrl + '/' + this.$store.state.item.id
                // let url = this.baseUrl + '/12450' // teste

                axios.post(url, formData)
                    .then(response => {
                        this.$store.state.transaction.status = 'success'
                        this.$store.state.transaction.message = response.data.msg
                        this.loadList()
                    })
                    .catch(errors => {
                        this.$store.state.transaction.status = 'error'
                        this.$store.state.transaction.message = errors.response.data.erro
                    })
            },
            search_b(){

                let filt_b = ''

                for (let key in this.search) {

                    if(this.search[key]){
                        // console.log(key, this.search[key]);
                        if(filt_b != '') {
                            filt_b += ';'
                        }

                        filt_b += key + ':like:' + this.search[key]
                    }
                }
                // console.log(filt_b);
                if (filt_b != '') {
                    this.paginateUrl = 'page=1'
                    this.filterUrl = '&filt=' + filt_b
                } else {
                    this.filterUrl = ''
                }

                this.loadList()
            },
            pagination(l){
                if(l.url) {
                    this.paginateUrl = l.url.split('?')[1]
                    this.loadList() // requisitando novamente os dados para a API
                }
            },
            loadList(){
                let url = this.baseUrl + '?' + this.paginateUrl + this.filterUrl

                axios.get(url)
                .then(response => {
                    this.brands = response.data
                })
                .catch(errors => {
                    console.log(errors)
                })
            },
            loadImage(e) {
                this.fileImage = e.target.files;
            },
            saveBrand() {

                let formData = new FormData();
                formData.append('name', this.nameB);
                formData.append('image', this.fileImage);

                let config = {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                };

                axios.post(this.baseUrl, formData, config)
                    .then(response => {
                        this.transactionStatus = 'added'
                        this.transactionDetails = {
                            // messageB: 'ID do registro: ' + response.data.id,
                            message: 'nome do registro cadastrado: ' + response.data.name
                        }
                    })
                    .catch(errors => {
                        this.transactionStatus = 'error'
                        this.transactionDetails = {
                            message: errors.response.data.message,
                            dataB: errors.response.data.errors
                        }
                    });
            }
        },
        mounted() {
            this.loadList()
        }

    }
</script>
