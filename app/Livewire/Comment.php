<?php

namespace App\Livewire;

use App\Models\Comment as ModelsComment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;
    public $newComment;

    public function render()
    {
        return view('livewire.comment', [
            'comments' => ModelsComment::latest()->paginate(2),
        ]);
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

        $this->newComment = "";

        session()->flash('message', 'Post Created Successfully');
    }

    public function deleteComment($commentId) {
        $commentData = ModelsComment::find($commentId);
        $commentData->delete();

        session()->flash('message', 'Post Deleted Successfully');
    }
}
