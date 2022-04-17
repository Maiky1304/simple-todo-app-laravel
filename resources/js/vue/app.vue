<template>
    <div class="container">
        <header class="title">
            <h2 class="title__h2">Todo List</h2>
            <add-item-form v-on:reloadList="getList()" />
        </header>
        <list-view :items="items" v-on:reloadList="getList()" />
    </div>
</template>

<script>
import addItemForm from "./addItemForm.vue";
import listView from "./listView.vue";

export default {
    components: {
        addItemForm,
        listView,
    },
    data: function () {
        return {
            items: [],
        };
    },
    methods: {
        getList() {
            axios
                .get("api/items")
                .then((response) => {
                    this.items = response.data.map((item) => {
                        item.completed = item.completed === 1;
                        return item;
                    });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    created() {
        this.getList();
    },
};
</script>

<style scoped>
.container {
    width: 350px;
    margin: auto;
}

.title {
    background: #e6e6e6;
    padding: 10px;
}

.title__h2 {
    text-align: center;
}
</style>
