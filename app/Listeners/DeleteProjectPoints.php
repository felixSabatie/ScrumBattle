<?php

namespace App\Listeners;

use App\Events\CardDeleted;
use App\Http\Controllers\Api\ProjectsController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeleteProjectPoints
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CardDeleted  $event
     * @return void
     */
    public function handle(CardDeleted $event)
    {
        $card = $event->getCard();
        $project = $card->column->project;
        $project->total_points -= $card->points;
        foreach ($card->users as $user) {
            $project_user = $user->projects()->findOrFail($card->column->project_id)->pivot;
            $project_user->total_points -= $card->points;
            if (strcmp($card->column->name, ProjectsController::$DONE) == 0) {
                $project_user->done_points -= $card->points;
                $project->done_points -= $card->points;
            }
            $project_user->save();
        }
        $project->save();
    }
}
