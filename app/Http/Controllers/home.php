<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class home extends Controller
{
    //
    public function getAllRecipe ()
    {
        $dbwork= new DBController;
        $allRecipe=$dbwork->allReciep();
        foreach ($allRecipe as $recipe)
        {
            $ingredients=$dbwork->getIngridientsForRecipe($recipe->id);
            $recipe->ingridients=$ingredients;
        }
        //dd($allRecipe);
        return view('allrecipe',['recipeArray'=>$allRecipe]);
    }

}
