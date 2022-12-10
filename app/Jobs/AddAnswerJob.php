<?php

namespace App\Jobs;

use App\Models\Question;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AddAnswerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $question;
    public $survey;

    public function __construct(Question $question, Survey $survey)
    {
        $this->question = $question;
        $this->survey = $survey;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $this->question->answers()->create([
            'index' => $this->question->answers()->count(),
            'survey_id' => $this->survey->id,
            'text' => '',
        ]);
    }
}
