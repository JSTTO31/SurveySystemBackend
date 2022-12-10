<?php

namespace App\Jobs;

use App\Models\Question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateQuestionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $question;
    public $data;
    public function __construct(Question $question, $data)
    {
        $this->question = $question;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->question->text = $this->data['text'] ?? $this->question->text;
        $this->question->required = $this->data['required'] ?? $this->question->required;
        $this->question->properties = $this->data['properties'] ?? $this->question->properties;

        if($this->question->isDirty()){
            $this->question->save();
        }

    }
}
