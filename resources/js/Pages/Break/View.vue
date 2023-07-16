<script setup>
import { Link, router } from '@inertiajs/vue3';
import { computed } from 'vue';
// import { Link, useRoute } from '@inertiajs/inertia-vue3';
import { defineProps } from 'vue';

// const route = useRoute();
// const empId = route.value.params.id;

const props = defineProps({
    employee: Object
});

const startedAt = (time) => {
    const [hours, minutes, seconds] = time.split(':').map(Number);
    const formattedTime = new Date();
    formattedTime.setHours(hours);
    formattedTime.setMinutes(minutes);
    formattedTime.setSeconds(seconds);
    return formattedTime.toLocaleTimeString([], { hour12: true });
}

const shortBreak = (startedAt) => {
    let [hours, minutes, seconds] = startedAt.split(':');

    let startedAtDate = new Date();
    startedAtDate.setHours(hours);
    startedAtDate.setMinutes(minutes);
    startedAtDate.setSeconds(seconds);

    let endedAtTimestamp = startedAtDate.getTime() + 15 * 60000;
    let endedAt = new Date(endedAtTimestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    return endedAt;
};


const longBreak = (startedAt) => {

    // this code for 24 hours
    // const [hours, minutes, seconds] = startedAt.split(':').map(Number);
    // let breakEnd = new Date();
    // breakEnd.setHours(hours);
    // breakEnd.setMinutes(minutes + 45);
    // breakEnd.setSeconds(seconds);
    // const formattedBreakEnd = breakEnd.toLocaleTimeString('en-US', { hour12: false });
    // return formattedBreakEnd;

    let [hours, minutes, seconds] = startedAt.split(':');

    let startedAtDate = new Date();
    startedAtDate.setHours(hours);
    startedAtDate.setMinutes(minutes);
    startedAtDate.setSeconds(seconds);

    let endedAtTimestamp = startedAtDate.getTime() + 15 * 60000;
    let endedAt = new Date(endedAtTimestamp).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', second: '2-digit' });
    return endedAt;
}

</script>

<template>
    <section>
        <div class="row">
            <div class="col-md-8">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">
                        <div class="mt-40 d-flex justify-content-center">
                            <h2 class="text-5xl">Break Started</h2>
                        </div>
                        <div class="mt-3">
                            <span class="text-2xl">Hello <strong class="fw-bolder">Sherwin ( Sanjith Chandra Sarkar
                                    )</strong></span><br>
                            <span v-if="props.employee.break_type == 1" class="text-2xl">You are in a <strong>Short Break</strong></span>
                            <span v-if="props.employee.break_type == 2" class="text-2xl">You are in a <strong>Long Break</strong></span>
                        </div>

                        <div class="mt-3">
                            <span class="text-2xl"><strong>Break Started At: {{ startedAt(props.employee.started_at) }}
                                </strong></span><br>
                            <span v-if="props.employee.break_type == 1" class="text-2xl"><strong>Break Ended At: {{
                                shortBreak(props.employee.started_at)
                            }}</strong></span>
                            <span v-if="props.employee.break_type == 2" class="text-2xl"><strong>Break Ended At: {{
                                longBreak(props.employee.started_at)
                            }}</strong></span>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <Button class="btn btn-success">
                                <Link :href="route('breaks.create')" class="text-white text-decoration-none">
                                Back to Break</Link>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>