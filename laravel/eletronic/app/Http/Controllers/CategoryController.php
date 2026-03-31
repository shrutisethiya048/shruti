<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Category list
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }

    // Store category
    public function store(Request $request)
    {
       // $request->validate([
            //'name' => 'required',
            //'image' => 'required|image|mimes:jpg,png,jpeg'
       // ]);
        $data = new Category();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->status = $request->status;

        if ($request->hasFile('image')) {
            $img = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/categories'), $img);
            $data->image = $img;
        }

        $data->save();

        return redirect()->back()->with('success', 'Category Added Successfully');
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path('upload/categories/'.$category->image))) {
                unlink(public_path('upload/categories/'.$category->image));
            }

            $img = time().'.'.$request->image->extension();
            $request->image->move(public_path('upload/categories'), $img);
            $category->image = $img;
        }

        $category->save();

        return redirect()->back()->with('success', 'Category Updated Successfully');
    }

    // Change status (Active / Inactive)
    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->status = $category->status == 1 ? 0 : 1;
        $category->save();

        return redirect()->back()->with('success', 'Status Updated Successfully');
    }

    // Delete category
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        // Delete image file
        if ($category->image && file_exists(public_path('upload/categories/'.$category->image))) {
            unlink(public_path('upload/categories/'.$category->image));
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category Deleted Successfully');
    }
}
