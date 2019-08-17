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
                            Мои рецепты
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
                @if ($flag=='create')

                <form action="{{route('createrecipe')}}" method="post">
                    {{ csrf_field() }}
                <table border="0" cellspacing ="20">
                <tr><td align="right">Название рецепта:&nbsp;&nbsp; </td> <td> <input  type="text"  name="name" size="70"></td></tr>
                <tr><td align="right">Описание рецепта:&nbsp;&nbsp; </td> <td> <textarea name="description" cols="69" rows="5"></textarea></td></tr>
                <tr><td colspan="2"><div id=divf0></div>
                <input type=button onClick=plus(); value='+ ингридиент'><br><br></td></tr>
                </table>
                <div id="ingridients_list" name="ingridients_list"></div>
                <input type="submit" value="Сохранить рецепт">
                </form>
                @elseif($flag=='edit')
                    <form action="{{route('editrecipe')}}" method="post">
                        {{ csrf_field() }}
                        <table border="0" cellspacing ="20">
                            <tr><td align="right">Название рецепта:&nbsp;&nbsp; </td> <td>
                                    <input  type="text"  name="name" size="70" value="{{$recipeInfo[0]->name}}"></td></tr>
                            <tr><td align="right">Описание рецепта:&nbsp;&nbsp; </td> <td>
                                    <textarea name="description" cols="69" rows="5">{{$recipeInfo[0]->description}}</textarea></td></tr>
                            <tr><td align="right">Ингридиенты:&nbsp;&nbsp; </td> <td>
                                    <table> <?php $n=0; ?>
                                        @foreach($ingridientsArray as $ing)
                                            <?php $n++; ?>
                                        <tr>
                                            <td><input  type="text"  name="ingridient{{$n}}" size="30" value="{{$ing->name}}"></td>
                                            <td><input  type="text"  name="quantity{{$n}}" size="3" value="{{$ing->quantity}}">
                                                <input  type="hidden"  name="id{{$n}}" size="3" value="{{$ing->id}}"></td>
                                        </tr>

                                        @endforeach
                                    </table>
                                    </td></tr>

                            <tr><td colspan="2"><div id=divf0></div>
                                    <input type=button onClick=plus(); value='+ ингридиент'><br><br></td></tr>
                        </table>
                        <input type="hidden" name="ingedit" value="{{$n}}">
                        <input type="hidden" name="idRecipe" value="{{$idRecipe}}">
                        <div id="ingridients_list" name="ingridients_list"></div>
                        <input type="submit" value="Сохранить рецепт">
                    </form>
                @endif
            </div>
        </div>

        <script>
            var n=0;
            var ingridients_array=Array();


            //document.getElementById('divhidden').innerHTML='<input type=hidden id=\"id'+n+'\" name=\"index_sps\" value=\"0\" >';
            function plus(){
                document.getElementById('divf' + n).innerHTML += '<div id=\"elem' + n + '"><br> Ингридиент: ' +
                    '                  <input type=text id=\"id_name_ingridients' + n + '\" name=\"ingridients_name' + n + '\" size=\"10\"> ' +
                    '                   количество: <input size=3 id=\"id_quantity_ingridients' + n + '\" name=\"quantity_ingridients_' + n + '\"> ' +
                    '                   <input type=\"button\" id=\"id\" onclick=\" minus('+n+')\" value=\"-\"> </div> <div id=divf' + (n + 1) + '></div>';
                
                ingridients_array.push( {
                    name_ingridients:document.getElementById("id_name_ingridients"+n).name,
                    quantity_ingridients:document.getElementById("id_quantity_ingridients"+n).name,
                    
                });
                ingridients_json_string = JSON.stringify(ingridients_array);
                //console.log (ingridients_json_string);
                document.getElementById('ingridients_list').innerHTML="<input type=hidden name=ingridients_info value="+ingridients_json_string+">";
                n++;

            }
            function minus(counter){

                delete ingridients_array[counter];  // delete array element (ingridients_array[counter] = NULL)
                ingridients_json_string = JSON.stringify(ingridients_array); //code array to json-string
                document.getElementById('ingridients_list').innerHTML="<input type=hidden name=ingridients_info value="+ingridients_json_string+">"; // reinclude json-string to value of hidden input
                //console.log(ingridients_array);


                elem=document.getElementById('elem'+ counter ); //delete  inputs from form
                elem.parentNode.removeChild(elem);

            }



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
