<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stray;
use App\Models\Area;
use App\Models\Pet_Category;
use App\Models\Pet_subcategory;

class StrayController extends Controller
{
    public function create()
    {
        $areas = Area::all();
        $categories = Pet_category::all();
        $pet_subcategories = Pet_subcategory::all();
        $genderOptions = [
            'male' => 'オス',
            'female' => 'メス',
            '' => '未指定'
        ];

        return view('strays.create_stray', compact('areas', 'categories', 'pet_subcategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|integer',
            'accountname' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
            'address_detail' => 'required|string',
            'date' => 'required|date',
            'select_pettype2' => 'required|exists:pet_subcategories,id',
            'petssex' => 'nullable|string',
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'introduce' => 'nullable|string|max:280',
        ]);

        $stray = new Stray();
        $stray->status = $validated['status'];
        $stray->name = $validated['accountname'];
        $stray->area_id = $validated['area_id'];
        $stray->address = $validated['address_detail'];
        $stray->date = $validated['date'];
        $stray->pet_subcategory_id = $validated['select_pettype2'];
        $stray->sex = $validated['petssex'];
        $stray->age = $validated['age'];
        $stray->weight = $validated['weight'];
        $stray->height = $validated['height'];
        $stray->body = $validated['introduce'];
        $stray->user_id = auth()->id(); 
        $stray->save();

        return redirect()->route('strays.index')->with('success', '投稿が完了しました！');
    }

    public function update(Request $request, $id)
    {
        $stray = Stray::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|boolean',
            'accountname' => 'required|string|max:255',
            'address' => 'required|string',
            'date' => 'required|date',
            'select_pettype2' => 'required|exists:pet_subcategories,id',
            'petssex' => 'nullable|string',
            'age' => 'nullable|integer',
            'weight' => 'nullable|numeric',
            'height' => 'nullable|numeric',
            'introduce' => 'nullable|string|max:280',
        ]);

        $stray->update($validated);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $stray->photo = $path;
        }

        return redirect()->route('strays.index')->with('success', '情報を更新しました！');
    }

    public function destroy($id)
    {
        $stray = Stray::findOrFail($id);
        $stray->delete();

        return redirect()->route('strays.index')->with('success', '情報を削除しました！');
    }
}
