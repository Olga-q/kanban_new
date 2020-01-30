@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <form method="POST" class="js-form">
                        <fieldset>
                            <input name="task" id="new-task" size="50" placeholder="Новая задача"  maxlength="120" required/>
                            <input type="submit" name="button" value="+" />
                        </fieldset>
                    </form>
                </div>

                <div class="panel-body">
                    <div class="col-md-4">
                        <ul class='list' id='colomn1'>
                        </ul>   
                    </div>

                    <div class="col-md-4">
                        <ul class='list' id='colomn2'>
                        </ul>   
                    </div>

                    <div class="col-md-4">
                        <ul class='list' id='colomn3'>
                        </ul>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
