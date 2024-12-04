
public function getCartCount()
{
    $user = auth()->user();
    if (!$user) {
        return response()->json(['count' => 0]);
    }
    
    $count = Cart::where('user_id', $user->id)->sum('quantity');
    return response()->json(['count' => $count]);
}

