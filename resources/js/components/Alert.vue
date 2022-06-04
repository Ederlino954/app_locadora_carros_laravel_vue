<template>
    <div :class="style" role="alert">
        {{ titleB }}
        <hr>
        <p>{{ details.messageB }}</p>
        <br>
        <ul v-if="details.dataB">
            <li v-for="e, key in details.dataB" :key="key"> {{e[0]}} </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['type', 'titleB', 'details'],
        computed: {
            style() {
                // return `alert alert-${this.type}`
                return 'alert alert-'+this.type
            }
        }
       }
</script>
