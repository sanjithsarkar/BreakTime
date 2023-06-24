<script setup>

const props = defineProps({

})
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
                            <span class="text-2xl">You are in a <strong>Short Break</strong></span>
                        </div>

                        <div class="mt-3">
                            <span class="text-2xl"><strong>Break Started At:</strong></span><br>
                            <span class="text-2xl"><strong>Break Ended At: </strong></span>
                        </div>

                        <div class="d-flex justify-content-center mt-3">
                            <Button class="btn btn-info text-white text-3xl">Back to Break Page</Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>