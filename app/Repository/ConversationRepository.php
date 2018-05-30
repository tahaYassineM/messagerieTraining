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
                          'created_at' => Carbon::now()
                      ]);
    }

    public function getMessages(int $from, int $to)
    {
        return $this->message->newQuery()
                    ->whereRaw("((from_id = $from and to_id = $to) or (from_id = $to and to_id = $from))")
                    ->orderBy('created_at', 'dd');
    }
}


?>