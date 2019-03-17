<?php
namespace App\Http\Controllers\Api;
use \App\Product;
use \App\Api\apiError;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //instanciando var private 
    private $product;


    //CONSTRUTOR
    public function __construct(Product $product){
        
        $this->product = $product;
    }


    //LISTAR 10 PRODUTOS POR PAGINAS
    Public function index(){

        return response()->json($this->product->paginate(10)); //formatado com Paginação
    }


    //LISTAR UM PRODUTO UNICO PELA ID
    public function show($id){ //Converte em objeto 
       $product = $this->product->where('id', $id)->first();

       if (! $product) return response()->json(ApiError::errorMessage('Produto com id: '. $id . ' não encontrado na base de dados!', 4040), 404);
        
        $data['product'] = $product;

        return view('welcome', $data);
    }


    
    //Buscar LISTA de produtos 
    public function store(Request $request){
        try {
            
            $productData = $request->all();
            $this->product->create($productData);
            return ['data' => ['msg' => 'Produto criado com sucesso!']]; 
            return response()->json($return, 201);

        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao criar o produto!', 1010), 500); //debug desligado
        }
    }



    //Atualizar um produto
    public function update(Request $request, $id){
        try {
            
            $productData = $request->all();
            $product = $this->product->find($id);
            $product->update($productData);

            return ['data' => ['msg' => 'Produto: ' . $id->nome . ' atualizado com sucesso!']]; 
            return respnse()->json($return, 201);
            
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1011), 500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao atualizar o produto!', 1011), 500); //debug desligado
        }
    }



    //Deletar um produto 
    public function destroy(Product $id){
        try {
            
            $id->delete();

            return ['data' => ['msg' => 'Produto: ' . $id->nome . ' apagado com sucesso!']]; 
            return respnse()->json($return, 201);
            
        } catch (\Exception $e) {
            if(config('app.debug')){
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012), 500);
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao deletar o produto!', 1012), 500); //debug desligado
        }
    }
}


