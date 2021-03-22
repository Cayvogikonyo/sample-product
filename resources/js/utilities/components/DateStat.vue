<template>
    <div class="p-3 rounded shadow bg-gray-100 dark:bg-gray-600 m-2 mx-2 flex flex-wrap flex-grow md:flex-grow-0 items-center">
        <img v-if="getHour(date)>6 && getHour(date)<18" src="images/sun.png" />
        <img v-else src="images/moon.png" />
        <div class="pl-1">
            <h5 class="font-hairline">{{getDayToday()}}</h5>
            
            <h3 class="font-extrabold py-3" >{{getDate(date)}}</h3>
            <h3 class="font-extrabold py-3" ref="time" >{{timeNow()}}</h3>
            
        </div>
    </div>
</template>

<script>
    import TimeUtility from './Mixins/TimeUtility'

    export default {
        data(){
            return {
                date: new Date(),
            }
        
        },
        mounted(){
            this.startTimer();
        },
        mixins:[TimeUtility],
        methods:{
            startTimer(){
                var _this = this;
                var timerInterval = setInterval(function(){ 
                    var d = _this.timeNow();
                    if(_this.$refs.time){
                        _this.$refs.time.innerHTML = d; 
                    }else{
                        clearInterval(timerInterval);
                    }
                }, 1000);
            }
        }
    }
</script>
