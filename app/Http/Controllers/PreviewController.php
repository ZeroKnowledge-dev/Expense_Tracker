<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class PreviewController extends Controller {
	public function index(string $id) {
		$user  = User::findOrFail($id);
		$items = $user->items()->get();
		return Inertia::render('Preview', [
			'user'  => $user,
			'items' => $items,
		]);
	}
}
