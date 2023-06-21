<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { defineProps, onMounted } from 'vue';

const props = defineProps({
    breaks: Object
})

const tableData = ref(props.breaks)
const perPage = ref(props.breaks.per_page)
let lastUrl = '';


const loadData = (url) => {
    if (url == null) {
        return;
    }
    lastUrl = url;
    axios.get(url, {
        params: { perPage: perPage.value }
    }).then((res) => {
        tableData.value = res.data
        console.log(res.data);
    }).catch(() => {

    })
}

const changePerPage = () => {
    loadData(lastUrl)
}

</script>

<template>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-8">
                <table class="table table-strip text-center">
                    <thead>
                        <th>Serial</th>
                        <th>Employee ID</th>
                    </thead>
                    <tbody>
                        <tr v-for="(table, index) in  tableData.data">
                            <td>{{ ++index }}</td>
                            <td>{{ table.emp_id }}</td>
                            <td>{{ table.break_in }}</td>

                        </tr>
                    </tbody>
                </table>

                <div>
                    <select v-model="perPage" @change="changePerPage">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="text-gray-500 text-sm">
                    Showing: {{ tableData.from }} To {{ tableData.to }} Of {{ tableData.total }}
                </div>
                <div class="flex gap-2 items-center">
                    <span v-for="url of tableData.links" v-html="url.label" @click="loadData(url.url)" :class="{
                        'text-red-500': (url.active == true)
                    }">

                    </span>
                </div>
            </div>
        </div>
    </div>
</template>