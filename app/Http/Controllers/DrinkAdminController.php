<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Drink;
class DrinkAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dl= new DataLayer();  
       $drinksList= $dl->listDrinks(); 
        return view('AdminSection.adminDrinks')->with('drinksList',$drinksList);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $drink= 'Nuova bevanda';
        return view('AdminSection.createItem')->with('nuovo_elem', $drink);
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $dl= new DataLayer();
     //   $dl->addDrink($request->input('name'),$request->input('prezzo'), Helper::IDGenerator(new Drink, 'id'));
        
  
       $validatedData = request()->validate([
            'name'=>'required | string | max:20 | unique:App\Models\Drink,nome', 
            'prezzo'=>'required | numeric | max:20 | gt:0',         
               
              
                    ]);
       
        $drink= new Drink();
        $drink->nome = ucfirst($request->input('name'));
        $drink->prezzo = $request->input('prezzo');
        $drink->drnk_id = Helper::IDGenerator( 'drnk_id','DRNK' ,4);
     
        $drink->save();
        return redirect()->route('admin.drinks.index')->withSuccess('  Operazione completata con successo!');;
   
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
     * @param Drink  $drink
     * @return \Illuminate\Http\Response
     */
    public function edit(Drink $drink)
    {
       // $dl= new DataLayer();
       // $drink= $dl->findDrinkById($id);
        return view('AdminSection.editItem')->with('drink', $drink);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Drink $drink
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Drink $drink, Request $request)
    {
     //   ucfirst($request->input('name'))->validate(['name'=>'required | string | unique:App\Models\Drink,nome'. $drink->id]); 
        request()->validate([
            'name'=>'required | string | unique:App\Models\Drink,nome,'. $drink->id, 
            'prezzo'=>'required | numeric | gt:0',         
               
              
                    ]);
      /*  if ($request->input('prezzo') === null) { 
            return redirect()->route('admin.drinks.index');
        } */
          $dl= new DataLayer();
          $dl->editDrinkPrice($drink, $request->input('prezzo'));
          return Redirect()->route('admin.drinks.index')->withSuccess('  Operazione completata con successo!');
         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  /*  public function destroy($id)
    {
        $dl = new DataLayer();
      
       $dl->deleteDrink($id);
       
        return Redirect()->route('admin.drinks.index');
  
    } */
    
    public function destroy($id)
    {
      $dl = new DataLayer();
     // $id=$request->$id;
      
      $dl->deleteDrink($id);
      $listDrinks=$dl->listDrinks();
       
     return response()->json( ['esito' => 1, 'id' => $id, 'numElem'=> count($listDrinks)]); 
  
    } 
    
   
}
