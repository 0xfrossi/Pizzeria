<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Ingredient;
class IngredientAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dl= new DataLayer();  
       $ingredientList= $dl->listIngredients(); 
     
        return view('AdminSection.adminIngredienti')->with('ingredientList',$ingredientList);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $ing= 'Nuovo ingrediente';
        return view('AdminSection.createItem')->with('nuovo_elem', $ing);
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validatedData = request()->validate(['name'=>'required | alpha | max:20 |unique:App\Models\Ingredient,nome']);
        
         
        $dl= new DataLayer();
        $dl->addIngredient( ucfirst($request->input('name')));
        $successo=1;
        return redirect()->route('admin.ingredients.index')->withSuccess('  Operazione completata con successo!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
        }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function checkIngredientUsed(Request $request) {
          $dl = new DataLayer();
     //  return print_r($_GET["data"]);
    
     if ($dl->ingredientIsUsed($request->data)) {
            return 'esiste';
        } else {
            return response()->json( ['stato' => 'cancella', 'num' => $request->data]) ;
        }
    }
     
  /*  public function destroy($id)
    {
      $dl = new DataLayer();
     if($dl->ingredientIsUsed($id)){
         $usato=true;
         return  redirect()->route('admin.ingredients.index')->with('usato', $usato);
     }else{
       $dl->deleteIngredient($id);  
       return Redirect()->back();
     }
    }*/
    
     public function destroy($id)
    {
      $dl = new DataLayer();     
       $dl->deleteIngredient($id);  
       $listing=$dl->listIngredients();
       
     return response()->json( ['esito' => 1, 'id' => $id, 'numElem'=> count($listing)]);
     
    }
    
    
}
