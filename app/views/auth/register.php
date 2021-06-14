<div id="modal" class="flex modal-container justify-center hidden items-center">
        <div class="modals bg-white sm:rounded-xl px-3 py-4 ">
            <div class="flex justify-between">
                <span class="w-24"> <a href=""  id="prev" class="hover-white rounded-circle px-3 py-2"><i class="fa fa-arrow-left primaire" aria-hidden="true"></i></a></span>
                <span class="w-24"><i class="fa fa-twitter ml-3 logo-modal " aria-hidden="true"></i></span>
                <span class="w-24 "><a href="" id="next" class="rounded-full px-4 font-bold py-2 bg-primaire  disabled hover-bg-primaire text-white">Suivant</a></span>
            </div>
            <div class="">
               
                <form action="/register" method="POST" class="py-8" >
                        <div id="part-1" class="  sm:px-12">
                            <p class="font-bold text-xl mb-7">Créer votre compte</p>

                            <div class="field">
                                <div class="border rounded border-gray-300 py-3 px-2 mt-5">
                                    <input type="text" name="fullname" placeholder="Nom et prenoms" id="fullname" class="w-full outline-none  "> 
                                </div>
                                <p class="text-sm hidden text-red-600 ">Username must have alpha numeric caracter and must be greater than 3 and least than 25 .</p>

                            </div>

                            <div class="field">
                                <div class="border rounded border-gray-300 py-3 px-2 mt-5">
                                    <input type="text" name="email" placeholder="email" id="email"  class="w-full outline-none  "> 
                                </div>
                                <p class="text-sm hidden text-red-600 ">Email Invalide </p>

                            </div>
                            <div class="field">
                                <div class="border rounded border-gray-300 py-3 px-2 mt-5">
                                    <input type="text" name="username" placeholder="username" id="username"  class="w-full outline-none  "> 
                                </div>
                                <p class="text-sm hidden text-red-600 ">Username must have alpha numeric caracter and must be greater than 3 and least than 15  .</p>
                            </div>
                            

                            <p class="font-bold mt-12 ">Date de naissance</p>
                            <p class="text-gray-600">Cette information ne sera pas affichée publiquement. Confirmez votre âge, même si ce compte est pour une entreprise, un animal de compagnie ou autre chose.</p>
                            <div class="w-full flex mt-5">
                                <div class="w-1/2  px-3 rounded py-3 border">
                                    <select name="month" id="month" class="w-full">
                                        <option value="01">Janvier</option>
                                        <option value="02">Fevrier</option>
                                        <option value="03">Mars</option>
                                        <option value="04">Avril</option>
                                        <option value="05">Mai</option>
                                        <option value="06">Juin</option>
                                        <option value="07">Juillet</option>
                                        <option value="08">Aout</option>
                                        <option value="09">September</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Decembre</option>
                                    </select>

                                </div>
                                <div class="w-1/4 px-3 mx-1 rounded py-3 border">
                                    <select name="day" id="day" class="w-full">
                                    </select>
                                </div>
                                <div class="w-1/4  px-3 rounded py-3 border">
                                    <select name="year" id="year" class="w-full">
                                        
                                    </select>
                                </div>
                                
                            </div>
                            <input type="date" name="birthday" class="hidden" id="birthday">
 
                        </div>
                        <div id="part-2" class="sm:px-8 hidden">
                            <p class="font-bold text-2xl mb-7">Personnalisez votre expérience</p>
                            <p class="font-bold text-lg mb-7">Suivez les endroits où vous voyez du contenu Twitter sur le Web.</p>
                            <div class="flex">
                                <label for="politique" class="text-gray-600">Twitter utilise ces données pour personnaliser votre expérience. Cet historique de navigation ne sera jamais stocké avec votre nom, votre adresse email ou votre numéro de téléphone.</label>
                                <div class="w-32 flex  justify-center mt-5">
                                    <input type="checkbox" name="politique"  class="" id="politique">
                                </div>

                            </div>
                            <p class="text-gray-500 text-sm mt-5"> Pour plus de détails sur ces paramètres, rendez-vous dans le <span class="primaire">Centre d'assistance</span>.</p>
                        </div>

                        <div id="part-3" class="sm:px-12 hidden">
                            <p class="font-bold text-xl mb-7">Créer votre compte</p>
            
                            <div id="preview-info">
                                <div class="border cursor-pointer rounded border-gray-300 py-3 px-2">
                                    <span id="preview-fullname"></span>
                                </div>
                                <div class="border cursor-pointer rounded border-gray-300 py-3 px-2 mt-5">
                                    <span id="preview-email"></span>
                                
                                </div>
                                <div class="border cursor-pointer rounded border-gray-300 py-3 px-2 mt-5">
                                    <span id="preview-date"></span>
                                </div>
                            </div>
                            <div class="border rounded border-gray-300 py-3 px-2 mt-5">
                                <input type="password" name="password" placeholder="mots de passe" id="password" class="w-full outline-none  "> 
                            
                            </div>
                            <div class="border rounded border-gray-300 py-3 px-2 mt-5">
                                <input type="password" name="confirme" placeholder="confirmer votre mots de passe" id="confirme-password" class="w-full outline-none  "> 
                            
                            </div>
                            
                            <p class="text-gray-600 mt-12">
                            En vous inscrivant, vous acceptez <a href="" class="primaire hover:underline">les Conditions d'utilisation</a> et <a href="" class="hover:underline primaire">la Politique de confidentialité</a>, ainsi que l'utilisation des <a href="" class="hover:underline primaire">cookies</a>. Les utilisateurs pourront vous trouver grâce à votre adresse email et à votre numéro de téléphone, si vous les avez fournis · Options de <a href="" class="hover:underline primaire">confidentialité</a>

                            </p>
                            <button type="button" id="submit" class="disabled rounded-full bg-primaire hover-bg-primaire text-white font-bold w-full mt-5 py-3 ">S'inscrire</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/signup.js" >     
    </script>