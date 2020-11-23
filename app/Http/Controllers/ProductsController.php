<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;;
 
class ProductsController extends Controller
{
    // 商品頁面
    public function index()
    {
        $products = DB::table('products')
                   ->join('users', 'products.u_id', '=', 'users.u_id')
                   ->where(function($query)
                   {
                       $query->where('p_filename_private', '=', 'public'); 
                   })
                   ->paginate(8);
        return view('shopping.products', compact('products'));
    }//

    // popular人氣商品頁面
    public function popular()
    {
        $products = DB::table('products')
                   ->join('users', 'products.u_id', '=', 'users.u_id')
                   ->where(function($query)
                   {
                       $query->where('p_filename_private', '=', 'public'); 
                   })
                   ->orderBy('p_total', 'desc')
                   ->paginate(8);
        return view('shopping.products', compact('products'));
    }//

    // newproducts最新商品頁面
    public function newproducts()
    {
        $products = DB::table('products')
                   ->join('users', 'products.u_id', '=', 'users.u_id')
                   ->where(function($query)
                   {
                       $query->where('p_filename_private', '=', 'public'); 
                   })
                   ->orderBy('p_id', 'desc')
                   ->paginate(8);
        
        return view('shopping.products', compact('products'));
    }//
 
    // 購物車頁面 
    public function cart()
    {
        return view('shopping.cart');
    }//

    // 加入購物車
    public function addToCart(Request $request,$id)
    {
        
        $buyfbsize = $_POST['buyfbsize'];
        $buyfbcolor = $_POST['buyfbcolor'];
       
        
        $product = Product::find($id);
        
 
        if(!$product) {
 
            abort(404);
 
        }
 
        $cart = session()->get('cart');
 
        // // if cart is empty then this the first product
        
        
        
        if(!$cart) {
                
                $cart = [
                    $id => [
                        "name" => $product->p_name,
                        "buyfbsize" => $buyfbsize,
                        "buyfbcolor"=> $buyfbcolor,
                        "quantity" => 1,
                        "price" => $product->p_price,
                        "photo" => $product->p_photo,
                        "design" => $product->p_filename_design,
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
 

        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id]) ) {
          
            
            
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');


 
        }
 
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $product->p_name,
            "buyfbsize"=>$buyfbsize,
            "buyfbcolor"=>$buyfbcolor,
            "quantity" => 1,
            "price" => $product->p_price,
            "photo" => $product->p_photo,
            "design" => $product->p_filename_design,
            
        ];
 
        session()->put('cart', $cart);
 
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }//

    // 更新購物車商品
    public function update(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
 
            $cart[$request->id]["quantity"] = $request->quantity;
 
            session()->put('cart', $cart);
 
            session()->flash('success', 'Cart updated successfully');
        }
    }//
    
    // 移除購物車商品
    public function remove(Request $request)
    {
        if($request->id) {
 
            $cart = session()->get('cart');
 
            if(isset($cart[$request->id])) {
 
                unset($cart[$request->id]);
 
                session()->put('cart', $cart);
            }
 
            session()->flash('success', 'Product removed successfully');
        }
    }//

    // 前往結帳(判斷是否登入會員)
    public function order()
    {
        if(null!==Auth::user()){ 
            $orderList = Order::all();
            return view('shopping.products_order', compact('orderList'));
        }
        else
        {
            echo"<script>alert('請先登入會員');</script>";
            return view('auth.login');
        }

        
    }//

    

    
}