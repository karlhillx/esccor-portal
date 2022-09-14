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
                            :active.sync="active"
                            :items="items"
                            :load-children="fetch"
                            :open.sync="open"
                            :search="search"
                            activatable
                            color="primary"
                            dense
                            expand-icon="mdi-chevron-down"
                            hoverable
                            item-key="name"
                            off-icon="mdi-bookmark-outline"
                            on-icon="mdi-bookmark"
                            open-on-click
                            return-object
                            selected-color="indigo"
                            selection-type="independent"
                            transition>
                            <template v-slot:prepend="{ item, open }">
                                <v-icon v-if="item.children">
                                    {{ open ? 'mdi-folder-open' : 'mdi-folder' }}
                                </v-icon>
                                <v-icon color="blue" v-else>
                                    {{ 'far fa-file-alt' }}
                                </v-icon>
                                <template slot="label" slot-scope="{ item }">
                                    <a @click="getSelection()">{{ item.name }}</a>
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
            subjects: [],
            isLoading: false,
            tree: [],
            types: [],
        }),
        computed: {
            items () {
                const children = this.types.map(type => ({
                    id: type,
                    name: this.getName(type),
                    children: this.getChildren(type)
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
        methods: {
            fetch() {
                if (this.subjects.length) return;
                return fetch('/getParents')
                    .then(res => res.json())
                    .then(data => (this.subjects = data))
                    .catch(err => console.log(err))
            },
            getChildren(type) {
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
            },
            getName(name) {
                return `${name}`
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
