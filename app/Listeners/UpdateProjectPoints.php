<?php

namespace App\Listeners;

use App\Events\PointsUpdated;
use App\Http\Controllers\Api\ProjectsController;
use App\Models\Card;
use App\Models\Column;
use App\Models\Project;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class UpdateProjectPoints
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
     * Need to handle where th epoints of cards are changed and the card is switched of column
     * @param  PointsUpdated  $event
     * @return void
     */
    public function handle(PointsUpdated $event)
    {
        $updatedColumn = $event->getUpdatedCard()->column;
        $oldColumnName = $event->getOldCard()->column->name;
        $project = $updatedColumn->project;

        $updatedPoints = $event->getUpdatedCard()->points;
        $oldPoints = $event->getOldCard()->points;

        if ($oldColumnName !== $updatedColumn->name) {
            if (strcmp($updatedColumn->name, ProjectsController::$DONE) == 0) {
                $project->done_points += $updatedPoints;
            } else if (strcmp($oldColumnName, ProjectsController::$DONE) == 0) {
                $project->done_points -= $updatedPoints;
            }
        }
        if ($updatedPoints !== $oldPoints) {
            $project->total_points += $updatedPoints - $oldPoints;
        }
        $project->save();
    }
}
