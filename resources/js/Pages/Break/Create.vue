<script setup>
import { router, useForm } from '@inertiajs/vue3'
import { reactive, ref, defineProps } from "vue";

const form = reactive({
    emp_id: '',
    break_in: '',
})

const props = defineProps({
    breakTime: Object,
    errors: Object,
})

const editForm = useForm({
    emp_id: '',
    break_type: '',
})

// ----------- Insert Break -----------------

const insertBreak = () => {
    router.post('/breaks', form), {
        onSuccess: () => {
            setTimeout(() => {
                $page.props.flash.message = '';
            }, 300);
        },
    }
}



// ------------ End Break ---------------------

const endBreak = () => {
    router.post('/break/update', editForm, {
        onSuccess: () => {
            hideModal();
        },
    })
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
            <div class="col-md-5">
                <div class="card mt-20">
                    <div class="card-header d-flex justify-content-center">
                        <h2>Take Break</h2>
                        <button class="btn btn-danger ml-6" @click.prevent="showModal()">Break End</button>
                    </div>

                    <!--------------------- Display Flash Message -------------------->

                    <div v-if="$page.props.flash.message" class="text-danger d-flex justify-content-center">
                        {{ $page.props.flash.message }}
                    </div>

                    <div class="card-body">
                        <form class="d-flex justify-content-center" @submit.prevent="insertBreak">
                            <div>
                                <div class="form-group">
                                    <label for="Employee ID">Employee ID:</label>
                                    <input type="number" class="form-input ml-2" v-model="form.emp_id"
                                        placeholder="Enter Employee ID">
                                    <div v-if="errors.emp_id" class="text-danger">{{ errors.emp_id }}</div>

                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="radio" id="short_break" name="break_type"
                                        v-model="form.break_type" value="1">
                                    <label class="form-check-label" for="short_break">Short Break</label>

                                    <div v-if="errors.break_type" class="text-danger">{{ errors.break_type }}</div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="long_break" name="break_type"
                                        v-model="form.break_type" value="2">
                                    <label class="form-check-label" for="long_break">Long Break</label>
                                    <div v-if="errors.break_type" class="text-danger">{{ errors.break_type }}</div>
                                </div>

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

                                        <!--------------------- Display Flash Message -------------------->

                                        <div v-if="$page.props.flash.message"
                                            class="text-danger d-flex justify-content-center">
                                            {{ $page.props.flash.message }}
                                        </div>

                                        <div class="card-body">
                                            <form class="d-flex justify-content-center" @submit.prevent="endBreak">
                                                <div>
                                                    <div class="form-group">
                                                        <label for="Employee ID">Employee ID:</label>
                                                        <input type="number" class="form-input"
                                                            v-model="editForm.emp_id" placeholder="Enter Employee ID">
                                                        <div v-if="errors.emp_id" class="text-danger">{{ errors.emp_id }}
                                                        </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button class="btn btn-primary mt-3" type="submit">Submit</button>
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
    top: 12%;
    left: 35%;
    width: 30%;
    height: 42%;
    background-color: rgba(0, 0, 0, .5);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background-color: transparent;
    padding: 20px;
    border-radius: 4px;
    width: 100%;
    height: 100%;
}
</style>