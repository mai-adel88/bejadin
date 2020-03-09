<template>
    <Carousel dir="ltr" :autoplay="true" :perPage="6" :autoplayHoverPause="true" :loop="true" :scrollPerPage="false" :paginationEnabled="false">
        <template v-for="company in companies">
            <Slide>
                <div>
                    <img v-if="company.logo == null" src="/images/company.png">
                    <img class="img-fluid" v-else :src="'storage/' + company.logo" alt="company.name" title="company.name">
                    <h6 class="text-center mt-3">{{company.name}}</h6>
                </div>
            </Slide>
        </template>
    </Carousel>
</template>

<script>
    import { Carousel, Slide } from 'vue-carousel';
    export default {
        data() {
            return {
                companies: [],
            }
        },
        components: {
            Carousel,
            Slide
        },
        created() {
            this.getCompanies();
        },
        methods: {
            getCompanies: function() {
                axios.get('/chosen/companies').then(response => {
                    return this.companies = response.data;
                }).catch(errors =>{
                    console.log(errors);
                });
            },
        },
    }
</script>

<style>
    .VueCarousel-slide{
        display:flex;
        justify-content: center;
    }
</style>
