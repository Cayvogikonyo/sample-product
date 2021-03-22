<template>
    <div class="bg-gray-100 dark:bg-gray-600 dark:text-gray-200 shadow px-2 rounded">
        <div>
            <h3 class="text-gray-500 font-bold py-3 capitalize text-center sm:text-left">Week Revenue</h3>
            <button v-if="chart === 'line'" @click="chart = 'bar'"><i class="fa fa-chart-bar rounded-full p-2"><span class="font-light text-sm p-2">bar</span></i></button>  
            <button v-else @click="chart = 'line'"><i class="fa fa-chart-line rounded-full p-2"><span class="font-light text-sm p-2">line</span></i></button>
        </div>
        <div class="shadow-sm mx-2">
            <line-graph v-if="chart === 'line'" :chart-data="chartdata" :options="options" :styles="chartStyles"></line-graph>
            <bar-chart v-else-if="chart === 'bar'" :chart-data="chartdata" :options="options" :styles="chartStyles"></bar-chart>
        </div>
    </div>
</template>

<script>
import BarChart from './BarGraph'

import LineGraph from './LineGraph.vue'

export default {
    components: {
        BarChart,
        LineGraph
    },
    props:{
        chartdata:{
            type: Object,
            default: () => {
                return {}
            }
        }
    },
    data(){
        return {
            chart: 'line',
            options: {
                responsive: true,
                maintainAspectRatio: false
            },
        }
    }
}
</script>

<style>

</style>