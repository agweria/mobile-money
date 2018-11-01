<template>
    <!-- Edit Client Modal -->
    <div class="modal fade" id="modal-edit-app" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Edit Client
                    </h4>

                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- Form Errors -->
                    <div class="alert alert-danger" v-if="editForm.errors.length > 0">
                        <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in editForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>

                    <!-- Edit Client Form -->
                    <form role="form">
                        <!-- Name -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name</label>

                            <div class="col-md-9">
                                <input id="edit-client-name" type="text" class="form-control"
                                       @keyup.enter="update" v-model="editForm.name">

                                <span class="form-text text-muted">
                                        Something your users will recognize and trust.
                                    </span>
                            </div>
                        </div>

                        <!-- Redirect URL -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Redirect URL</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="redirect"
                                       @keyup.enter="update" v-model="editForm.redirect">

                                <span class="form-text text-muted">
                                        Your application's authorization callback URL.
                                    </span>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" @click="update">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "EditApp",
        props: {
            editForm: Object
        }
    }
</script>

<style scoped>

</style>