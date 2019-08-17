@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <p align="right"><a href="/create"> Создать новый рецепт</a></p>
        </div>
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
                    <a>
                        <a href="{{route('home')}}"> Мои рецепты </a>
                    </td>

                </tr>
                <tr class="table-active">

                    <td>
                        <a href="{{route('allingridients')}}"> Ингридиенты</a>
                    </td>

                </tr>
               </tbody>
            </table>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        Название
                    </th>
                    <th>
                        Описание
                    </th>
                    <th>
                        Действия
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach ($allrecipe as $recipe)
                    <tr>
                        <td>
                            {{$recipe->name}}
                        </td>
                        <td>
                            {{$recipe->description}}
                        </td>
                        <td>
                            <a href="/edit?recipe={{$recipe->id}}">редактировать</a> |
                            <a href="/view?recipe={{$recipe->id}}">посмотреть</a> |
                            <a href="/del?recipe={{$recipe->id}}">удалить</a>
                        </td>
                    </tr>
                @endforeach
               </tbody>
            </table>
        </div>
    </div>




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
