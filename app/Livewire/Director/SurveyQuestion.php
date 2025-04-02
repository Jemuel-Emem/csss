<?php

namespace App\Livewire\Director;
use App\Models\survey as Question;
use Livewire\Component;
use WireUi\Traits\Actions;


class SurveyQuestion extends Component
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
        return view('livewire.director.survey-question', compact('questions'));
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
        Question::findOrFail($id)->delete();

        $this->notification()->success(
            $title = 'Success',
            $description = 'Question deleted successfully!'
        );
    }

    public function deleteConfirmed($id)
    {

    }

}
