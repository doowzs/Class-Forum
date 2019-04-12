<?php

namespace App\Observers;

use App\Models\Problem;

class ProblemObserver
{
    /**
     * Handle the problem "created" event.
     *
     * @param  Problem  $problem
     *
     * @return void
     */
    public function created(Problem $problem)
    {
        //
    }

    /**
     * Handle the problem "updated" event.
     *
     * @param  Problem  $problem
     *
     * @return void
     */
    public function updated(Problem $problem)
    {
        //
    }

    /**
     * Handle the problem "deleted" event.
     *
     * @param  Problem  $problem
     *
     * @return void
     */
    public function deleted(Problem $problem)
    {
        //
    }

    /**
     * Handle the problem "restored" event.
     *
     * @param  Problem  $problem
     *
     * @return void
     */
    public function restored(Problem $problem)
    {
        //
    }

    /**
     * Handle the problem "force deleted" event.
     *
     * @param  Problem  $problem
     *
     * @return void
     */
    public function forceDeleted(Problem $problem)
    {
        //
    }
}