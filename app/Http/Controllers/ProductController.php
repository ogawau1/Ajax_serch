<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::filter($request)->paginate(5)->appends($request->all());
    
        if ($request->ajax()) {
            return response()->json(view('products.product_list', compact('products'))->render());
        }
    
        return view('products.index', ['products' => $products, 'companies' => Company::all()]);
    }

    public function create()
    {
        $companies = Company::all();

        return view('products.create', compact('companies'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_name' => 'required',
                'company_id' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'comment' => 'nullable',
                'img_path' => 'nullable|image|max:2048',
            ]);

            $product = new Product([
                'product_name' => $request->get('product_name'),
                'company_id' => $request->get('company_id'),
                'price' => $request->get('price'),
                'stock' => $request->get('stock'),
                'comment' => $request->get('comment'),
            ]);

            if($request->hasFile('img_path')){ 
                $filename = $request->img_path->getClientOriginalName();
                $filePath = $request->img_path->storeAs('products', $filename, 'public');
                $product->img_path = '/storage/' . $filePath;
            }

            $product->save();

            return redirect('products')->with('success', 'Product created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create product.']);
        }
    }

    public function show(Product $product)
    {
        return view('products.show', ['product' => $product]);

    }

    public function edit(Product $product)
    {
        $companies = Company::all();

        return view('products.edit', compact('product', 'companies'));
    }

    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'product_name' => 'required',
                'price' => 'required',
                'stock' => 'required',
                'comment' => 'nullable',
                'img_path' => 'nullable|image|max:2048',
                'company_id' => 'required',
            ]);

            $product->update([
                'product_name' => $request->product_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'company_id' => $request->company_id,
            ]);

            if ($request->hasFile('img_path')) {
                $filename = $request->img_path->getClientOriginalName();
                $filePath = $request->img_path->storeAs('products', $filename, 'public');
                $product->img_path = '/storage/' . $filePath;
                $product->save();
            }

            return redirect()->route('products.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update product.']);
        }
    }
    

    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['success' => true, 'message' => 'Product deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to delete product.'], 500);
        }
    }

}