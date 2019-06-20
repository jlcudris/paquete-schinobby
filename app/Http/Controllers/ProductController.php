<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    function __construct()
    {
        $this->middleware('permission1:products.index')->only('index');
        $this->middleware('permission1:products.show')->only('show');
        $this->middleware('permission1:products.store')->only('store');
        $this->middleware('permission1:products.edit')->only('update');
        $this->middleware('permission1:products.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::paginate(10);

        return response()->json(['Productos'=>$product],200);


    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator=\Validator::make($request->all(),[

            'name' => 'required',
            'descripcion' => 'required',

        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }
        else
        {
            $product = new Product;
            $product->name = $request->name;
            $product->description = $request->descripcion;
            $product->save();

            return response()->json(['SuccesProduct'=>'Producto creado con exito','id'=>$product->id],200);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if($product){

            return response()->json(['Producto'=>$product],200);

        }else{
            return response()->json(['Noexiste'=>'el producto no existe '],200);
        }


    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

 $validator=\Validator::make($request->all(),[

            'name' => 'required',
            'descripcion' => 'required',

        ]);
        if($validator->fails())
        {
          return response()->json( ['message' => $validator->errors()->all()],400 );
        }
        else
        {
            $product = Product::find($id);
        if($product){

            $product->name= $request->name;
            $product->description= $request->descripcion;
            $product->save();

            return response()->json(['ProductoActualizado'=>'El producto ha sido actualizado exitosamente'],200);


        }else{
            return response()->json(['Noexiste'=>'el producto qie intemntas actualizar no existe '],200);
        }


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return response()->json(['Producto_eliminado'=>'el Producto ha sido eliminado exitosamente']);
        }
        else{
            return response()->json(['Erroreliminado'=>'el Producto que desea eliminar no ha sido encontrado']);
        }
    }
}
