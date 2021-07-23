<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Category as Category_model;

class Category extends Component
{
    public $title,$category_id,$category_edit,$isOpen = 0;

    public function render(Request $request)
    {
        $requestData = $request->all();
        if(isset($requestData['category_id'])){
            $categories = Category_model::where('category_id', $requestData['category_id'])->orderBy('category_id', 'ASC')->paginate(10);
            $category_id = $requestData['category_id'];
        }else{
            $categories = Category_model::whereNull('category_id')->orderBy('category_id', 'ASC')->paginate(10);
            $category_id = false;
        }
        return view('admin.livewire.category',compact('categories','category_id'));
    }


    public function create()
    {
        $this->validate([
            'title'=>'required|string|min:2|max:100'
        ]);

        Category_model::query()->updateOrCreate(['id'=>$this->category_edit],[
            'title'=>$this->title,
            'category_id'=>$this->category_id
        ]);
        $this->closeModal();
        $this->resetInput();

    }

    public function edit($id)
    {
      $category = Category_model::query()->findOrFail($id);
      $this->category_edit = $category->id;
      $this->title = $category->title;
      $this->category_id = $category->category_id;

    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $product = Product::where('category_id', $id)->get();
        if($product->count() > 0){
            return back()
                ->with('warning', 'Сначала необходимо удалить все товары категории!');
        }
        if($category->category_id){
            $product = Product::where('category_id', $id)->get();
            if($product->count() > 0){
                return back()
                    ->with('warning', 'Сначала необходимо удалить все товары категории!');
            }else{
                if($category->delete()){
                    return back()
                        ->with('success', 'Категория удалена!');
                }
            }
        }else{
            $sub_category = Category::where('category_id', $id)->get();
            if(isset($sub_category[0]->id)){
                return back()
                    ->with('warning', 'Сначала необходимо удалить под категории!');
            }else{
                if($category->delete()){
                    return back()
                        ->with('success', 'Категория удалена!');
                }
            }
        }
    }

    public function resetInput()
    {
        $this->title = null;
        $this->category_id = null;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
