<?php

namespace App\Listeners;

use App\Events\PointsUpdated;
use App\Http\Controllers\Api\ProjectsController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateProjectUserPoints
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
     * @param  PointsUpdated  $event
     * @return void
     */
    public function handle(PointsUpdated $event)
    {
        $updatedColumn = $event->getUpdatedCard()->column;
        $oldColumnName = $event->getOldCard()->column->name;

        $updatedPoints= $event->getUpdatedCard()->points;
        $oldPoints  = $event->getOldCard()->points;
        $users = $event->getUpdatedCard()->users;

        foreach ($users as $user) {
            $project_user = $user->projects()->findOrFail($updatedColumn->project_id)->pivot;
            if ($oldColumnName !== $updatedColumn->name) {
                if (strcmp($updatedColumn->name, ProjectsController::$DONE) == 0) {
                    $project_user->done_points += $updatedPoints;
                }
                else if(strcmp($oldColumnName, ProjectsController::$DONE )==0) {
                    $project_user->done_points -= $updatedPoints;
                }
            }
            if ($updatedPoints !== $oldPoints) {
                if ($project_user->total_points === null) {
                    $project_user->total_points = $updatedPoints;
                } else {
                    $project_user->total_points += $updatedPoints - $oldPoints;
                    $project_user->done_points += (strcmp($updatedColumn->name, ProjectsController::$DONE) == 0) ? $updatedPoints - $oldPoints : 0;
                }
            }
            $project_user->save();
        }
    }
}
