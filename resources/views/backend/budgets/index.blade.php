@extends('backend.layouts.app', ['title' => 'ช่องทางการติดต่อ'])

@section('content')

<h1>จัดการข้อมูลงบประมาณ</h1>

<div class="block">
    <div class="app-heading bordered">
        <div class="d-flex">
            <h2>จัดการข้อมูลงบประมาณ</h2>
            <p><i class="fa fa-home"></i> - จัดการข้อมูลงบประมาณ </p>
        </div>
    </div>

    <div class="block-content">
        {{ Form::open(['url'=> url("admin/budgets"), 'id' => 'form-budget', 'class'=>'form']) }}
        @method('POST')
        <div class="form-body">
            <div class="row">
                <div class="col-md-6">
                    {!! Form::groupText('budget_year', 'ปีงบประมาณ', $budget->budget_year, ['class'=>'', 'maxLength'=>4]) !!}
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">ข้อมูล ณ วันที่</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <span class="icon-calendar-full"></span>
                            </span>
                            <input type="text" class="form-control bs-datepicker" name="date" value="{{ $budget->date->format('d/m/Y') }}">
                           
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="form-separator"></div>
            {!! Form::groupText('budget_total', 'งบประมาณรวมทั้งหมด', $budget->budget_total, ['class'=>'autonumeric']) !!}
            {!! Form::groupText('disburse_total', 'เบิกจ่ายทั้งหมด', $budget->disburse_total, ['class'=>'autonumeric']) !!}
            <div class="form-separator"></div>
            {!! Form::groupText('budget_operate','งบดำเนินงาน', $budget->budget_operate, ['class'=>'autonumeric']) !!}
            {!! Form::groupText('disburse_operate','เบิกจ่าย', $budget->disburse_operate, ['class'=>'autonumeric']) !!}
            <div class="form-separator"></div>
            {!! Form::groupText('budget_invest','งบลงทุน', $budget->budget_invest, ['class'=>'autonumeric']) !!}
            {!! Form::groupText('disburse_invest','เบิกจ่าย', $budget->disburse_invest, ['class'=>'autonumeric']) !!}

        </div>
        <div class="form-action">
            <a href="{{ url('admin/budgets') }}" class="btn btn-default">ยกเลิก</a>
            <button type="submit" class="btn btn-submit">บันทึก</button>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection

@section('scripts')
{{-- <script src="{{ mix('backend/js/pages/budget.min.js') }}"></script> --}}
{!! JsValidator::formRequest('App\Http\Requests\Backend\BudgetRequest', '#form-budget') !!}
@endsection