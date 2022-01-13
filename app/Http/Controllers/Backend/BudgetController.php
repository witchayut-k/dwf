<?php

namespace App\Http\Controllers\Backend;

use App\Enums\PermissionEnum;
use App\Helpers\FormHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BudgetController extends BaseController
{
    public function __construct()
    {
        // $this->middleware(["permission:".PermissionEnum::MANAGE_BUDGET]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budget = Budget::first() ?: new Budget();

        if (!$budget->date)
            $budget->date = Carbon::today();

        return view('backend.budgets.index', compact('budget'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $budget = Budget::first() ?: new Budget();
        $budget->budget_year = $request->budget_year;
        $budget->date = Carbon::createFromFormat("d/m/Y", $request->date);
        $budget->budget_total = FormHelper::NumberToString($request->budget_total);
        $budget->disburse_total = FormHelper::NumberToString($request->disburse_total);
        $budget->budget_operate = FormHelper::NumberToString($request->budget_operate);
        $budget->disburse_operate = FormHelper::NumberToString($request->disburse_operate);
        $budget->budget_invest = FormHelper::NumberToString($request->budget_invest);
        $budget->disburse_invest = FormHelper::NumberToString($request->disburse_invest);

        $budget->save();

        return response()->json(["data" => $budget, "message" => __("shared.update_success", ["name" => 'งบประมาณ'])]);
    }
}
