<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use DB;
use App\Sale;
use App\Item;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Adding any item in cart
    public function addToCart(Request $r) {
       $item = new Item();
        // $custID = $r->custID;
        $itemID = $r->itemID;
        $itemName = $r->itemName;
        $itemPrice = $r->itemPrice;
        $itemQty = $r->itemQty;
        $InStock = DB::table('items')->select('quantity')->where('item_id', $itemID)->value('quantity');
        $taxable = DB::table('items')->select('taxable')->where('item_id', $itemID)->value('taxable');
        if ($InStock > 0) {
            if ($taxable == "No") {
                Cart::add([
                    'id' => $itemID,
                    'name' => $itemName,
                    'price' => $itemPrice,
                    'qty' => $itemQty
                ]);
                //decrease quantity of inventory when items sold
            // DB::table('items')->where('item_id', $itemID)->decrement('quantity', $itemQty);
                DB::table('items')->where('item_id', $itemID)->update(['quantity'=>DB::raw('GREATEST(quantity - '.$itemQty.', 0)')]);
                return response()->json([
                    'readonly' => 'readonly'
                ]);
            } elseif($taxable == "Yes") {
                Cart::add([
                    'id' => $itemID,
                    'name' => $itemName,
                    'price' => $itemPrice,
                    'qty' => $itemQty
                ]);
                //decrease quantity of inventory when items sold
            // DB::table('items')->where('item_id', $itemID)->decrement('quantity', $itemQty);
                DB::table('items')->where('item_id', $itemID)->update(['quantity'=>DB::raw('GREATEST(quantity - '.$itemQty.', 0)')]);
            }
            
           
        } else {
            return response()->json([
                'stock_msg' => 'No '.$itemName.' existing in stock, please add first.',
            ]);
        }
       
    }
    // To remove an item from the cart
    public function removeItem(Request $request) {
        Cart::remove($request->itemID);
    }
}
