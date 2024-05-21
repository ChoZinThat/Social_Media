import axios from "axios";
import { mapGetters } from "vuex";
export default {
    name : "DetailsPage",
    data : () => ({
        postId : "",
        postLists : {},
        view_count : 0
    }),
    computed: {
        ...mapGetters(["storageToken","storageUserData"])
    },
    methods : {
        getPost(id){
            let key = { post_id : id };

            axios.post("http://localhost:8000/api/postDetails",key).then((response) =>{
                this.postLists = response.data.result;               
                
                    if(this.postLists.image != null){
                        this.postLists.image = "http://localhost:8000/postImage/"+ this.postLists.image;
                    }else{
                        this.postLists.image = "http://localhost:8000/postImage/empty_image.png";
                    }    
                         
                 });               
        },
        goHome(){
            this.$router.push({
                name : 'homePage'
         })
        },       
        backPage(){
            this.$router.push({
                name : 'homePage'
         })
        },
        countView(){
            let createData = {
                "post_id" : this.postId,
                "user_id" : this.storageUserData.id
            };

            axios.post("http://localhost:8000/api/create/view_count",createData).then((response) => {
                this.view_count = response.data.result.length;
            });
        }
    },
    mounted (){       
        this.postId = this.$route.params.newsId;        
        this.getPost(this.postId);
        this.countView();
    }
}