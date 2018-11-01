<style scoped>
    .action-link {
        cursor: pointer;
    }
</style>

<template>
    <div>
        <div class="card card-default">
            <div class="card-header">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span>
                        MPESA Apps
                    </span>

                    <a class="action-link" tabindex="-1" @click="showCreateAppForm">
                        Add New App
                    </a>
                </div>
            </div>

            <div class="card-body">
                <!-- Current Clients -->
                <p class="mb-0" v-if="apps.length === 0">
                    You have not added any MPESA Apps.
                </p>

                <table class="table table-striped mb-0" v-if="apps.length > 0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Shortcode</th>
                        <th>Type</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr v-for="app in apps">
                        <!-- ID -->
                        <td style="vertical-align: middle;">
                            {{ app.id }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ app.name }}
                            <span class="badge badge-success" v-if="app.is_live">live</span>
                            <span class="badge badge-warning" v-else>sandbox</span>
                        </td>
                        <td style="vertical-align: middle;">
                            <code>{{ app.short_code }}</code>
                        </td>

                        <td style="vertical-align: middle;">
                            {{ app.type }}
                        </td>
                        <td style="vertical-align: middle;">
                            {{ app.company }}
                        </td>

                        <!-- Edit Button -->
                        <td style="vertical-align: middle;">
                            <a class="action-link" tabindex="-1" @click="edit(app)">
                                Edit
                            </a>

                            <a class="action-link text-danger" @click="destroy(app)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <edit-app :edit-form="editForm"/>
        <create-app :create-form="createForm"/>
    </div>
</template>

<script>
    import EditApp from './EditApp'
    import CreateApp from './CreateApp'
    import mpesa_app from '../stubs/mpesa_app'

    export default {
        components: {EditApp, CreateApp},
        /*
         * The component's data.
         */
        data() {
            return {
                apps: [],
                createForm: mpesa_app,
                editForm: mpesa_app
            };
        },
        /**
         * Prepare the component (Vue 1.x).
         */
        ready() {
            this.prepareComponent();
        },
        /**
         * Prepare the component (Vue 2.x).
         */
        mounted() {
            this.prepareComponent();
        },
        methods: {
            /**
             * Prepare the component.
             */
            prepareComponent() {
                this.getMpesaApps();
                $('#modal-create-app').on('shown.bs.modal', () => {
                    $('#create-app-name').focus();
                });
                $('#modal-edit-app').on('shown.bs.modal', () => {
                    $('#edit-app-name').focus();
                });
            },
            /**
             * Get all of the OAuth apps for the user.
             */
            getMpesaApps() {
                axios.get('payments/api/apps')
                    .then(response => {
                        this.apps = response.data;
                    });
            },
            /**
             * Show the form for creating new apps.
             */
            showCreateAppForm() {
                $('#modal-create-app').modal('show');
            },
            /**
             * Create a new OAuth app for the user.
             */
            store() {
                this.saveApp(
                    'post', '/oauth/apps',
                    this.createForm, '#modal-create-app'
                );
            },
            /**
             * Edit the given app.
             */
            edit(client) {
                this.editForm.id = client.id;
                this.editForm.name = client.name;
                this.editForm.redirect = client.redirect;
                $('#modal-edit-app').modal('show');
            },
            /**
             * Update the app being edited.
             */
            update() {
                this.saveApp(
                    'put', '/oauth/apps/' + this.editForm.id,
                    this.editForm, '#modal-edit-app'
                );
            },
            /**
             * Persist the app to storage using the given form.
             */
            saveApp(method, uri, form, modal) {
                form.errors = [];
                axios[method](uri, form)
                    .then(response => {
                        this.getMpesaApps();
                        form.name = '';
                        form.redirect = '';
                        form.errors = [];
                        $(modal).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },
            /**
             * Destroy the given app.
             */
            destroy(client) {
                axios.delete('/oauth/apps/' + client.id)
                    .then(response => {
                        this.getMpesaApps();
                    });
            }
        }
    }
</script>