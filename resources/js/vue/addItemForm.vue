<template>
    <div class="form">
        <input class="form__control" type="text" v-model="item.name" />
        <font-awesome-icon
            icon="plus-square"
            @click="addItem()"
            :class="[item.name ? 'active' : 'inactive', 'form__control__btn']"
        />
    </div>
</template>
<script>
export default {
    data: function () {
        return {
            item: {
                name: "",
            },
        };
    },
    methods: {
        addItem() {
            if (this.item.name == "") {
                return;
            }

            axios
                .post("api/item/store", {
                    item: this.item,
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.item.name = "";
                        this.$emit("reloadList");
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style scoped>
.form {
    display: flex;
    justify-content: center;
    align-items: center;
}

.form__control {
    background: #f7f7f7;
    border: none;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}

.form__control__btn {
    font-size: 20px;
}

.active {
    color: #00ce25;
}

.inactive {
    color: #ccc;
}
</style>
