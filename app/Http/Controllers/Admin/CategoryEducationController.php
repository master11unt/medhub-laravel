<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryEducationController extends Controller
{
    public function index()
    {
        $categories = EducationCategory::all();
        return view('Admin.Category.indexC', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ]);

        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('category_icons', 'public');
        }

        EducationCategory::create([
            'name' => $request->name,
            'icon' => $iconPath,
        ]);

        return redirect()->back()->with('Sukses', 'Kategori edukasi berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $category = EducationCategory::findOrFail($request->id);
        $category->delete();

        return redirect()->back()->with('Delete', 'Kategori edukasi berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $category = EducationCategory::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'icon' => 'nullable|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ]);

        $iconPath = $category->icon;
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($iconPath) {
                Storage::disk('public')->delete($iconPath);
            }
            $iconPath = $request->file('icon')->store('category_icons', 'public');
        }

        $category->update([
            'name' => $request->name,
            'icon' => $iconPath,
        ]);

        return redirect()->back()->with('Sukses', 'Kategori edukasi berhasil diperbarui.');
    }
}
