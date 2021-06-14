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
    <div id="login" class="">
        
            <div class="w-full h-screen   my-8 sm:my-12 my-8 h-1/1 flex justify-center ">
                <div class=" px-10 sm:w-1/4">
                    <span><i class="fa fa-twitter logo mb-12 " aria-hidden="true"></i></span>
                    <p class="text-3xl my-3 tracking-wide font-bold">Se connecter à Twitter</p>
                    <?php show_errors()?>
                    <form action="/login" method="POST" >
                        <div class="border rounded border-gray-300 py-3 px-2">
                            <input type="text" name="email" placeholder="email ou username" id="login-email" class="w-full outline-none  "> 
                        </div>
                        <div class="border rounded border-gray-300 py-3 px-2 mt-5">
                            <input type="password" name="password" id="login-password" placeholder="mots de passe" class="w-full outline-none  "> 
                        </div>

                        <button type="submit" class="rounded-full bg-primaire hover-bg-primaire text-white font-bold w-full mt-5 py-3 ">Se connecter</button>
                    </form>
                    <div class="mt-8">
                        <a href="" class="text-blue-400 text-sm  hover:underline">Mots de passe oublie ?</a>
                        <span class="text-blue-400 text-sm">.</span>
                        <a href="" id="sign-up-btn"  class="text-blue-400 text-sm  hover:underline">S'inscrire sur Twitter</a>
                    </div>
                </div>
            </div>
        </div>
    

    <?php  require_once(VIEW_ROOT."/auth/register.php");?>

    <script>
    
    </script>
</body>
</html>