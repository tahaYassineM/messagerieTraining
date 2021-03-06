<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repository\ConversationRepository;
use Illuminate\Auth\AuthManager;

use App\User;

class ConversationController extends Controller
{

    private $r;
    private $auth;

    public function __construct(ConversationRepository $conversationRepository, AuthManager $auth)
    {
        $this->r = $conversationRepository;
        $this->auth = $auth;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->r->getConversations($this->auth->user()->id);
        return view('conversations.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, \App\Http\Requests\MessageRequest $request)
    {
        $message = $this->r->createMessage($request->content, $this->auth->user()->id, $user->id);
        $user->notify(new \App\Notifications\MessageRecieved($message));
        return redirect(route('conversations.show', [
                            'user' => $user]   ));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $users = $this->r->getConversations($this->auth->user()->id);
        $messages = $this->r->getMessages($this->auth->user()->id, $user->id)->paginate(2);
        $unread = $this->r->unreadCount($this->auth->user()->id);
        
        if( isset($unread[$user->id])){
            $this->r->readAll($user->id, $this->auth->user()->id);
            unset($unread[$user->id]);
        }

        return view('conversations.show', [
                                            'users' => $users,
                                            'user' => $user,
                                            'messages' => $messages,
                                            'unread' => $unread 
                                        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
