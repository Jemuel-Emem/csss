<?php

namespace App\Livewire\Admin;
use App\Models\survey as Question;
use Livewire\Component;
use WireUi\Traits\Actions;

class Survey extends Component
{
    use Actions;

    public $add_modal = false;
    public $edit_modal = false;
    public $question;
    public $questionId;

    protected $rules = [
        'question' => 'required|string|max:255',
    ];

    public function render()
    {
        $questions = Question::all();
        return view('livewire.admin.survey', compact('questions'));
    }

    public function submit()
    {
        $this->validate();

        Question::create([
            'question' => $this->question,
        ]);

        $this->notification()->success(
            $title = 'Success',
            $description = 'Question added successfully!'
        );

        $this->reset(['question', 'add_modal']);
    }

    public function openEditModal($id)
    {
        $question = Question::findOrFail($id);
        $this->questionId = $question->id;
        $this->question = $question->question;
        $this->edit_modal = true;
    }

    public function update()
    {
        $this->validate();

        $question = Question::findOrFail($this->questionId);
        $question->update([
            'question' => $this->question,
        ]);

        $this->notification()->success(
            $title = 'Success',
            $description = 'Question updated successfully!'
        );

        $this->reset(['question', 'edit_modal']);
    }

    public function delete($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you sure?',
            'description' => 'You won\'t be able to revert this!',
            'icon'        => 'warning',
            'accept'      => [
                'label'  => 'Yes, delete it!',
                'method' => 'deleteConfirmed',
                'params' => $id,
            ],
            'reject' => [
                'label'  => 'No, cancel',
            ],
        ]);
    }

    public function deleteConfirmed($id)
    {
        Question::findOrFail($id)->delete();

        $this->notification()->success(
            $title = 'Success',
            $description = 'Question deleted successfully!'
        );
    }
}
