<template>
    <div class="row my-5">
        <div class="col-lg-12 col-md-12">
            <div class="card shadow w-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 heading">{{ Heading }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th v-for=" (TableHeader, key) in TableHeaders" :key="key">{{ TableHeader }}</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td v-for=" (TableHeader, key) in TableHeaders" :key="key">{{ TableHeader }}</td>
                                    <td>
                                        <button class="btn btn-danger mx-2" v-if="delete_data">
                                            <box-icon name='trash' :color="IconConfig.color"></box-icon>
                                        </button>
                                        <button class="btn btn-primary mx-2" v-if="edit_data">
                                            <box-icon name='edit' :color="IconConfig.color"></box-icon>
                                        </button>
                                        <button class="btn btn-success mx-2" v-if="update_data">
                                            <box-icon name='check' :color="IconConfig.color"></box-icon>
                                        </button>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        TableData: {
            type: Object,
            // required: true
        },
        TableHeaders: {
            type: Array,
            required: true
        },
        Heading: {
            type: String,
            required: true
        },
        delete_data: {
            type: Boolean,
            default: false,
        },
        edit_data: {
            type: Boolean,
            default: false
        },
        update_data: {
            type: Boolean,
            default: false
        },
    },
    data() {
        return {
            IconConfig: {
                color: '#ffff',
                size: "bx-sm"
            }
        }
    }

}
</script>

<style lang="scss" scoped>
.heading {
    font-weight: 800;
    color: var(--dashboard-color);
    text-transform: uppercase;
}

.row {
    overflow-x: hidden;
}
</style>