<?php

namespace App\Observers;

use App\Models\AssignmentFinishRecord;

class AssignmentFinishRecordObserver
{
    /**
     * Handle the assignment finish record "created" event.
     *
     * @param  AssignmentFinishRecord  $assignmentFinishRecord
     *
     * @return void
     */
    public function created(AssignmentFinishRecord $assignmentFinishRecord)
    {
        //
    }

    /**
     * Handle the assignment finish record "updated" event.
     *
     * @param  AssignmentFinishRecord  $assignmentFinishRecord
     *
     * @return void
     */
    public function updated(AssignmentFinishRecord $assignmentFinishRecord)
    {
        //
    }

    /**
     * Handle the assignment finish record "deleted" event.
     *
     * @param  AssignmentFinishRecord  $assignmentFinishRecord
     *
     * @return void
     */
    public function deleted(AssignmentFinishRecord $assignmentFinishRecord)
    {
        //
    }

    /**
     * Handle the assignment finish record "restored" event.
     *
     * @param  AssignmentFinishRecord  $assignmentFinishRecord
     *
     * @return void
     */
    public function restored(AssignmentFinishRecord $assignmentFinishRecord)
    {
        //
    }

    /**
     * Handle the assignment finish record "force deleted" event.
     *
     * @param  AssignmentFinishRecord  $assignmentFinishRecord
     *
     * @return void
     */
    public function forceDeleted(AssignmentFinishRecord $assignmentFinishRecord)
    {
        //
    }
}
