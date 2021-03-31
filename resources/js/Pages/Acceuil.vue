<template>
  <div>
      <!--NavBar-->
        
        <div class=" bg-white ">
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

      <!--Fin de la NavBar -->

      <!-- Debut Header !-->
        <div class="grid grid-cols-2">
            <div class="">
            <img src="img/le_vin.svg" alt="">
            </div>
            <div class="flex justify-center items-center">
                <p class="text-4xl font-bold text-center">
                    Le <span class="text-6xl text-red-700">  vin  </span> 
                    <br> qui rejouit le coeur de l'homme 
                </p>
            </div>
        </div>
      <!-- Fin Header !-->

      <!-- Intitulé du blog -->

     <div class="mt-20 p-12  text-xl">
        <div class="grid grid-cols-3 gap-8">
            
            <div class="col-span-2 border-r-2 border-red-800">
                <p>
                    <span class="text-7xl font-bold text-red-800">V</span> ous êtes amatteur de vin voici un endroit ou vous pourrez decouvrir 
                    les meilleurs vin du mon et meme echanger avec d'autres amatteur de vin comme vous.
                </p>
                <p class="mt-4">
                    Le <span class="font-bold">Bon vin</span>  est un espace dédier aux amatteur de vin aux personne qui désire 
                    decouvrir de nouveaux vin , a celle qui desire faire connaitre leurs créations
                    a d'autres personnes et aussi a tous ceux qui cherchent des conseil en matiere de vin.
                </p>
            </div>

            <div>
                <div>
                    <img src="img/fun_vin.svg" alt="Le bon vin">
                </div>
            </div>

        </div>
     </div> 

     <!-- Fin Intitulé du blog -->


     <!-- Galerie de vin -->

     <div class="p-12   ">

         <div class=" text-center font-bold text-5xl ">
             Galerie de Vin 
         </div>

         <div class="pt-8 grid grid-cols-3 gap-8">
             <div>
                 <img src="img/galerie_2.jpg" alt="">
             </div>

            <div class="col-span-2 grid grid-cols-2 gap-4   ">
                <div>
                    <img src="img/galerie_1.png" alt="">
                </div>

                <div>
                    <img src="img/galerie_3.jpg" alt="">
                </div>
                
                <div>
                    <img src="img/galerie_4.jpg" alt="">
                </div>

                <div>
                    <img src="img/galerie_5.jpg" alt="">
                </div>
            </div>

             
         </div>

     </div>
     <!-- Fin de la galerie -->

    <!-- Footer -->
     <div>

         <div class="bg-red-700 p-12 text-sm text-gray-300">
             <div class="grid grid-cols-3">
                 <div>
                     
                 </div>
                 <div class="text-center">
                     <span class="text-white font-bold text-3xl">Le Bon vin</span>
                     <p class="mt-4">
                         le Bon vin est un blog pour partager
                         vos differentes expérinces en matier de vin .
                     </p>
                     <p class="font-semibold mt-4">
                         Copyright © N'DA REGIS RICHMOND 
                     </p>
                 </div>
             </div>
         </div>

     </div>

    <!-- Fin Footer -->
    
  </div>
</template>

<script>
export default {
    props :['canLogin', 'canRegister']
}
</script>

<style>

</style>