<?php

namespace App\Jobs;

use App\Models\Survey;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class AddQuestionJob implements ShouldQueue
{
    use Dispatchable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $survey;
    public $question;
    public function __construct(Survey $survey, $question)
    {
        $this->survey = $survey;
        $this->question = $question;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::table('questions')->where('survey_id', $this->survey->id)->where('index', '>=', $this->question['index'])->increment('index');
        $this->survey->questions()->create([
            'index' => $this->question['index'],
            'text' => $this->question['text'] ?? "",
            'type' => $this->question['type'],
            'properties' => $this->question['properties'],
        ]);
    }
}
