<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { reactive, ref } from "vue";

const form = reactive({
    emp_id: null,
    break_in: null,
})

const props = defineProps({
    breakTime: Object,
})

const editForm = useForm({
    emp_id: '',
    break_type: '',
})

// ----------- Insert Break -----------------

const insertBreak = () => {
    router.post('/breaks', form)
}


// ------------ End Break ---------------------

const endBreak = () => {
    router.post('/break/update', editForm)
}

// ----------------- Modal --------------

const isModalVisible = ref(false);

const showModal = () => {
    isModalVisible.value = true;

}

const hideModal = () => {
    isModalVisible.value = false;
}

</script>
<template>
    <section>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h2>Take Break</h2>
                        <button class="btn btn-danger ml-6" @click.prevent="showModal()">Break End</button>
                    </div>
                    <div class="card-body">
                        <form class="d-flex justify-content-center" @submit.prevent="insertBreak">
                            <div>
                                <div class="form-group">
                                    <label for="Employee ID">Employee ID:</label>
                                    <input type="number" class="form-input ml-2" v-model="form.emp_id"
                                        placeholder="Enter Employee ID">
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" id="short_break" name="break_type"
                                        v-model="form.break_type" value="1">
                                    <label class="form-check-label" for="short_break">Short Break</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="long_break" name="break_type"
                                        v-model="form.break_type" value="2">
                                    <label class="form-check-label" for="long_break">Long Break</label>
                                </div>



                                <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                    {{ form.progress.percentage }}%
                                </progress>

                                <div class="text-center">
                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div v-if="isModalVisible" class="modal">
                        <div class="modal-content">

                            <div class="row d-flex justify-content-center">
                                <div class="col-md-10">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-center">
                                            <h2>End Break</h2>
                                        </div>
                                        <div class="card-body">
                                            <form class="d-flex justify-content-center" @submit.prevent="endBreak">
                                                <div>
                                                    <div class="form-group">
                                                        <label for="Employee ID">Employee ID:</label>
                                                        <input type="number" class="form-input ml-2" v-model="editForm.emp_id"
                                                            placeholder="Enter Employee ID">
                                                    </div>

                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="radio" id="short_break"
                                                            name="break_type" v-model="editForm.break_type" value="1">
                                                        <label class="form-check-label" for="short_break">Short
                                                            Break</label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" id="long_break"
                                                            name="break_type" v-model="editForm.break_type" value="2">
                                                        <label class="form-check-label" for="long_break">Long Break</label>
                                                    </div>

                                                    <div class="text-center">
                                                        <button class="btn btn-primary" type="submit">Submit</button>
                                                    </div>

                                                    <div class="d-flex justify-content-center mt-4">
                                                        <button @click="hideModal">Close
                                                            Modal</button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<style>
.modal {
    position: fixed;
    top: 15%;
    left: 20%;
    width: 50%;
    height: 50%;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 4px;
    width: 100%;
    height: 100%;
}
</style>