<template>
    <div class="container">
        
        <div class="container">
        
            <label class="form-label mt-4">Link</label>
            <textarea type="text" v-model="link" class="form-control mt-2" id="inputValue"></textarea>
            <div class="text-success" id="messageId">
                
            </div>
            <button type="submit" class="btn btn-primary mt-4" @click.prevent="sendLink()">submit</button>
            
        </div>

    </div>
</template>

<script>
    // import router from "../router";
    export default {
        name:'AppComponent',
        components:{
        },
        data(){
          return {
              link:null
          }
        },
        methods:{
            sendLink(){
                let link = this.link;
                var message = document.getElementById('messageId');
        
                var arr = link.split('\n');
                var set = new Set(arr);
                arr = Array.from(set);
        
                message.innerHTML = "";
                if(arr.length > 0){
                    for(var i = 0; i < arr.length; i++){
                        axios.post('/sendLink', {link:arr[i]})
                        .then(res => {
                            res = res.data;
                            message.innerHTML += '<p>'+res.link+' => '+res.message+'</p>';
                        });
                    }
                    
                }
                
            }
        }
    }
</script>
