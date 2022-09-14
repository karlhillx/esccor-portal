<template>
    <v-app>
        <v-card>
            <v-sheet class="pa-4 primary">
                <v-text-field
                    clear-icon="far fa-times-circle"
                    clearable
                    dark
                    dense
                    flat
                    hide-details
                    label="Filter Subjects"
                    solo-inverted
                    v-model="search">
                </v-text-field>
            </v-sheet>

            <v-row>
                <v-col>
                    <v-card-text>
                        <v-treeview
                            v-model="tree"
                            :load-children="fetch"
                            :items="items"
                            item-key="name"
                            activatable
                            active-class="grey lighten-4 indigo--text"
                            dense
                            selected-color="indigo"
                            open-on-click
                            expand-icon="mdi-chevron-down">

                        <template v-slot:prepend="{ item, open }">
                                <v-icon v-if="item.children">
                                    {{ open ? 'mdi-folder-open' : 'mdi-folder' }}
                                </v-icon>
                                <v-icon color="blue" v-else>
                                    {{ 'far fa-file-alt' }}
                                </v-icon>
                                <template slot="label" slot-scope="{ item }">
                                    <a @click="getChildren({ item })">{{ item.name }}</a>
                                </template>
                            </template>
                        </v-treeview>
                    </v-card-text>
                </v-col>

                <v-divider vertical></v-divider>

                <v-col cols="12" md="6">
                    <v-card-text>
                        <div class="title font-weight-light grey--text pa-4 text-left">
                            Select a subject
                        </div>
                        <v-scroll-x-transition group hide-on-leave>
                        </v-scroll-x-transition>
                    </v-card-text>
                </v-col>
            </v-row>

            <v-divider></v-divider>

            <v-card-actions>
                <v-btn @click="tree = []" class="white--text mb-4 ml-4" color="orange darken-1">
                    Collapse Tree
                    <v-icon right>fas fa-undo-alt</v-icon>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-app>
</template>

<script>
    const pause = ms => new Promise(resolve => setTimeout(resolve, ms));
    export default {
        data: () => ({
            search: null,
            subjects: [],
            isLoading: false,
            tree: [],
            types: [],
            active: [],
            open: [],
            filter: [],
            name: [],
        }),
        computed: {
            items() {
                const children = this.types.map(type => ({
                    id: type,
                    name: this.getName(type),
                    children: this.getChildren(type),
                }));

                return [{
                    id: 1,
                    name: 'Subjects',
                    children,
                }]
            },
            selected() {
                if (!this.active.length) return undefined;
                const id = this.active[0];
                return this.subjects.find(subject => subject.id === id)
            },
        },
        watch: {
            subjects(val) {
                this.types = val.reduce((acc, cur) => {
                    const type = cur.subject_type;
                    if (!acc.includes(type)) acc.push(type);
                    return acc
                }, []).sort()
            },
        },
        methods: {
            async fetch(item) {
                await pause(1000); // For testing, can be removed.
                console.log('Loading!');
                return fetch('/getParents')
                    .then(res => res.json())
                    .then(json => (item.children.push(...json)))
                    .catch(err => console.warn(err))
            },
            getChildren(item) {
                let self = this;
                axios.get(`/getChildren/${item.id}`)
                    .then(response => {
                        item.children.push(...response.data);
                        self.open = item;

                    }).catch(error => {
                    //handle error
                });
            },
            /*getChildren(item) {
                const subjects = [];
                for (const subject of this.subjects) {
                    if (subject.subject_type !== type) continue;
                    subjects.push({
                        ...subject,
                        name: this.getName(subject.name),
                    })
                }
                return subjects.sort((a, b) => {
                    return a.name > b.name ? 1 : -1
                })
            },*/
            getName(name) {
                console.log('getName()):' + name);
                return `${name.charAt(0).toUpperCase()}${name.slice(1)}`
            },
            collapse() {
                console.log('Collapsed!');
            },
        },
    }
</script>
<style>
    #tree {
        font-family: Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: left;
        color: #2c3e50;
    }

    .v-icon.v-icon {
        font-size: 20px !important;
        letter-spacing: normal;
        line-height: 0 !important;
    }

    .v-treeview-node__label {
        font-size: 14px !important;
    }

</style>
