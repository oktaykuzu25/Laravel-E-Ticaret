<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;


class ShoppingController extends Controller
{
    public function index()
    {
        $items = ShoppingCart::all();
        $total = ShoppingCart::totalPrice();
        return view('cart', compact('items', 'total'));
    }
    public function addtocart($id)
    {
        $book = Book::notDeleted()->findOrFail($id);

        ShoppingCart::add(
            $book->id,
            $book->name,
            1,
            $book->price,
            []
        );

        return redirect()->route('shopping.index');
    }
    public function removefromcart($rawId)
    {
        ShoppingCart::remove($rawId);
        return redirect()->route('shopping.index');
    }
    public function updatecart(Request $request, $rawId)
    {
        $qty = (int) $request->input('qty', 1);
        if ($qty < 1) {
            ShoppingCart::remove($rawId);
        } else {
            ShoppingCart::update($rawId, ['qty' => $qty]);
        }
        return redirect()->route('shopping.index');
    }
    public function increase($rawId)
    {
        $item = ShoppingCart::get($rawId);
        if ($item) {
            ShoppingCart::update($rawId, ['qty' => $item->qty + 1]);
        }
        return redirect()->route('shopping.index');
    }
    public function decrease($rawId)
    {
        $item = ShoppingCart::get($rawId);
        if ($item) {
            $newQty = $item->qty - 1;
            if ($newQty < 1) {
                ShoppingCart::remove($rawId);
            } else {
                ShoppingCart::update($rawId, ['qty' => $newQty]);
            }
        }
        return redirect()->route('shopping.index');
    }
}
