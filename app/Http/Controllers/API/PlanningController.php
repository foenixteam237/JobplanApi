<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanningResource;
use App\Models\Planning;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       // $plannings = Planning::with(['users.role','months','programs.user','programs.days','programs.hours'])->get();

       $plannings = Planning::with([
        'users.role' => function ($query) {
            $query->select('id','roleName');
        },
        'months' => function ($query) {
            $query->select('id','desc');
        },
        'programs.user.role' => function ($query) {
            $query->select('id','roleName');
        },
        'programs.days' => function ($query) {
            $query->select('id', 'desc');
        },
        'programs.hours' => function ($query) {
            $query->select('id', 'code');
        }
    ])->paginate(10);
        return PlanningResource::collection($plannings);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Planning $planning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Planning $planning)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planning $planning)
    {
        //
    }
}
