<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{

    use WithPagination;
    //public $comments;

    public $newComment;

    public function mount()
    {
      /*
        $initialComments = Comment::latest()->paginate(2);
        $this->comments = $initialComments;
      */
    }

    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|max:255'
        ]);

        $createdComment = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1
        ]);


        $this->newComment = '';
        session()->flash('message', 'comment added successfully');
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        $comment->delete();
        session()->flash('message', 'comment deleted successfully');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(2)
        ]);
    }
}
