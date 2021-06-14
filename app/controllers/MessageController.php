<?php
class MessageController extends Controller
{
    private $User;

    public function __construct()
    {
        $this->User  = $this->model("User");
    }

    public function all()
    {
    }

    public function  send($receiver, $message)
    {
        $receiver = $this->User->get($receiver);

        dd($receiver);
    }

    public function conversation($receiver)
    {
        $receiver = $this->User->get($receiver);
        // dd($receiver);
        $this->view("message/Conversation", $receiver);
    }
}
