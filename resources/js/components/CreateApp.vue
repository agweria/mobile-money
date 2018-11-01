<template>
    <!-- Create Client Modal -->
    <div class="modal fade" id="modal-create-app" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Create App
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="alert alert-danger" v-if="createForm.errors.length > 0">
                        <p class="mb-0"><strong>Whoops!</strong> Something went wrong!</p>
                        <br>
                        <ul>
                            <li v-for="error in createForm.errors">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                    <form role="form">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">App Name</label>

                            <div class="col-md-9">
                                <input id="create-client-name" type="text" class="form-control"
                                       @keyup.enter="store" v-model="createForm.name">

                                <span class="form-text text-muted">
                                        The name of the app in <a href="https://developer.safaricom.co.ke/user/me/apps"
                                                                  target="_blank">Developer Portal</a>
                                    </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Short Code</label>

                            <div class="col-md-9">
                                <input id="create-client-name" type="text" class="form-control"
                                       @keyup.enter="store" v-model="createForm.name">

                                <span class="form-text text-muted">
                                        The name of the app in <a href="https://developer.safaricom.co.ke/user/me/apps"
                                                                  target="_blank">Developer Portal</a>
                                    </span>
                            </div>
                        </div>

                        <!-- Redirect URL -->
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Redirect URL</label>

                            <div class="col-md-9">
                                <input type="text" class="form-control" name="redirect"
                                       @keyup.enter="store" v-model="createForm.redirect">

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

                    <button type="button" class="btn btn-primary" @click="store">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "CreateApp",
        props:{
            createForm:Object
        }
    }
</script>

<style scoped>

</style>