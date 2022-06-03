<template>

    <div class="card shadow-lg p-3 mb-5 bg-body rounded">
        <div class="card-header ">{{ title }}</div>

        <div class="card-body">

            <slot name="contentCard"></slot>

            <div>
                <slot name="footerCard"></slot>
            </div>

        </div>

    </div>

</template>

<script>
    export default {
        props: ['title']
    }
</script>
