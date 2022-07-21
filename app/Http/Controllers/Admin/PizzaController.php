<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{


    // direct to admin pizza page
    public function pizza()
    {
        $pizza = Pizza::paginate(4);

        if(count($pizza) == 0){
            $emptyStatus =0;

        }else{
            $emptyStatus = 1;
        }
        return view(('admin.pizza.list'))->with(['pizza' => $pizza,'status'=>$emptyStatus]);
    }
    //  direct to create piza page
    public function createPizza()
    {
        $category = Category::get();
        return view('admin.pizza.create')->with(['category' => $category]);
    }

    // insert pizza data
    public function insertPizza(Request $request)
    {


        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'image'=>'required',
            'price'=>'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'buyOneGetOne'=>'required',
            'watingTime'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }


        $file = $request->file('image');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->move(public_path() . '/uploads/', $fileName);


        $data = $this->requestPizzaData($request, $fileName);
        Pizza::create($data);
        return redirect()->route('admin#pizza')->with(['createPizza' => 'Pizza Added...']);
    }

    // delete pizza
    public function deletePizza($id)
    {
        $data = Pizza::select('image')->where('pizza_id', $id)->first();
        $fileName = $data['image'];

        Pizza::where('pizza_id', $id)->delete();  //db delete

        // project delete
        if (File::exists(public_path().'/uploads/'.$fileName)) {
            File::delete(public_path() . '/uploads/' . $fileName);

        }
        return back()->with(['deleteSuccess' => 'Pizza delelted...']);

    }


    // pizza info
    public function pizzaInfo($id){
        $data = Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.info')->with(['info'=>$data]);

    }

    // edit Pizza
    public function editPizza($id){
        $category = Category::get();
        $data = Pizza::select('pizzas.*','categories.category_id','categories.category_name')
        ->join('categories','categories.category_id','pizzas.category_id')
        ->where('pizza_id',$id)
        ->first();
        return view('admin.pizza.edit')->with(['pizza'=>$data,'category'=>$category]);
    }

    // update Pizza
    public function updatePizza($id,Request $request){
        $validator = Validator::make($request->all(),[
            'name' =>'required',
            'price'=>'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'buyOneGetOne'=>'required',
            'watingTime'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails()){
            return back()
            ->withErrors($validator)
            ->withInput();
        }


        $updateData =[
            'pizza_name' => $request->name,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'wating_time' => $request->watingTime,
            'description' => $request->description,

        ];

        if(isset($request->image)){
            $updateData['image']=$request->image;

         }

         if(isset($updateData['image'])){
             //get old image name
             $data = Pizza::select('image')->where('pizza_id', $id)->first();
             $fileName = $data['image'];

            //  delete old image
             if (File::exists(public_path().'/uploads/'.$fileName)) {
                 File::delete(public_path() . '/uploads/' . $fileName);

             }

            //  get new image data
            $file = $request->file('image');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/', $fileName);
            $updateData['image']=$fileName;


         }
            //update
            Pizza::where('pizza_id',$id)->update($updateData);
            return redirect()->route('admin#pizza')->with(['updateSuccess'=>'Pizza Updated..']);



    }

    // search pizza data
    public function searchPizza(Request $request){
        $searchKey = $request->table_search;
        $searchData = Pizza::orWhere('pizza_name','like','%'.$searchKey.'%')
                            ->orWhere('price','like','%'.$searchKey.'%')
                            ->paginate(4);

                            $searchData->append($request->all());


        if(count($searchData) == 0){
            $emptyStatus =0;

        }else{
            $emptyStatus = 1;
        }
        return view(('admin.pizza.list'))->with(['pizza' => $searchData,'status'=>$emptyStatus]);


    }

    // look category item
    public function categoryItem($id){
        $data = Pizza::select('pizzas.*','categories.category_name as categoryName')
                ->join('categories','categories.category_id','pizzas.category_id')
                ->where('pizzas.category_id',$id)
                ->paginate(2);

                return view('admin.category.item')->with(['pizza'=>$data]);
    }








    // request pizza data
    private function requestPizzaData($request,$fileName){

        return [
            'pizza_name' => $request->name,
            'image' => $fileName,
            'price' => $request->price,
            'publish_status' => $request->publish,
            'category_id' => $request->category,
            'discount_price' => $request->discount,
            'buy_one_get_one_status' => $request->buyOneGetOne,
            'wating_time' => $request->watingTime,
            'description' => $request->description,
        ];

    }





}



