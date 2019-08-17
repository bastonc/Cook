@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-4">

                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th>
                        </th>
                        <th>
                        </th>
                        <th>
                        </th>
                        <th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <a href="{{Route('home')}}"> Мои рецепты </a>
                        </td>

                    </tr>
                    <tr class="table-active">

                        <td>
                            Ингридиенты
                        </td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">


                <table border="0" cellspacing ="20">
                    @foreach ($allIngArray as $allIng)
                    <tr> <td> <strong>{{$allIng->name}} </strong></td></tr>
                    @foreach ($allIng->ingredients as $ing)
                    <tr> <td> <p>{{$ing->name}}</p></td></tr>
                    @endforeach
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
