<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Repositories\ItemsDb;
use App\Repositories\AbilityDb;
use Illuminate\Http\Request;

class ItemController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$itemSecret = Item::ofType('secret_shop')->get();
		$itemComponent = Item::ofType('component')->get();
		$itemConsumable = Item::ofType('consumable')->get();
		$itemRare = Item::ofType('rare')->get();
		$itemEpic = Item::ofType('epic')->get();
		$itemArtifact = Item::ofType('artifact')->get();
		// return view('item',compact('itemObj'));
	}

}
