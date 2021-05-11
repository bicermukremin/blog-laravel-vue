
export default {
    data() {
        return {
           
        };
    },
    beforeCreate() {
        if (this.$route.name=='admin' || this.$route.name=='login' || this.$route.name=='register') {
            this.$cookies.remove("theme");
            this.$cookies.set("theme", "admin");
           
        } else {
           this.$cookies.remove("theme");
           this.$cookies.set("theme","frontend");
        }
    }
}
   
            
    
         
