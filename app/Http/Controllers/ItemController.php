<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		return Inertia::render('Item/Index', [
			'user'   => User::findOrFail(auth()->user()->id),
			'items'  => Item::where('user_id', auth()->user()->id)->get(),
			'appURL' => env('APP_URL'),
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		return Inertia::render('Item/Create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {
		// Get the authenticated user's ID
		$user_id = auth()->user()->id;

		// Validate the other fields without including user_id
		$validated = $request->validate([
			'name'   => 'required',
			'amount' => 'required',
			'date'   => 'required',
			'type'   => 'required',
		]);

		// Add the user_id to the validated data array
		$validated['user_id'] = $user_id;

		// Create the new item
		Item::create($validated);

		// Redirect to the items index page
		return redirect()->route('items.index');
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $id) {
		$item = Item::findOrFail($id);

		return Inertia::render('Item/Show', [
			'item' => $item,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(string $id) {
		$item = Item::findOrFail($id);
		return Inertia::render('Item/Edit', [
			'item' => $item,
		]);
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, string $id) {
		$validated = $request->validate([
			'name'   => 'required',
			'amount' => 'required',
			'date'   => 'required',
			'type'   => 'required',
		]);

		$item = Item::findOrFail($id);
		$item->update($validated);
		return redirect()->route('items.index');
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(string $id) {
		$item = Item::findOrFail($id);
		$item->delete();
		return redirect()->route('items.index');
	}
}
