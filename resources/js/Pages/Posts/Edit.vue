<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Creation de post
            </h2>
        </template>

        <div class="py-4">

            <div class="text-center font-bold text-2xl">
              Edition de post
            </div>
            <div class="grid grid-cols-5 p-8">
              <div> </div>

              <div class="col-span-3">

                <form @submit.prevent="submit()" ref="myForm" enctype="multipart/form-data" >

                    <!-- Pour l'enregistrement de photo -->
                    <div>
                      <label class="block text-xl font-bold text-gray-700">
                        Image
                      </label>
                      <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                          <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                          <div class="flex text-xl text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-red-700 hover:text-red-800 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-700">
                              <span> Charger le fichier </span>
                              <input id="file-upload" v-on:change="ImageChange" name="file-upload" type="file" class="sr-only">
                            </label>
                            <p class="pl-1">ou un glisser déposer </p>
                          </div>
                          <p class="text-xs text-gray-500">
                            PNG, JPG, GIF moins de 10MB
                          </p>
                        </div>
                      </div>
                      <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.image">{{$page.props.errors.image}}</span>

                    </div>

                    <!-- Pour le titre du post  -->

                    <div class="col-span-6 sm:col-span-3">
                      <label for="titre_post" class="block text-xl font-bold text-gray-700">Titre du post </label>
                      <input type="text" name="titre_post"  v-model="form.titre"  id="titre_post" autocomplete="family-name" class="mt-1 focus:ring-red-700 focus:border-red-700 block w-full shadow-sm sm:text-xl border-gray-300 rounded-md">
                      <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.titre">{{$page.props.errors.titre}}</span>
                    </div>

                    <!-- Pour le commentaire  -->

                    <div>
                      <label for="about" class="block text-xl font-bold text-gray-700">
                        Commentaire
                      </label>
                      <div class="mt-1">
                        <textarea id="about" name="about" rows="5"  v-model="form.commentaire"  class="shadow-sm focus:ring-red-700 focus:border-red-700 mt-1 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Commentaire ..."></textarea>
                      </div>
                      <span class="text-red-800 font-bold text-sm  p-4" v-if="$page.props.errors.commentaire">{{$page.props.errors.commentaire}}</span>

                    </div>


                    <div class="px-4 py-3  text-right sm:px-6">
                      <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Modifier le post 
                      </button>
                    </div>

                </form>
                

              </div>

              
              
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'

    export default {
        components: {
            AppLayout,
        },
        props:['post'],
        data(){
          return {

            file:null,
            form: {
              image: null,
              titre: this.post.titre,
              commentaire:this.post.commentaire
            },
            errors:{}
          }
        },
        methods:{
          reset(){

             this.form.titre = null,
             this.form.commentaire = null
            
          },
          ImageChange(e)
          {
            this.file = e.target.files[0];
          },
          submit(){



            const config = {
                  headers: {
                      'content-type': 'multipart/form-data'
                  }
              }

            let data = new FormData();

            data.append('image', this.file)
            data.append('titre', this.form.titre)
            data.append('commentaire', this.form.commentaire)


            console.log(this.form);


            this.$inertia.post('/post/update/'+ this.post.id , data, config)
                .then((response) => {
                     this.reset();
                }).catch((err) => {
                    
                });
          }
        }
    }
</script>
