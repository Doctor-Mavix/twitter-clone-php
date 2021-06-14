<?php

/**
 * Manage our route
 */

/**
 * Require controller
 */
require_once(CONTROLLERS_ROOT . "/UsersController.php");
require_once(CONTROLLERS_ROOT . "/TweetsController.php");
require_once(CONTROLLERS_ROOT . "/CommentsController.php");
require_once(CONTROLLERS_ROOT . "/FriendsController.php");
require_once(CONTROLLERS_ROOT . "/SearchController.php");
require_once(CONTROLLERS_ROOT . "/MessageController.php");

class Router extends Controller
{

    // instance for
    private $userController;
    private $tweetController;
    private $commentController;
    private $friendController;
    private $searchController;
    private $messageController;

    public function __construct()
    {
        $this->userController = new UsersController();
        $this->tweetController = new TweetsController();
        $this->commentController = new CommentsController();
        $this->friendController = new FriendsController();
        $this->searchController = new SearchController();
        $this->messageController = new MessageController();


        $url = $this->getUrl();
        $data = [];
        if (empty($url)) {
            $url = [];
            array_push($url, "");
        } else {
            if (count($url) > 1) {
                for ($i = 1; $i < count($url); $i++) {
                    array_push($data, $url[$i]);
                }
            }
        }


        $this->name($url[0], $data);
    }

    public function name($url, $data = "")
    {
        /***
         *  Guest
         */

        if (Auth::require_login()) {
            switch ($url) {
                case 'welcome':
                    $this->userController->welcome($url);
                    break;
                case 'register':
                    $this->userController->register($url);
                    break;

                case 'login':
                    if (is_post_request()) {
                        $this->userController->login();
                    }
                    if (is_get_request()) {
                        $this->view("auth/$url");
                    }
                    break;

                default:
                    redirect("welcome");
                    break;
            }
        }

        /**
         * Auth route
         */
        if (Auth::is_login()) {

            switch ($url) {
                case 'home':
                    $this->tweetController->home();

                    break;


                case 'profil':
                    if (!empty($data)) {
                        // $this->tweetController->get_likes_tweet();

                        $this->userController->get_visite_user($data[0]);
                    } else {
                        $this->tweetController->get_profil();
                    }

                    break;

                case 'update-profil':
                    if (is_post_request()) {
                        $this->userController->update_profil();
                    }
                    break;

                case 'tweet':

                    if (is_post_request()) {
                        if (!empty($data)) {


                            if ($data[0] == "put") {
                                $this->tweetController->update($data[1]);
                            }

                            if ($data[1] == "post") {
                                $this->tweetController->comment($data[2]);
                            }
                        } else {
                            $this->tweetController->tweet();
                        }
                    }
                    if (is_get_request()) {
                        if (isset($data[1])) {
                            if ($data[0] == "show") {
                                $this->tweetController->load_tweet($data[1]);
                            } else if ($data[0] == "delete") {
                                $this->tweetController->delete($data[1]);
                            } else if ($data[0] == "love") {
                                $this->tweetController->love($data[1]);
                            } else if ($data[0] == "edit") {
                                $this->tweetController->preview_edit($data[1]);
                            } else if ($data[0] == "reaction") {
                                $this->tweetController->load_reaction($data[1]);
                            } else if ($data[0] == "comment") {
                                if ($data[1] == "preview") {
                                    $this->commentController->load_preview_tweet_for_comment($data[2]);
                                } else if ($data[1] == "get") {
                                    $this->commentController->load_comment($data[2]);
                                }
                            } else {
                                errors(["something went wrong"]);
                                redirect("home");
                            }
                        } else {
                            $this->tweetController->show($data);
                        }
                    }

                    if (is_ajax_request()) {
                    }
                    break;


                case "comment":
                    if ($data[0] == "love") {
                        $this->commentController->love($data[1]);
                    }
                    if ($data[0] == "edit") {
                        $this->commentController->preview_edit($data[1]);
                    }
                    if ($data[0] == "put") {
                        $this->commentController->update($data[1]);
                    }
                    if ($data[0] == "delete") {
                        $this->commentController->delete($data[1]);
                    }
                    break;


                case "users":
                    if (!empty($data)) {
                        if ($data[0] == "get") {
                            $this->friendController->list_user();
                        } else if ($data[0] == "follow") {
                            $this->friendController->follow($data[1]);
                        } else if ($data[0] == "who-to-follow") {
                            $this->friendController->who_to_follow();
                        }
                    } else {
                        $this->view("/profil/list-users");
                    }
                    break;
                case "followers":
                    if (!empty($data)) {
                        if ($data[0] == "get") {
                            $this->friendController->list_followers();
                        } else if ($data[0] == "profil" && $data[1] == "get") {
                            $this->friendController->show_follow_visite_btn($data[2]);
                        }
                    } else {
                        $this->view("/profil/followers");
                    }
                    break;


                case "search":
                    $this->searchController->search_all($_GET["search"]);
                    break;
                case "message":
                    if (empty($data)) {
                        $this->messageController->all();
                        break;
                    } else if ($data[0]) {
                        if (is_post_request()) {
                            $this->messageController->send($data[0], $_POST["message"]);
                            break;
                        } else {
                            $this->messageController->conversation($data[0]);
                            break;
                        }
                    }
                case 'logout':
                    $this->userController->logout($url);
                    break;




                default:
                    redirect("home");
                    break;
            }
        }
    }

    // get url 
    public function getUrl()
    {
        $url = "";
        if (!empty($_GET["url"])) {
            $url = explode("/", $_GET["url"]);
        }

        return $url;
    }
    public function to($route_name)
    {
        header("Location:$route_name");
    }
}
