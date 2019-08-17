<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $db = new DBController;
        $allRecipe=$db->getAllRecipeUser(Auth::user()->id);
        //dd($allRecipe);
        return view('home',['allrecipe'=>$allRecipe]);
    }
    public function create()
    {
        $flag='create';
        return view('formRecipe',['flag'=>$flag]);
    }
    public function createRecipe(Request $request)
    {

        $createdb = new DBController;
        $ingridients = new ingridientsController;
        //dump($request);
        $ingridientsList=json_decode($request->ingridients_info);
       // dd($ingridientsList[0]->quantity_ingridients);
        $idCreateRecipe=$createdb->createRecipe(Auth::user()->id,$request->name, $request->description);
        if ($idCreateRecipe!='error') {
            $ingridients->addingridients($idCreateRecipe, $ingridientsList, $request);
            return redirect()->route('home');
        }else{
            return view('error',['errorText'=>'такой рецепт уже существует, не стоит добавлять его дважды']);
        }

    }
    public function editRecipe(Request $request)
    {
        $idRecipe=$request->recipe;
        $idUser=Auth::user()->id;
        $dbreciev= new DBController;
        $recipeInfo=$dbreciev->getRecipe($idRecipe,$idUser);
        $ingridientsArray=$dbreciev->getIngridientsForRecipe($idRecipe);
        $flag='edit';
        return view('formRecipe',['flag'=>$flag, 'recipeInfo'=>$recipeInfo, 'ingridientsArray'=>$ingridientsArray,'idRecipe'=>$idRecipe]);


    }
    public function storeRecipe(Request $request)
    {

        $dbwork= new DBController;
        $ingwork = new ingridientsController;
        $idUser=Auth::user()->id;
        $dbwork->editRecipe($request->idRecipe,$idUser, $request->name, $request->description);
        $ingridientsList=json_decode($request->ingridients_info);
        $ingwork->editIngridients($request->idRecipe, $ingridientsList, $request);
        return redirect()->route('home');


    }
    public function viewRecipe (Request $request)
    {
        $dbwork= new DBController;
        $idRecipe=$request->recipe;
        $idUser=Auth::user()->id;
        $getRecipe = $dbwork->getRecipe($idRecipe, $idUser);
        $getIngredient = $dbwork->getIngridientsForRecipe($idRecipe);
        return view('viewrecipe',['getResipe'=>$getRecipe, 'getIngridient'=>$getIngredient]);
    }
    public function delRecipe(Request $request)
    {

        $dbwork = new DBController;
        $delRecipe= $dbwork->deleteRecipe($request->recipe, Auth::user()->id);
        if ($delRecipe!=0)
        {
            return redirect()->route('home');
        }
        else{
            return view('error',['errorText'=>'Не удалось удалить']);
        }
    }
}
