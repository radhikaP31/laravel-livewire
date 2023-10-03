<?php

namespace App\Livewire;

use App\Models\Comment as ModelsComment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Comment extends Component
{
    public $comments, $newComment;

    public function mount() {
        $initialComments = ModelsComment::latest()->get();
        $this->comments = $initialComments;
    }

    public function render()
    {
        return view('livewire.comment');
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'newComment' => 'required|max:255',
        ]);
    }

    public function addComment() {
        $this->validate([
            'newComment' => 'required|max:255',
        ]);
        $createdComment = ModelsComment::create(['body' => $this->newComment, 'user_id' => 1]);
        $this->comments->prepend($createdComment);

        $this->newComment = "";

        session()->flash('message', 'Post Created Successfully');
    }

    public function deleteComment($commentId) {
        $commentData = ModelsComment::find($commentId);
        $commentData->delete();
        $this->comments = $this->comments->except($commentId);

        session()->flash('message', 'Post Deleted Successfully');
    }
}
