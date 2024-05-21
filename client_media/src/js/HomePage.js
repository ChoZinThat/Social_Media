import axios from "axios"
import { mapGetters } from "vuex"

export default {
    name : 'HomePage',
    data : () => ({
        message : 'This is testing message',
        postLists : {},
        categoryLists : {},
        searchKey : "",
        storageStatus : false,
    }),
    computed : {
        ...mapGetters(["storageToken","storageUserData"])
    },
    methods : {
        getPostData(){
            axios.get("http://localhost:8000/api/getPostData").then((response) => {
                this.postLists = response.data.post;

                for(let p=0; p<this.postLists.length; p++){
                    if(this.postLists[p].image != null){
                        this.postLists[p].image = "http://localhost:8000/postImage/"+ this.postLists[p].image;
                    }else{
                        this.postLists[p].image = "http://localhost:8000/postImage/empty_image.png";
                    }
                }                
            });
        },
        getCategoryList(){
            axios.get("http://localhost:8000/api/getCategoryData").then((response) => {
                this.categoryLists = response.data.category;                
            });
        },
        searchData(){
            let key = { key : this.searchKey};

            axios.post("http://localhost:8000/api/searchPost",key).then((response)=>{
                this.postLists = response.data.searchData;
                
                for(let p=0; p<this.postLists.length; p++){
                    if(this.postLists[p].image != null){
                        this.postLists[p].image = "http://localhost:8000/postImage/"+ this.postLists[p].image;
                    }else{
                        this.postLists[p].image = "http://localhost:8000/postImage/empty_image.png";
                    }
                }
            });
        },
        searchCategory(category_id){
            let key = { id : category_id };
            axios.post("http://localhost:8000/api/searchCategory",key).then((response) =>{
                this.postLists = response.data.posts;
                
                for(let p=0; p<this.postLists.length; p++){
                    if(this.postLists[p].image != null){
                        this.postLists[p].image = "http://localhost:8000/postImage/"+ this.postLists[p].image;
                    }else{
                        this.postLists[p].image = "http://localhost:8000/postImage/empty_image.png";
                    }
                }
            });
        },
        details(id){
            this.$router.push({
                name : "detailsPage",
                params: {
                    newsId: id,
                },
            });
            
        },
        goHome(){
            this.$router.push({
                name : 'homePage'
            })
        },
        goLogin(){
            this.$router.push({
                name : "loginPage"
            })
        },
        goLogout(){
            this.$store.dispatch("setToken", null);            
            this.goLogin();
        },
        loginUser(){
            if(this.storageToken != null && this.storageToken != undefined && this.storageToken != ""){
                this.storageStatus = true;
                
            }else{
                this.storageStatus = false;
            }
        }
    },
    mounted(){       
        this.loginUser();
        this.getPostData();
        this.getCategoryList();
    }
}