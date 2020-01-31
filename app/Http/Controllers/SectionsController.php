<?php

namespace App\Http\Controllers;

use App\Section;
use App\User;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    /**
     * Sections list view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $sections = Section::with('users')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('name')->get();

        return view('sections.create', compact('users'));
    }

    /**
     * Stores new section
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'nullable|string',
            'users' => 'nullable|array|exists:users,id',
            'logo' => 'nullable|image'
        ]);
        $section = Section::create($request->only(['name', 'description']));
        $section->users()->sync($request->input('users', []));
        if ($request->hasFile('logo')){
            $section->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        return redirect()->route('sections.index')->with('success', "Section $section->name created");
    }

    /**
     * Shows section edit form
     *
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Section $section)
    {
        $users = User::orderBy('name')->get();
        $section->load('users');
        return view('sections.edit', compact('section', 'users'));
    }

    /**
     * Updates section by edit form
     *
     * @param Request $request
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Section $section)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
            'description' => 'nullable|string',
            'users' => 'nullable|array|exists:users,id',
            'logo' => 'nullable|image'
        ]);
        $section->update($request->only(['name', 'description']));
        $section->users()->sync($request->input('users', []));
        if ($request->hasFile('logo')){
            $section->addMediaFromRequest('logo')
                ->toMediaCollection('logo');
        }

        return redirect()->route('sections.index')->with('success', "Section $section->name was updated");
    }

    /**
     * Deletes section
     *
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        $section_name = $section->name;
        $section->delete();

        return redirect()->back()->with('success', "Section $section_name was deleted");
    }
}
