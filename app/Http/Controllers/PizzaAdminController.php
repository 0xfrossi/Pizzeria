<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Pizza;
class PizzaAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $dl= new DataLayer();  
       $pizzaList= $dl->listPizzas(); 
       
        return view('AdminSection.adminPizze')->with('pizzaList',$pizzaList);
   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $pizza= 'Nuova pizza';
         $dl= new DataLayer(); 
         $ingredientList= $dl->listIngDisponibili();
        return view('AdminSection.createItem')->with('nuovo_elem', $pizza)->with('listaIngr', $ingredientList);
   
    }

    
    public function store(Request $request)
    {
        
          
        $validatedData = request()->validate([ 
            'name'=>'required | string |max: 50| unique:App\Models\Pizza,nome',
            'prezzo'=>'required| numeric | gt:1',         
           // 'selezioneIngr' => 'required ',             
                    ]);
          
          
          
       $pizza = new Pizza();
       $pizza->nome = $request->input('name');
       $pizza->prezzo = $request->input('prezzo');
       $pizza->save();

       $arrivo= $request->input('selezioneIngr');
      
    //   $integerIDs = array_map('intval', explode(',', $arrivo));  no
       
       $myArray = array();
      $number = explode(",", $arrivo);
      foreach ($number as $elemento){
         array_push($myArray, intval($elemento));
      } 
         $pizza->Ingredients()->attach( $myArray); 
        
       return redirect()->route('admin.pizzas.index')->withSuccess('  Operazione completata con successo!');
     //   return var_dump($request->input('selezioneIngr') );
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
   /* public function store(Request $request)
    {
      $dl= new DataLayer();
      $dl->add
        
        return Redirect::to(route('pizzas.index'));
    }
  */
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
     * @param  Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function edit(Pizza $pizza)
    {
       return view('AdminSection.editItem')->with('pizza', $pizza);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Pizza $pizza    
     * @return \Illuminate\Http\Response
     */
    public function update(Pizza $pizza ,Request $request)
    {
          request()->validate([
            'prezzo'=>'required | numeric | gt:1',         
                    ]);
          
    /*     if ($request->input('prezzo') === null) { 
            return redirect()->route('pizzas.index');
        }   */
          
          $dl= new DataLayer();
          $dl->editPizzaPrice($pizza, $request->input('prezzo'));
          
          return Redirect()->route('admin.pizzas.index')->withSuccess('  Operazione completata con successo!');
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
        $pizza = $dl->findPizzaById($id);
       // foreach($pizza->Ingredients as $ing){
       
       $pizza->Ingredients()->detach();
       
       $dl->deletePizza($id);
        
        return Redirect()->back();
    } */
    
     public function destroy($id)
    {
        $dl = new DataLayer();
        $pizza = $dl->findPizzaById($id);
       // foreach($pizza->Ingredients as $ing){
       
       $pizza->Ingredients()->detach();
       
       $dl->deletePizza($id);
        $list= $dl->listPizzas();
         return response()->json( ['esito' => 1, 'id' => $id, 'numElem'=> count($list)]);
    }
    
    
    
     public function cambiaDisponibilita(Request $request) {
        
        $data = new DataLayer(); 
        $idP = $request->id;
        //$idP=$_GET["id"];
        $pizza = $data ->findPizzaById($idP);
        if($pizza->is_delete==1){
         $pizza->is_delete=0;
        $pizza->save();
        }
        else{
            $pizza->is_delete=1;
            $pizza->save();
        }
        //echo  $idP;
        //return response()->json(['sta' => $pizza->is_delete]);
        return response()->json(['sta' => "ciao"]);
    }
   
}
