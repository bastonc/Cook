<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DBController extends Controller
{
    // this controlle inclide all methods for DB connection
    public function getAllRecipeUser($userid)
    {
        $allRecipe=DB::select("SELECT * FROM resipes WHERE `keyUserId`=? ",[$userid]);
        return $allRecipe;
    }
    public function getIngridientsForRecipe($recipeid)
    {
      $allIngridients=DB::select("SELECT * FROM ingridients WHERE `keyRecipeId`=? ",[$recipeid]);
      return $allIngridients;
    }
    public function createRecipe($keyUserId,$name, $description)
    {
        $id=DB::select("SELECT id FROM `resipes` WHERE `keyUserId`=? AND `name`=? AND `description`=? ",[$keyUserId, $name, $description]);
        if($id==NULL) {
            DB::insert("INSERT INTO `resipes` (`keyUserId`, `name`, `description`)  VALUES (?,?,?)", [$keyUserId, $name, $description]);
            $id = DB::select("SELECT id FROM `resipes` WHERE `keyUserId`=? AND `name`=? AND `description`=? ", [$keyUserId, $name, $description]);
            //dd($id);
            $idresult=$id[0]->id;
        }else{$idresult='error';}
        return $idresult;
    }
    public function addIngridients($idRecipe, $name, $quantity)
    {
        //dd($quantity);
        $result=DB::insert("INSERT INTO `ingridients` (`keyRecipeId`, `name`, `quantity`)  VALUES (?,?,?)", [$idRecipe, $name, $quantity]);
        return $result;
    }
    public function getRecipe($idRecipe, $idUser)
    {
        $RecipeObject=$id = DB::select("SELECT * FROM `resipes` WHERE `keyUserId`=? AND `id`=?", [$idUser, $idRecipe]);
        return $RecipeObject;
    }
    public function editRecipe($idRecipe,$idUser, $name, $description)
    {
        $result=DB::update("UPDATE `resipes` SET `name`=?,`description`=? WHERE `keyUserId`=? AND `id`=?",[$name, $description, $idUser, $idRecipe]);
        return $result;
    }
    public function updateIng($idRecipe, $nameOldIng, $quantityOldIng, $idIng)
    {
        $result=DB::update("UPDATE `ingridients` SET `name`=?,`quantity`=? WHERE `keyRecipeId`=? AND `id`=?",[$nameOldIng, $quantityOldIng, $idRecipe, $idIng]);
        return $result;
    }
    public function deleteRecipe($idRecipe, $idUser)
    {

        DB::delete("DELETE FROM `ingridients` WHERE `keyRecipeId`=?",[$idRecipe]);
        $resultRecipe=DB::delete("DELETE FROM `resipes` WHERE `id`=? AND `keyUserId`=?",[$idRecipe,$idUser]);
       return $resultRecipe;

    }
    public function allReciep()
    {
        $RecipeObject=$id = DB::select("SELECT * FROM `resipes` ");
        return $RecipeObject;
    }
}
