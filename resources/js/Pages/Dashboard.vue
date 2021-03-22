<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12" v-if="!loading">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex flex-wrap md:flex-row sm:flex-col max-w-full mx-auto justify-center md:justify-between sm:px-6 md:px-0 md:mx-6">
                    <date-stat  />
                    <dashboard-stat v-bind:element="item" :key="index" v-for="(item, index) in elements" />
                </div>

                <data-display>
                    <chart-display :chartdata="chartData" v-if="chartData"/>
                </data-display>
            </div>
        </div>
        <div>
            <img src="/images/rhombus.gif"/>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Welcome from '@/Jetstream/Welcome'
    import DateStat from '../utilities/components/DateStat.vue'
    import DashboardStat from '../utilities/components/DashboardStat'
    import {apiGetService} from '../utilities/ApiService'
    import ChartDisplay from '../utilities/components/ChartDisplay.vue'
    import DataDisplay from '../utilities/components/DataDisplay.vue'

    export default {
        components: {
            AppLayout,
            Welcome,
            DateStat,
            DashboardStat,
            ChartDisplay,
            DataDisplay
        },
        mounted(){
            this.getElements();
        },
        data(){
            return {
                loading: true,
                elements: [],
                chartData: null,
            }
        },
        methods:{
            async getElements(){
                apiGetService('api/elements').then((result) => {
                    this.elements = result.data;
                    this.loading=false;
                }).catch((err) => {
                    
                });;
            },
            //Fetch graph report data
            async getChartData(){
                apiGetService('api/reports/product-sales').then((result) => {
                    this.chartData = result.data;
                    this.loading=false;
                }).catch((err) => {
                    
                });;
            },
        }
    }
</script>
