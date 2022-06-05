<template>

    <div>

        <table class="table table-hover shadow-lg p-3 mb-2 bg-body rounded">

            <thead>
                <tr>
                    <th  v-for="t, key in title_br" :key="key">{{t.title}}</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="obj, key_br in filteredData" :key="key_br">
                    <td v-for="value, keyValue in obj" :key="keyValue">
                        <span v-if="title_br[keyValue].type == 'text'">{{value}}</span>
                        <span v-if="title_br[keyValue].type == 'data'">{{'....'+value}}</span>
                        <span v-if="title_br[keyValue].type == 'image'">
                            <img :src="'/storage/'+value" width="30" height="30">
                        </span>
                    </td>
                </tr>
            </tbody>

        </table>

    </div>

</template>

<script>
    export default {
        props: ['data_br', 'title_br'],
        computed: {
            filteredData(){

                console.log(this.data_br);
                let fields = Object.keys(this.title_br); // pegando a chaves dos objetos
                let filteredData = []

                this.data_br.map((item, key) => {

                    let filteredItem = {};
                    fields.forEach(field => {

                        filteredItem[field] = item[field]; // utilizar a sintaxe de array para atribuir valores a objetos
                    })
                    filteredData.push(filteredItem)
                });

                return filteredData; // retorna um array de objetos
            }
        }
    }
</script>
