<template>
    <app-layout>
        

        <div class="py-4 px-12">
            <div class="grid grid-cols-4  gap-8 p-4  shadow-md bg-white rounded-md">

                <div class="border-r-2 border-red-800 items-center flex justify-center p-4">
                    <img :src="'/storage/' +post.image " class="h-44 w-44" alt="image_post">
                </div>

                <div class="col-span-3">
                    <div class="grid grid-rows-3 gap-4">
                        <div>
                            <p class="text-xl font-bold ">{{post.titre}} </p>
                            <p class="text-xs font-mono">
                                Posté par <span class="text-gray-800 font-bold">  {{post.user.name}} </span> le  <span class="text-gray-800 font-bold"> {{ moment(post.created_at).format("DD-MM-YYYY") }}</span> 
                            </p>
                        </div>
                        <div>
                            {{post.commentaire}}

                        </div>
                        <div class="flex flex-wrap justify-between pt-5">

                            <div>
                                <a class="px-3 py-2 text-base font-bold rounded-md bg-gray-500 text-white hover:bg-gray-700" :href="route('comment.post', post.id)"> Répondre </a>
                            </div>

                            <div v-if="post.can_modify">
                                <a class="px-3 py-2 text-right text-base font-bold rounded-md bg-yellow-500 text-white hover:bg-yellow-600" :href="route('index.edit', post.id)" > Editer </a>
                            </div>

                            <div v-if="post.can_modify">
                                <form @submit.prevent="Delete(post.id)">
                                    <input type="submit" class="px-3 py-2 text-right text-base font-bold rounded-md border-2 border-red-700 hover:bg-red-700 bg-white hover:text-white" value="supprimer">
                                </form>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            <!--AJout de commentaire   --> 
            <div class="py-6 px-12">

                <form @submit.prevent="Commenter()">
                      <label for="message" class="block mb-2 text-sm text-gray-600 dark:text-gray-400">Entrez votre Commentaire</label>

                    <textarea rows="2" name="message" v-model="FormComment.body" id="message" placeholder="Votre Commentaire" class="w-full px-3 py-2 placeholder-gray-300 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-100 focus:border-indigo-300 dark:bg-gray-700 dark:text-white dark:placeholder-gray-500 dark:border-gray-600 dark:focus:ring-gray-900 dark:focus:border-gray-500" required></textarea>   
                    <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.body">{{$page.props.errors.body}}</span>

                    <div class="text-right p-6">
                        <button type="submit" class="bg-red-700 font-bold text-md text-white px-3  py-2 rounded-md shadow-xl ">Envoyer </button>
                    </div> 
                </form>

            </div>

            <!-- liste de commentaires -->

            <div>
                <div class="p-4 font-bold text-xl">
                    Commentaires
                </div>
                <div v-for="comment in post.comments" :key="comment.id"  class="px-10">
                    <div class=" border p-3 border-gray-800 rounded-md shadow-md m-3" >
                        <div class="text-center">
                            {{comment.body}}
                        </div>
                        <div class="flex flex-wrap text-sm font-bold  py-2 justify-between px-10">
                            <div>{{ moment(comment.created_at).format("DD-MM-YYYY à H:m") }}</div>
                            <!--
                            <div>
                               <button type="submit" class="bg-red-700 font-bold text-md text-white px-3  py-2 rounded-md shadow-xl ">Envoyer </button>
                            </div>
                            
                            <div>
                               <button type="submit" class="bg-red-700 font-bold text-md text-white px-3  py-2 rounded-md shadow-xl ">Envoyer </button>
                            </div>
                            -->
                            
                            <!-- <div>{{ comment}} </div> -->
                        </div>
                    </div>
                </div>

               
            </div>

        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import moment from "moment";


    export default {
        components: {
            AppLayout,
        },
        props:['post'],
        data(){
          return {
                moment: moment,
                FormComment:{
                    body:null,
                    post_id:this.post.id
                }
            
          }
        },
        methods:{
            Delete(id){
                this.$inertia.delete('/post/delete/'+id)
            },
            reset()
            {
                this.FormComment.body= null
            },
            Commenter()
            {
                
                this.$inertia.post('/posts/send/comment', this.FormComment)
                .then((response) => {

                      this.reset();
                   
                     
                }).catch((err) => {
                    
                });
            }
        }
    }
</script>
