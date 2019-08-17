@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">


            <div class="col-md-12">


                <table border="0" cellspacing ="20">
                    @foreach ($recipeArray as $allIng)
                        <tr> <td> <strong>{{$allIng->name}} </strong></td>
                            <td>{{$allIng->description}}</td><td><table>
                        @foreach ($allIng->ingridients as $ing)
                            <td> <p>{{$ing->name}}</p></td></tr>

                        @endforeach
                                </table> </td></tr>
                    @endforeach


                </table>


            </div>
        </div>

        <script>



        </script>


    <!--div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
        <div class="alert alert-success">
{{ session('status') }}
                </div>
@endif

            You are logged in!
        </div>
    </div>
</div>
</div-->
    </div>
@endsection
