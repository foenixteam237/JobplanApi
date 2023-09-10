<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlanningResource;
use App\Models\Planning;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
                $query->select('id', 'roleName');
            },
            'months' => function ($query) {
                $query->select('id', 'desc');
            },
            'programs.user.role' => function ($query) {
                $query->select('id', 'roleName');
            },
            'programs.days' => function ($query) {
                $query->select('id', 'desc');
            },
            'programs.hours' => function ($query) {
                $query->select('id', 'code');
            }
        ])->paginate(10);
        return PlanningResource::collection($plannings);

        /*$transformedPlannings = Collection::make($plannings->items())->map(function ($planning) {
            // Formater les données du planning selon la structure JSON souhaitée
            $formattedPlanning = [
                'idPlanning' =>$planning->id,
                'STATUT' => $planning->status,
                'Année' => $planning->year,
                'Mois' => $planning->months->desc,
                'Semaine' => $planning->week,
                'Planning' => []
            ];
        
            // Parcourir les jours du planning
            foreach ($planning->programs as $program) {
                $formattedDay = [
                    'jour' => $program->days->desc,
                    'codeHeure' => $program->hours->code,
                    'agents' => [
                        'nom' => $program->user->name
                    ],
                    'hour' =>[]
                ];
        
                // Parcourir les agents du jour
                foreach ($program->hours->programs as $hour) {
                    $formattedDay['hour'][] = $hour->hours->code;
                }
        
                $formattedPlanning['Planning'][] = $formattedDay;
            }
        
            return $formattedPlanning;
        });
      
        return response()->json($transformedPlannings);*/
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if (!PlanningValidator::validate($request->all())) {
            return response()->json([
                'status' => false,
                'message' => "Données invalides",
            ], 400);
        }

        $planning = Planning::create([
            'by' => $request->by,
            'week' => $request->week,
            'year' => $request->year,
            'idMonth' => $request->idMonth,
            'idWorkplaces' => $request->workplace
        ]);

        return response()->json([
            'status' => true,
                'message' => "Crée",
                'users' => $planning
        ], 201);
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


class PlanningValidator
{
    public static function validate(array $data)
    {
        $rules = [
            "week" => 'required|int',
            "year" => 'required|max:4',
            "idMonth" => 'required|int',
            "by" => 'required|int',
            "workplace" => 'required|int',
        ];
        $validator = Validator::make($data, $rules);
        return $validator->passes();
    }
}
