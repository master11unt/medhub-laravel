<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\EducationCategory;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::with('category')->get();
        $categories = EducationCategory::all();
        return view('Admin.Edukasi.indexE', compact('educations', 'categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'type' => 'required|in:artikel,video',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'source' => 'required',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'author_name' => 'required',
            'published_at' => 'required|date',
            'video_url' => 'nullable|url',
            'education_category_id' => 'required|exists:education_categories,id',
        ]);

        $thumbnailPath = null;
        $institutionLogoPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('institution_logo')) {
            $institutionLogoPath = $request->file('institution_logo')->store('institution_logos', 'public');
        }

        Education::create([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'thumbnail' => $thumbnailPath,
            'source' => $request->source,
            'institution_logo' => $institutionLogoPath,
            'author_name' => $request->author_name,
            'published_at' => $request->published_at,
            'video_url' => $request->video_url,
            'education_category_id' => $request->education_category_id,
        ]);

        return redirect()->back()->with('Sukses', 'Data edukasi berhasil ditambahkan.');
    }

    public function delete(Request $request)
    {
        $education = Education::findOrFail($request->id);
        $education->delete();

        return redirect()->back()->with('Delete', 'Data edukasi berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'type' => 'required|in:artikel,video',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'source' => 'required',
            'institution_logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'author_name' => 'required',
            'published_at' => 'required|date',
            'video_url' => 'nullable|url',
            'education_category_id' => 'required|exists:education_categories,id',
        ]);

        $thumbnailPath = $education->thumbnail;
        $institutionLogoPath = $education->institution_logo;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('institution_logo')) {
            $institutionLogoPath = $request->file('institution_logo')->store('institution_logos', 'public');
        }

        $education->update([
            'title' => $request->title,
            'content' => $request->content,
            'type' => $request->type,
            'thumbnail' => $thumbnailPath,
            'source' => $request->source,
            'institution_logo' => $institutionLogoPath,
            'author_name' => $request->author_name,
            'published_at' => $request->published_at,
            'video_url' => $request->video_url,
            'education_category_id' => $request->education_category_id,
        ]);

        return redirect()->back()->with('Sukses', 'Data edukasi berhasil diperbarui.');
    }
}
