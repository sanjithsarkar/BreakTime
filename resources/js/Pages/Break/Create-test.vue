<script setup>


// ================== Input value next Input ==================

const handleKeyup = (index) => {
    if (index < 8) {
        const nextIndex = index + 1;
        const nextInput = document.getElementById(`input${nextIndex}`);

        if (nextInput) {
            nextInput.focus();
        }
    }
};


const { inertia } = usePage();

const handleInput = (index) => {
    const input = document.getElementById(`input${index}`);
    const value = input.value;

    // Send the value to the server using Inertia.js
    inertia.post('/store-input-data', {
        index,
        value,
    });
};


</script>
<template>
    <div class="flex">
        <input v-for="index in 8" :key="index" type="text" class="form-control" :maxlength="1"
            :name="`form.employee_id[${index}]`" :id="`input${index}`" :data-index="index" placeholder="0" required
            @input="handleInput(index)" @keyup="handleKeyup(index)" />
    </div>
</template>