<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Mes posts
            </h2>
        </template>

        <div>


            <div class="p-8">

                <div v-for="post in posts" :key="post.id" class="grid grid-cols-4 m-8  gap-8 p-8  shadow-md bg-white rounded-md">

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

                                <div>
                                    <a class="px-3 py-2 text-right text-base font-bold rounded-md bg-yellow-500 text-white hover:bg-yellow-600" :href="route('index.edit', post.id)" > Editer </a>
                                </div>

                                <div>
                                    <form @submit.prevent="Delete(post.id)">
                                       <input type="submit" class="px-3 py-2 text-right text-base font-bold rounded-md border-2 border-red-700 hover:bg-red-700 bg-white hover:text-white" value="supprimer">
                                    </form>
                                </div>

                            </div>
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
        props:['posts'],
        data(){
          return {
                moment: moment            
          }
        },
        methods:{
            Delete(id){
                this.$inertia.delete('/post/delete/'+id)
            }
        }
    }
</script>
