<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{

    public $comments = [
        [
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam consequuntur dolores est explicabo fuga iusto magnam modi molestiae nesciunt nihil porro possimus qui, quis, sapiente sit unde ut? Est, maiores.',
            'created_at' => '3 min ago',
            'creator' => 'Davide'
        ]
    ];

    public $newComment;

    public function addComment()
    {
        array_unshift($this->comments, [
            'body' => $this->newComment,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'Cacao'
        ]);
        $this->newComment = '';
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
