<template>
    <div class="container">
        <p v-for="category in categories">
            {{ category.name }}
        </p>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                categories: {}

            }
        },
        mounted() {
            axios.get('/api/categories')
                .then(response => {
                    this.categories = response.data.data;
        });

        }
    }
</script>
