<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ingridientsController extends Controller
{
    // this controller include all methods for ingridients
    public function addingridients($idRecipe,$ingArray,$request)
    {
        $addIng= new DBController;
        $countArray=count($ingArray);
        for($i=0; $i<$countArray;$i++) {
            if ($ingArray!=NULL) {
                $name = $ingArray[$i]->name_ingridients;
                $quantity = $ingArray[$i]->quantity_ingridients;
                $addIng->addIngridients($idRecipe, $request->$name, $request->$quantity);


            }
        }
    }
    public function getIngridients($idRecipe)
    {
        $dbreciev = new DBController;
        $ingArray=$dbreciev->getIngridientsForRecipe($idRecipe);

    }
    public function editIngridients($idRecipe,$ingArray,$request)
    {
        $addIng= new DBController;
        $countOldIng=$request->ingedit;
        for ($i=1; $i<$countOldIng; $i++)
        {
            $nameOldIng="ingridient".$i;
            $quantityOldIng="quantity".$i;
            $idIng="id".$i;
            $addIng->updateIng($idRecipe,$request->$nameOldIng, $request->$quantityOldIng,$request->$idIng);


        }
        if(isset($ingArray)) {
            $countArray = count($ingArray);
            for ($i = 0; $i < $countArray; $i++) {
                if ($ingArray[$i] != NULL) {
                    $name = $ingArray[$i]->name_ingridients;
                    $quantity = $ingArray[$i]->quantity_ingridients;
                    $addIng->addIngridients($idRecipe, $request->$name, $request->$quantity);


                }
            }
        }

    }
    public function allIngridients(Request $request)
    {

        $dbwork= new DBController;
        //$recipeArray=Array();
        $getAllRecipe=$dbwork->getAllRecipeUser(Auth::user()->id);
        $i=-1;
        foreach($getAllRecipe as $recipe)
        {
            $i++;
            $allIng=$dbwork->getIngridientsForRecipe($recipe->id);
            $recipe->ingredients=$allIng;

            //$allArray[]=$recipeArray;
        }
        //dd($getAllRecipe[0]->ingredients);
        return view('ingridients',['allIngArray'=>$getAllRecipe]);
        //dd($recipeArray);
    }
}
