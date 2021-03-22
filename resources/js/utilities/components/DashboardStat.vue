<template>
    <div class="m-2 md:min-w-1/6 flex-grow md:flex-grow-0">
        <div class="p-3 px-4 rounded shadow bg-white dark:bg-gray-600">
            <div class="flex flex-wrap items-center">
                <img v-if="element.icon" :src="'images/'+element.icon + '.png'" alt="icon by icons8">
                <div class="pl-1">
                    <h5 class="font-hairline">{{element.title}}</h5>

                    <h3 class="font-extrabold py-3" v-if="element.monetaryvalue">{{currency}} {{element.monetaryvalue}}</h3>
                    <h3 class="font-extrabold py-3" v-else>{{element.value}}</h3>
                    <span class="text-green-400" v-if="element.percentage && element.percentage > 0"><i class="fas fa-arrow-up"></i>{{element.percentage}} %</span>
                    <span class="text-orange-400" v-else-if="element.percentage"><i class="fas fa-arrow-down"></i>{{element.percentage}} %</span>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: {
            element: {
                type:Object,
                default:()=>{
                    return {}
                },
            },
            currency: {
                type:String,
                default:'Ksh',
            }
        },
    }
</script>
