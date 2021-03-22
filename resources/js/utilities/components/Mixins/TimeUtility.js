import moment from 'moment'

export default {
    methods:{       
        createDate(datestring){
            var d = new Date(datestring);

            var date = d.toDateString() +' '+('0' + d.getHours()).slice(-2)+':'+('0' + d.getMinutes()).slice(-2)+':'+('0' + d.getSeconds()).slice(-2);

            return date;
        },
        getHour(datestring){
            var d = new Date(datestring);

            return d.getHours();
        },
        timeLapsed(datestring){
            var d = new Date(datestring);
            var d1 = new Date();
            var diff = (d1.getTime() - d.getTime()) / 60000; //divide by milli seconds in a minute
            var mintdiff = Math.abs(Math.round(diff));
            if(mintdiff < 60){
                return mintdiff + ' min';
            }else if(mintdiff > 1440){
                var days = Math.floor(mintdiff / (60*24));
                var minLeft = mintdiff - (days * 24 * 60);
                let hours = 0;
                if(minLeft > 59){ //more than one hour
                    hours = Math.floor(minLeft / 60);
                }
                var min = minLeft - (hours * 60);

                return this.dayString(days) + this.hourString(hours) + min +' min';
            }else{
                var min = (mintdiff % 60);
                var hours = Math.floor(mintdiff / 60)
                return hours + ' hours ' + min +' min';
            }
        },
        dayString(days){
            if(days === 0){
                return '';
            }if(days > 1){
                return days + ' days ';
            }
            return days + ' day ';
        },
        hourString(hours){
            if(hours === 0){
                return '';
            }if(hours > 1){
                return hours + ' hours ';
            }
            return hours + ' hour ';
        },
        TwelveHourTimestamp(date){
            if(date){
                return moment(String(date)).format('MMMM Do YYYY, h:mm:ss a');
            };
            return null;
        },
        getDate(date){
            if(date){
                return moment(date).format('MMMM Do, YYYY');
            };
            return null;
        },
        getTime(date){
            if(date){
                return moment(date).format('h:mm:ss a');
            }
            return null;
        },
        timeNow(){
            return moment().format('h:mm:ss a');
        },
        getDayToday(){
            return moment().format('dddd');
        },
        formatMoney(amount)
        {
            return amount.toFixed(2);
        }
    }
}