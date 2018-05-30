<?php

namespace App\Repository;
use App\User;
use App\Message;
use Carbon\Carbon;

class ConversationRepository {

    private $user;
    private $message;

    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    public function getConversations(int $userId)
    {
        return $this->user->newQuery()
                          ->select('name', 'id')
                          ->where('id', '!=', $userId)
                          ->get();
    }

    public function createMessage(string $content, int $from, $to)
    {
        $this->message->newQuery()
                      ->create([
                          'content' => $content,
                          'from_id' => $from,
                          'to_id' => $to,
                          'created_at' => now()
                      ]);
    }

    public function getMessages(int $from, int $to)
    {
        return $this->message->newQuery()
                    ->whereRaw("((from_id = $from and to_id = $to) or (from_id = $to and to_id = $from))")
                    ->orderBy('created_at', 'DESC')
                    ->with([
                        'from' => function($query){
                            return $query->select('name', 'id');
                        }
                    ]);
    }
    /**
     * @param UserId 
     * get all unread Message for each convarsation
     * @author taha
     */
    public function unreadCount(int $userId)
    {
        return $this->message->newQuery()
                    ->where('to_id', $userId)
                    ->groupBy('from_id')
                    ->selectRaw('from_id , count(id) as count')
                    ->whereRaw('read_at is null')
                    ->get()
                    ->pluck('count', 'from_id');
    }

    public function readAll(int $from, int $to)
    {
        $this->message->where('from_id', $from)->where('to_id', $to)->update(['read_at' => now()]);
    }


}

?>