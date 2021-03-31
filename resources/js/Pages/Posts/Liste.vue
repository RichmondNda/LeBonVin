<template>
  <div class="bg-gray-300">
      <!--NavBar-->
        
        <div class="">
            <div class="bg-white ">
                <div class="max-w-7xl mx-auto px-4 sm:px-6">
                    <div class="flex justify-between items-center border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
                    <div class="flex justify-start lg:w-0 lg:flex-1">
                        <a href="#">
                        <span class="sr-only">Le Bon Vin</span>
                        <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="">
                        </a>
                    </div>
                    
                    <nav class="hidden md:flex space-x-10">
                    
                        <a :href="route('list.post')" class="text-xl font-medium  text-gray-500 hover:text-gray-900">
                            Forum
                        </a>
                        <a :href="route('list.post')" class="text-xl font-medium  text-gray-500 hover:text-gray-900">
                            Galerie
                        </a>

                    </nav>
                    <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0">
                        

                        <div v-if="canLogin" class="hidden  top-0 right-0 px-6 py-4 sm:block">
                            <inertia-link v-if="$page.props.user" href="/dashboard" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border-2  rounded-md shadow-sm text-sm font-bold text-black border-red-800 hover:text-white  hover:bg-red-800">
                                Mon Profile 
                            </inertia-link>

                            <template v-else>
                                <inertia-link :href="route('login')" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border-2  rounded-md shadow-sm text-sm font-bold text-black border-red-700 hover:bg-red-800 hover:text-white ">
                                    Se connecter 
                                </inertia-link>

                                <inertia-link v-if="canRegister" :href="route('register')" class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-red-700 hover:bg-red-800">
                                    S'inscrire
                                </inertia-link>
                            </template>
                        </div>

                    </div>
                    </div>
                </div>
            </div>
        </div>

      <!--Fin de la NavBar -->

      <div class="">


            <div class="p-8" >

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

            </div>
            
            
        </div>
  </div>
</template>

<script>
    
    import moment from "moment";

    export default {
        props:['posts', 'canLogin', 'canRegister'],
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

<style>

</style>