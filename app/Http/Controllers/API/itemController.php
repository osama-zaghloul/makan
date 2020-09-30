<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController as BaseController;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use App\Mail\activationmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\notification;
use App\item;
use App\item_image;
use App\rate;
use App\favorite_item;
use App\order;
use App\member;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;


class itemController extends BaseController
{
    public function allitems(Request $request)
    {
        $lastitems = array();
        $lang      = $request->lang == 'ar' ? 'ar' : 'en';
        $keyword   = $request->keyword;
        $category  = $request->category;
        $offer     = $request->offer;
        $sort      = $request->sort;
        if($request->lang =='ar')
        {
        $allitems  = item::when($keyword, function ($query) use ($keyword) {
                    return $query->where('artitle','like','%' . $keyword . '%' );
                })->when($category, function ($query) use ($category) {
                    return $query->where('category_id',$category);
                })->when($offer, function ($query) use ($offer) {
                    return $offer == 1 ? $query->where('offer',$offer) : $query->where('offer',0) ;
                })->when($sort, function ($query) use ($sort,$offer) {
                    return  $offer == 1 ? $query->orderBy('discountprice',$sort) : $query->orderBy('price',$sort);
                })->where('suspensed',0)->orderBy('artitle','asc')->orderBy('id','desc')->get(); 
        }else
        {
             $allitems  = item::when($keyword, function ($query) use ($keyword) {
                    return $query->where('artitle','like','%' . $keyword . '%' );
                })->when($category, function ($query) use ($category) {
                    return $query->where('category_id',$category);
                })->when($offer, function ($query) use ($offer) {
                    return $offer == 1 ? $query->where('offer',$offer) : $query->where('offer',0) ;
                })->when($sort, function ($query) use ($sort,$offer) {
                    return  $offer == 1 ? $query->orderBy('discountprice',$sort) : $query->orderBy('price',$sort);
                })->where('suspensed',0)->orderBy('entitle','asc')->orderBy('id','desc')->get(); 
        }
        if(count($allitems) != 0)
        {
            foreach ($allitems as $item) 
                {  
                    $image     = item_image::where('item_id',$item->id)->first();
                    $favorited = 0;
                    $sumrates  = 0;
                    $adrates   = rate::where('item_id',$item->id)->get();
                    foreach($adrates as $value)
                    {
                       $sumrates+= $value->rate;
                    }
                    $fullrate = $sumrates != 0 ? round($sumrates/count($adrates)) : 0; 
                   
                    if($request->user_id)
                    {
                        $fav = DB::table('favorite_items')->where('user_id',$request->user_id)->where('item_id',$item->id)->get();
                        $favorited = count($fav) != 0 ? 1 : 0;
                    }
                    array_push($lastitems, 
                    array(
                          "id"              => $item->id,
                          'image'           => $image,
                          'title'           => $item[$lang.'title'],
                          "price"           => $item->price,
                          "offer"           => $item->offer,
                          "discountprice"   => $item->discountprice,
                          'rate'            => $fullrate,
                          'favorited'       => $favorited,
                        ));
                }
            return $this->sendResponse('success', $lastitems); 
        }
        else 
        {
            $errormessage = $request->lang == 'ar' ? 'لا يوجد منتجات' : 'No Prouducts Found';
            return $this->sendError('success',$errormessage);
        }            
    }

    public function showitem(Request $request)
    {
         $showitem = item::find($request->item_id);
         if($showitem)
         {
            $iteminfo     = array();
            $similaritems = array();
            $current      = array();

            $lang      = $request->lang == 'ar' ? 'ar' : 'en';
            $images    = item_image::where('item_id',$showitem->id)->get();
            $favorited = 0;
            $sumrates  = 0;
            $adrates   = rate::where('item_id',$showitem->id)->get();
            foreach($adrates as $value)
            {
               $sumrates+= $value->rate;
            }
            $fullrate = $sumrates != 0 ? round($sumrates/count($adrates)) : 0; 
           
            if($request->user_id)
            {
                $fav = DB::table('favorite_items')->where('user_id',$request->user_id)->where('item_id',$showitem->id)->get();
                $favorited = count($fav) != 0 ? 1 : 0;
            }
            array_push($iteminfo, 
            array(
                  "id"              => $showitem->id,
                  'title'           => $showitem[$lang.'title'],
                  "price"           => $showitem->price,
                  "offer"           => $showitem->offer,
                  "discountprice"   => $showitem->discountprice,
                  "desc"            => strip_tags($showitem[$lang.'desc']),
                  "whatsapp"        => $showitem->whatsapp,
                  'rate'            => $fullrate,
                  'favorited'       => $favorited,
                  'images'          => $images,
                ));

                // similar items 
                $items = item::where('category_id',$showitem->category_id)->where('suspensed',0)->orderBy('id','desc')->get();
                foreach ($items as $item) 
                {  
                    $image     = item_image::where('item_id',$item->id)->first();
                    $favorited = 0;
                    $sumrates  = 0;
                    $adrates   = rate::where('item_id',$item->id)->get();
                    foreach($adrates as $value)
                    {
                        $sumrates+= $value->rate;
                    }
                    $fullrate = $sumrates != 0 ? $sumrates/count($adrates) : 0; 
                    
                    if($request->user_id)
                    {
                        $fav = DB::table('favorite_items')->where('user_id',$request->user_id)->where('item_id',$item->id)->get();
                        $favorited = count($fav) != 0 ? 1 : 0;
                    }
                    array_push($similaritems, 
                    array(
                            "id"           => $item->id,
                            'image'        => $image,
                            'title'        => $item[$lang.'title'],
                            'rate'         => $fullrate,
                            'favorited'    => $favorited,
                        ));
                }

                $current['iteminfo']     = $iteminfo;
                $current['similaritems'] = $similaritems;
            return $this->sendResponse('success', $current); 
         }
         else 
         {
            $errormessage = $request->lang == 'ar' ? 'المنتج غير موجود' : 'Item Not Found';
            return $this->sendError('success', $errormessage);   
         }
    }

    public function addrate(Request $request)
    {
        $userrating = rate::where('user_id',$request->user_id)->where('item_id',$request->item_id)->first();
        if($userrating)
        {
            $errormessage = $request->lang == 'ar' ? 'تم تقييم هذا المنتج سابقا' : 'This Item was previously evaluated';
            return $this->sendError('success', $errormessage);
        }
        else 
        {
            $newrate                = new rate();
            $newrate->user_id       = $request->user_id;
            $newrate->item_id       = $request->item_id;
            $newrate->rate          = $request->rate;
            $newrate->created_date  = date("Y-m-d");
            $newrate->created_time  = date("H:i:s");
            $newrate->save();
            $errormessage = $request->lang == 'ar' ? 'تم التقييم بنجاح' : 'Item evaluated successfully';
            return $this->sendResponse('success', $errormessage);
        }
    }

    public function makefavoriteitem(Request $request)
    {
        $favorited = favorite_item::where('item_id',$request->item_id)->where('user_id',$request->user_id)->first();
        if($favorited)
        {
            $errormessage = $request->lang == 'ar' ? 'هذا المنتج موجود ف المفضلة' : 'This product is already in my favorites';
            return $this->sendError('success', $errormessage); 
        }
        else 
        {
            $newfavad = new favorite_item;
            $newfavad->user_id = $request->user_id;
            $newfavad->item_id   = $request->item_id;
            $newfavad->save();
            $errormessage = $request->lang == 'ar' ? 'تم اضافة المنتج ف المفضلة بنجاح' : 'The favorite product has been successfully added';
            return $this->sendResponse('success', $errormessage);
        }
    }

    public function cancelfavoriteitem(Request $request)
    {
        favorite_item::where('user_id',$request->user_id)->where('item_id',$request->item_id)->delete();
        $errormessage = $request->lang == 'ar' ? 'تم حذف المنتج من المفضلة' : 'The product has been deleted from favorites';
        return $this->sendResponse('success', $errormessage);
    }
    
}
