@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                        </div>
                    @endif

                    You are logged in!
                </div>
                <expenditure-form expenditure_id="1"></expenditure-form>
                {{--<expenditure-form ></expenditure-form>--}}
            </div>
        </div>
        <expenditure-table></expenditure-table>
    </div>
</div>
@endsection
