<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class SuccessStoryController extends Controller
{
    public function index()
    {
        $successStories = SuccessStory::latest()->paginate(10);

        return view('admin.success-stories.index', compact('successStories'));
    }

    public function create()
    {
        return view('admin.success-stories.create');
    }

    public function store(Request $request)
    {
        SuccessStory::create($this->validatedData($request));

        return redirect()->route('admin.success-stories.index')
            ->with('success', 'Success story created successfully.');
    }

    public function show($id)
    {
        $successStory = SuccessStory::findOrFail($id);

        return view('admin.success-stories.show', compact('successStory'));
    }

    public function edit($id)
    {
        $successStory = SuccessStory::findOrFail($id);

        return view('admin.success-stories.edit', compact('successStory'));
    }

    public function update(Request $request, $id)
    {
        $successStory = SuccessStory::findOrFail($id);
        $successStory->update($this->validatedData($request));

        return redirect()->route('admin.success-stories.index')
            ->with('success', 'Success story updated successfully.');
    }

    public function destroy($id)
    {
        SuccessStory::findOrFail($id)->delete();

        return redirect()->route('admin.success-stories.index')
            ->with('success', 'Success story deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'youtube_url' => 'required|url|max:2048',
            'note' => 'nullable|string',
        ]);
    }
}
