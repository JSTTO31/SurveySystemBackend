<?php

namespace App\Jobs;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class DeleteAnswerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $question;
    public $answer;

    public function __construct(Question $question, Answer $answer)
    {
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $index= $this->answer->index;
        $this->answer->delete();
        DB::table('answers')->where('question_index', $this->question->index)->where('index', '>', $index)->decrement('index');
    }
}
