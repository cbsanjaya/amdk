<script type="text/ecmascript-6">
    import $ from 'jquery';
    import _ from 'lodash';
    import axios from 'axios';

    export default {
        props: [
            'resource', 'title'
        ],

        /**
         * The component's data.
         */
        data() {
            return {
                tag: '',
                page: '',
                entries: {
                    data: [],
                    current_page: null,
                    from: null,
                    last_page: null,
                    per_page: null,
                    to: null,
                    total: null,
                },
                ready: false,
            };
        },


        /**
         * Prepare the component.
         */
        mounted() {
            document.title = this.title + " - AMDK";

            this.page = this.$route.query.page || '';

            this.tag = this.$route.query.tag || '';

            this.loadEntries((entries) => {
                this.entries = entries;

                this.ready = true;
            });

            this.focusOnSearch();
        },


        /**
         * Clean after the component is destroyed.
         */
        destroyed() {
            document.onkeyup = null;
        },


        watch: {
            '$route.query': function () {
                if (!this.$route.query.tag) {
                    this.tag = '';
                }

                if (!this.$route.query.page) {
                    this.page = 1;
                } else {
                    this.page = this.$route.query.page
                }

                this.ready = false;

                this.loadEntries((entries) => {
                    this.entries = entries;

                    this.ready = true;
                });
            },
        },


        methods: {
            loadEntries(after){
                axios.get('/api/' + this.resource +
                        '?page=' + this.page +
                        '&tag=' + this.tag
                ).then(response => {
                    if (_.isFunction(after)) {
                        this.page = response.data.current_page;
                        after(
                                response.data
                        );
                    }
                })
            },

            /**
             * Search the entries of this type.
             */
            search(){
                this.debouncer(() => {
                    this.$router.push({query: _.assign({}, this.$route.query, {tag: this.tag, page: 1})});
                });
            },

            /**
             * Focus on the search input when "/" key is hit.
             */
            focusOnSearch(){
                document.onkeyup = event => {
                    if (event.which === 191 || event.keyCode === 191) {
                        let searchInput = document.getElementById("searchInput");

                        if (searchInput) {
                            searchInput.focus();
                        }
                    }
                };
            },

            /**
             * Load Page.
             */
            loadPage(page){
                this.$router.push({query: _.assign({}, this.$route.query, {page: page})});
            },
        }
    }
</script>

<template>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5>
                {{this.title}}
                <router-link :to="{name:'products-preview', params:{id: 'new'}}" class="control-action">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M13.388,9.624h-3.011v-3.01c0-0.208-0.168-0.377-0.376-0.377S9.624,6.405,9.624,6.613v3.01H6.613c-0.208,0-0.376,0.168-0.376,0.376s0.168,0.376,0.376,0.376h3.011v3.01c0,0.208,0.168,0.378,0.376,0.378s0.376-0.17,0.376-0.378v-3.01h3.011c0.207,0,0.377-0.168,0.377-0.376S13.595,9.624,13.388,9.624z M10,1.344c-4.781,0-8.656,3.875-8.656,8.656c0,4.781,3.875,8.656,8.656,8.656c4.781,0,8.656-3.875,8.656-8.656C18.656,5.219,14.781,1.344,10,1.344z M10,17.903c-4.365,0-7.904-3.538-7.904-7.903S5.635,2.096,10,2.096S17.903,5.635,17.903,10S14.365,17.903,10,17.903z"></path>
                    </svg>
                </router-link>
            </h5>

            <input type="text" class="form-control w-25"
                   v-if="tag || entries.data.length > 0"
                   id="searchInput"
                   :placeholder="'Search...'" v-model="tag" @input.stop="search">

        </div>

        <div v-if="!ready" class="d-flex align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="icon spin mr-2 fill-text-color">
                <path d="M12 10a2 2 0 0 1-3.41 1.41A2 2 0 0 1 10 8V0a9.97 9.97 0 0 1 10 10h-8zm7.9 1.41A10 10 0 1 1 8.59.1v2.03a8 8 0 1 0 9.29 9.29h2.02zm-4.07 0a6 6 0 1 1-7.25-7.25v2.1a3.99 3.99 0 0 0-1.4 6.57 4 4 0 0 0 6.56-1.42h2.1z"></path>
            </svg>

            <span>Loading...</span>
        </div>


        <div v-if="ready && entries.data.length == 0" class="d-flex flex-column align-items-center justify-content-center card-bg-secondary p-5 bottom-radius">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="fill-text-color" style="width: 200px;">
                <path fill-rule="evenodd" d="M7 10h41a11 11 0 0 1 0 22h-8a3 3 0 0 0 0 6h6a6 6 0 1 1 0 12H10a4 4 0 1 1 0-8h2a2 2 0 1 0 0-4H7a5 5 0 0 1 0-10h3a3 3 0 0 0 0-6H7a6 6 0 1 1 0-12zm14 19a1 1 0 0 1-1-1 1 1 0 0 0-2 0 1 1 0 0 1-1 1 1 1 0 0 0 0 2 1 1 0 0 1 1 1 1 1 0 0 0 2 0 1 1 0 0 1 1-1 1 1 0 0 0 0-2zm-5.5-11a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm24 10a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm1 18a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm-14-3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zm22-23a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3zM33 18a1 1 0 0 1-1-1v-1a1 1 0 0 0-2 0v1a1 1 0 0 1-1 1h-1a1 1 0 0 0 0 2h1a1 1 0 0 1 1 1v1a1 1 0 0 0 2 0v-1a1 1 0 0 1 1-1h1a1 1 0 0 0 0-2h-1z"></path>
            </svg>

            <span>We didn't find anything - just empty space.</span>
        </div>


        <table id="indexScreen" class="table table-hover table-sm mb-0 penultimate-column-right" v-if="ready && entries.data.length > 0">
            <thead>
            <slot name="table-header"></slot>
            </thead>

            <transition-group tag="tbody" name="list">
                <tr v-for="entry in entries.data" :key="entry.id">
                    <slot name="row" :entry="entry"></slot>
                </tr>
            </transition-group>

            <tfoot>
                <td colspan="100"> 
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item" :class="{'disabled': entries.current_page == 1}">
                                <a class="page-link" @click.prevent="loadPage(1)">First</a>
                            </li>
                            <li class="page-item" :class="{'disabled': entries.current_page == 1}">
                                <a class="page-link" @click.prevent="loadPage(entries.current_page - 1)">Prev</a>
                            </li>
                            <li class="page-item active"><span class="page-link">{{ entries.current_page }}</span></li>
                            <li class="page-item" :class="{'disabled': entries.current_page == entries.last_page}">
                                <a class="page-link" @click.prevent="loadPage(entries.current_page + 1)">Next</a>
                            </li>
                            <li class="page-item" :class="{'disabled': entries.current_page == entries.last_page}">
                                <a class="page-link" @click.prevent="loadPage(entries.last_page)">Last</a>
                            </li>
                        </ul>
                    </nav>
                </td>
            </tfoot>
        </table>

    </div>
</template>
