<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/tailwind.css">

    <link rel="stylesheet" href="./font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="index">
        <div class="flex flex-wrap">
            <div class="img w-full order-2 sm:order-1 sm:w-1/2 flex justify-center items-center ">
                    <!-- <img src="./img/lohp_1302x955.png" alt=""> -->
                <div>
                <i class="fa fa-twitter text-white " aria-hidden="true"></i>
                </div>
            </div>
            <div class="w-full sm:w-1/2 order-1 sm:order-2 my-8 sm:my-0 h-1/1 flex items-center">
                <div class=" px-1 sm:px-10">
                    <span><i class="fa fa-twitter logo mb-12 " aria-hidden="true"></i></span>
                    <h3 class="font-bold h1 leading-none mb-8">Ça se passe maintenant</h3>
                    <p class="text-4xl my-3 tracking-wide font-bold">Rejoignez Twitter dès aujourd'hui.</p>
                    <?php show_errors()?>

                    <div class="mt-12">
                        <a href="" id="sign-up-btn" class="bg-primaire hover-bg-primaire px-36 font-bold text-white rounded-full text-center py-3">S'inscrire</a>
                    </div>
                    <div class="mt-12">
                        <a href="/login"  class="border-blue-400 hover-white  px-32 font-bold primaire border rounded-full border-solid  text-center py-3">Se connecter</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3 px-5 text-center">
            <a href="" class="text-gray-700 text-sm mx-1">A propos</a>
            <a href="" class="text-gray-700 text-sm mx-1">Centre d'assistance </a>
            <a href="" class="text-gray-700 text-sm mx-1">Condition d'utilisation</a>
            <a href="" class="text-gray-700 text-sm mx-1">Politique de Confidentialite</a>
            <a href="" class="text-gray-700 text-sm mx-1">Politique relative aux cookies</a>
            <a href="" class="text-gray-700 text-sm mx-1">Information sur les publicite </a>
            <a href="" class="text-gray-700 text-sm mx-1">Blog</a>
            <a href="" class="text-gray-700 text-sm mx-1">Statut </a>
            <a href="" class="text-gray-700 text-sm mx-1">Carrieres</a>
            <a href="" class="text-gray-700 text-sm mx-1">Ressource de la marque</a>
            <a href="" class="text-gray-700 text-sm mx-1">Publicite</a>
            <a href="" class="text-gray-700 text-sm mx-1">Marketing</a>
            <a href="" class="text-gray-700 text-sm mx-1">Twitter pour les professionnels</a>
            <a href="" class="text-gray-700 text-sm mx-1">Developpeur</a>
            <a href="" class="text-gray-700 text-sm mx-1">Repertoire</a>
            <a href="" class="text-gray-700 text-sm mx-1">Parametres</a>
            <a href="" class="text-gray-700 text-sm mx-1">&copy; 2021 Mavix , Inc</a>
        </div>
    </div>

    <?php  require_once(VIEW_ROOT."/auth/register.php");?>
    
</body>
</html>