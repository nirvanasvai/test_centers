<?php

namespace App\Http\Livewire;

use App\Http\Requests\ProductRequest;
use App\Models\Product as Product_model;
use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Component;

class Product extends Component
{
    public $name, $description, $product_edit;
    public $paginate = 10, $category_id, $category_filter, $search, $orderBy;
    public $isOpen = 0;

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Введите название.',
        'email.email' => 'Введите описание.',
    ];

    protected $validationAttributes = [
        'name' => 'name',
        'description' => 'description',
    ];

    public function render()
    {
        $search = '%' . $this->search . '%';
        $object = Product_model::first();
        $categories = Category::orderBy('title', 'DESC')
            ->get();
        $products = Product_model::query();
        if ($this->orderBy == 2) {
            $products->orderBy('name', 'desc');
        } else {
            $products->orderBy('name');
        }
        if ($this->category_filter) {
            $products->when($this->category_filter, function ($query) {
                $query->where('category_id', $this->category_filter);
            });
        }
        if ($this->search) {
            $products->where('name', 'LIKE', $search);

        }
        $products = $products->paginate($this->paginate);

        return view('admin.livewire.product', compact('categories', 'products'));
    }

    public function create()
    {
        $this->validate();

        Product_model::query()->updateOrCreate(['id' => $this->product_edit], [
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
        ]);
        $this->resetInput();

    }

    public function edit($id)
    {
        $products = Product_model::query()->findOrFail($id);
        $this->product_edit = $products->id;
        $this->name = $products->name;
        $this->description = $products->description;

    }

    public function destroy($id)
    {
        Product_model::query()->find($id)->delete();
    }

    public function resetInput()
    {
        $this->name = null;
        $this->description = null;

    }

    public function closeModal()
    {
        $this->isOpen = false;
    }
}
