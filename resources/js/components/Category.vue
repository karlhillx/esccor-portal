<template>

    <v-treeview
        :active.sync="active"
        :open.sync="open"
        :items="categoryList"
        item-key="id"
        :load-children="loadChildren"
        open-on-click
        return-object
        activatable
        transition
        dense
        @update:active="updateActive"
    >
        <template v-slot:prepend="{ item, open }">
            <v-icon v-if="!item.icon">{{ open ? 'mdi-folder-open' : 'mdi-folder' }}</v-icon>
            <v-icon v-else>{{ 'mdi-'+ item.icon }}</v-icon>
        </template>
    </v-treeview>

</template>
<script>
    // const pause = ms => new Promise(resolve => setTimeout(resolve, ms));

    export default {
        data() {
            return {
                item: [],
                open: [],
                active: [],
                updateActive: [],
                categoryList: [],
                selected: {
                    id: 0,
                    items: []
                }
            };
        },
        created() {
            this.getCategoryList(0);
        },
        computed: {},
        watch: {
            active: {
                deep: true,
                handler() {
                    this.selected.id = this.active[0].id;
                    const items = this.active[0]._name.split(",");
                    items.map(el => {
                        return {
                            text: el
                        };
                    });
                    this.selected.items = items;
                    console.log(this.selected);
                }
            }
        },
        methods: {
            getCategoryList(pid) {
                console.log(pid);
                axios.get("/category", {
                        params: {
                            pid: pid
                        }
                    })
                    .then(resp => {
                        if (resp.status !== 200) {
                            this.$message.error("获取分类列表失败");
                        }
                        resp.data.forEach(el => {
                            el._name = el.name;
                            if (el.isParent) {
                                el.children = [];
                            }
                        });
                        this.categoryList = resp.data;
                    });
            },
            loadChildren(item) {
                 //console.log(item.isParent);
                // await pause(500);
                return axios.get("/category", {
                        params: {
                            pid: item.id
                        }
                    })
                    .then(resp => {
                        if (resp.status !== 200) {
                            this.$message.error("获取分类列表失败");
                        }
                        resp.data.forEach(el => {
                            el._name = item._name + "," + el.name;
                            if (el.isParent) {
                                el.children = [];
                            }
                        });
                        item.children.push(...resp.data);
                    });
            }
        }
    }

</script>
