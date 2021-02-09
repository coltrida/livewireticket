<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Comments extends Component
{

    use WithPagination;
    use WithFileUploads;
    //public $comments;

    public $newComment;
    public $image;
    public $ticket_id;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected',
    ];

    public function mount()
    {
      /*
        $initialComments = Comment::latest()->paginate(2);
        $this->comments = $initialComments;
      */
    }

    public function ticketSelected($ticketId)
    {
        $this->ticket_id = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;
    }
    
    public function addComment()
    {
        $this->validate([
            'newComment' => 'required|max:255'
        ]);

        $image = $this->storeImage();

        $createdComment = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1,
            'image' => $image,
            'support_ticket_id' => $this->ticket_id
        ]);


        $this->newComment = '';
        $this->image = '';
        session()->flash('message', 'comment added successfully');
    }

    public function storeImage()
    {
        if (!$this->image) return null;

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random().'.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);
        Storage::disk('public')->delete($comment->image);
        $comment->delete();
        session()->flash('message', 'comment deleted successfully');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->ticket_id)->latest()->paginate(2)
        ]);
    }
}
