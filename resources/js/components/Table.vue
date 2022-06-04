<template>

    <div>

        <table class="table table-hover shadow-lg p-3 mb-2 bg-body rounded">
            <thead>
                <tr>
                    <th  v-for="t, key in title_br" :key="key" class="text-uppercase" >{{t}}</th>
                </tr>
            </thead>
            <tbody>
                <tr  v-for="obj in data_br" :key="obj.id">
                    <td v-if="title_br.includes(key_br)" v-for="value, key_br in obj" :key="key_br">
                        <span v-if="key_br == 'image'">
                            <img :src="'/storage/'+value" width="30" height="30">
                        </span>
                        <span v-else>
                            {{ value }}
                        </span>
                    </td>

                    <!--
                    <th scope="row">{{m.id}}</th>
                    <td >{{m.name}}</td>
                    <td ><img :src="'/storage/'+m.image" width="30" height="30"></td> -->
                </tr>
            </tbody>
        </table>

    </div>

</template>

<script>
    export default {
        props: ['data_br', 'title_br']
    }
</script>
