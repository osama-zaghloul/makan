<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\setting;
use App\order;
use App\order_item;
use App\ordertrash;
use DB;

class cartController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // foreach($orders as $order)
        // {
        //     $order->delete();
            
        // }
        $cartitems = session('shopping_cart') ? session('shopping_cart')['items'] : [];
        return view('front.cart.index',compact('cartitems'));
    }

    public function checkout(Request $request)
    {
        // if(session('shopping_cart'))
        // {
        //     $cartitems = session('shopping_cart')['items'];
        //     $carttotal = session('shopping_cart')['total'];
        //     $cartitems = session('shopping_cart')['items']; 
        //     $count=0;
        //     foreach($cartitems as $key => $cartitem)
        //         {
                    
        //             $count= $count + $cartitem['qty'] ;
        //         }
        //     // if($carttotal >= 200)
        //     // {
        //         return view('front.cart.checkout',compact('cartitems','carttotal','count'));
        //     // }
        //     // else 
        //     // {
        //     //     $errormessage = session('locale') == 'en' ? 'Minimum purchase: 200 SAR' : 'الحد الادنى للشراء : 200 ريال';
        //     //     session()->flash('error', $errormessage);
        //     //     return back();
        //     // }
        // }
        // else 
        // {
        //     return back();  
        // } 
            if(Input::has('store'))
            {
                // $orderarr = array();
            //    $inputs = Input::all();
             ordertrash::where('user_id',auth()->user()->id)->delete();
               $item_ids = Input::get('item_id');
               $prices = Input::get('price');
               $qtys = Input::get('quantity');
     for ($i = 0; $i < count($qtys); $i++) {
                $newordertrash = new ordertrash();  
                $newordertrash->user_id = auth()->user()->id ;
                $newordertrash->item_id =$item_ids[$i];
                $newordertrash->price = $prices[$i];
                $newordertrash->qty =$qtys[$i];
                $newordertrash->save();
}
               

                $orders = ordertrash::where('user_id',auth()->user()->id)->get();

                return view('front.cart.checkout',compact('orders'));
            }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Input::has('confirmcheckout'))
        {
                $setting = setting::first();
                $shipping = $setting->shipping;
                $shipping_item = $setting->shipping_item;
                $tax = $request->tax;
                $count = $request->count;
                $neworder                = new order;
                $neworder->order_number  = date('dmY').rand(0,999);
                $neworder->user_id       = Auth()->user()->id;
               
                if($request->shipping_method==0)
                {
                $neworder->shipping   ='تكلفة ثابتة للشحن' ;
                $neworder->total      = $request->total + $shipping +$tax;
                $neworder->shipping_price = 250;

                }
                elseif($request->shipping_method==1)
                {
                $neworder->shipping   ='قيمة الشحن للقطعة ' ;
                $neworder->total      = $request->total + ($count*$shipping_item) + $tax ;
                $neworder->shipping_price = ($count*$shipping_item);
                }
                else
                {
                 $neworder->shipping   ='تسليم يد بيد';  
                 $neworder->total      = $request->total + $tax;
                 $neworder->shipping_price = 0;
                }
                $neworder->tax    = $tax;
                $neworder->details    = $request->details;
               
                
                $neworder->paid       = $request->payment_method;
                $neworder->save();

                $orders = ordertrash::where('user_id',auth()->user()->id)->get();
                foreach($orders as $order)
                {
                    $neworderitem           = new order_item();
                    $neworderitem->order_id = $neworder->id;
                    $neworderitem->item_id  =$order->item_id ;   
                    $neworderitem->qty      = $order->qty;  
                    $neworderitem->price    = $order->price;  
                    $neworderitem->save();                 
                }
                session()->forget('shopping_cart');
                ordertrash::where('user_id',auth()->user()->id)->delete();
                
                if($request->payment_method==0)
                {
                    $successmessage = session('locale') == 'en' ? 'The request was made successfully ' : 'تم عمل الطلب بنجاح  ';
                return view('front.cart.finishedcheckout',compact('successmessage'));   
                }
                if($request->payment_method==1)
                {
                    $successmessage = session('locale') == 'en' ? 'The request was made successfully and please send the bank transfer ' : 'تم عمل الطلب بنجاح وبرجاء إرسال صورة التحويل البنكى      ';
                    return view('front.cart.finishedcheckout',compact('successmessage'));
                }             
            }
       
            if(session('shopping_cart'))
            {
               $shopping_cart   = session('shopping_cart');
                $cartitems       = session('shopping_cart')['items'];
                foreach($cartitems as $key => $cartitem)
                {
                    if($request->item_id == $cartitem['item_id'])
                    { 
                        $cartitem['qty']                = $cartitem['qty'] + $request->qty ;
                        $cartitem['price']              = $cartitem['price']  ;
                        $cartitems[$key]                = $cartitem;
                        $shopping_cart['items']         = $cartitems;
                        $shopping_cart['cartcount']     = session('shopping_cart')['cartcount'];  
                        $shopping_cart['total']         = session('shopping_cart')['total'] + ($request->price * $request->qty); 
                        session()->put('shopping_cart',$shopping_cart);
                        return response()->json($shopping_cart);
                    }
                }
                
                $count           = count(session('shopping_cart')['items']); 
                $item_array      = array(  
                    'item_id'    =>  $request->item_id,  
                    'price'      =>  $request->price,  
                    'qty'        =>  $request->qty,  
                ); 
                
                $shopping_cart['items'][$count] = $item_array;
                $shopping_cart['cartcount']     = session('shopping_cart')['cartcount'] +1;  
                $shopping_cart['total']         = session('shopping_cart')['total'] + ($request->price * $request->qty); 
                session()->put('shopping_cart',$shopping_cart);
                return response()->json($shopping_cart);
            }
            else 
            {  
                $shopping_cart = array();
                $item_array    = array(  
                    'item_id'    =>  $request->item_id,  
                    'price'      =>  $request->price,  
                    'qty'        =>  $request->qty, 
                ); 
    
                $shopping_cart['items'][0]     = $item_array; 
                $shopping_cart['cartcount']    = 1; 
                $shopping_cart['total']        = $request->price * $request->qty; 
                session()->put('shopping_cart',$shopping_cart);
                return response()->json($shopping_cart);
            }
        
    }

    public function shipping(Request $request)
    {
        $shipping= array();
        if($request->ship == 0)
        {
            $shipping['price']= 250 ;
            return response()->json($shipping);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //
    }
    public function delete($id)
    {
        if(session('shopping_cart'))
            {
                $shopping_cart   = session('shopping_cart');
                $cartitems       = $shopping_cart['items'];
                $removedprice    = $cartitems[$id]['price'];
                unset($cartitems[$id]); 
                $shopping_cart['items']         = $cartitems;
                $shopping_cart['cartcount']     = session('shopping_cart')['cartcount']- 1;  
                $shopping_cart['total']         = session('shopping_cart')['total'] - $removedprice;
                session()->put('shopping_cart',$shopping_cart);
                if($shopping_cart['cartcount'] == 0)
                {
                    session()->forget('shopping_cart');
                } 
                $successmessage = session('locale') == 'en' ? 'Remove Item from Cart Successfully' : 'تم حذف المنتج من السلة بنجاح';
                session()->flash('success', $successmessage);
                return redirect()->back();
                
            }
    }

    public function deleteall()
    {
        if(session('shopping_cart'))
            {
                session()->forget('shopping_cart');
                $successmessage = session('locale') == 'en' ? 'Empty Cart Successfully' : 'تم تفريغ السلة بنجاح';
                session()->flash('success', $successmessage);
                return back();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    
    }
    
}
