<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{

    public $comments;

    public $newComment;

    public function mount()
    {
        $initialComments = Comment::all();
        $this->comments = $initialComments;
    }

    public function addComment()
    {
        if ($this->newComment == '') {
            return;
        }

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
