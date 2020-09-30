@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{session('locale')=='ar' ? 'الطلبات المرتجعة' : 'The returned orders'}} @endsection
@section('content')

<div class="title_page">
    <div class="container">
        <ul>
            <li><a href="{{asset('/')}}">{{session('locale')=='ar' ? 'الرئيسية' : 'Home'}} /</a></li>
                <li>{{session('locale')=='ar' ? 'الطلبات المرتجعة ' : 'The returned orders'}}</li>
        </ul>
    </div>
</div>

<div class="pages">
<div class="orders">
    <div class="container text-center">
    <table>
        @if(count($returnorders) != 0)
        <tr>
            <th class="text-center">{{__('messages.ordercode')}}</th>
            <th class="text-center">{{__('messages.total')}}</th>
            <th class="text-center">{{__('messages.orderstatus')}}</th>
            <th class="text-center">{{__('messages.showorder')}}</th>
            
        </tr>
        @foreach($returnorders as $order)
        <tr>
         

            <td class="text-center">{{$order->order_number}}</td>
            <td class="text-center">
                {{$order->total}} {{__('messages.currancy')}}
            </td>
            <td style="text-align:center;">
                @if($order->status == 0)
                                        <span style="border-radius: 3px;border: 1px solid green;color: orange;float:left;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.waiting')}}</span>
                                    @elseif($order->status == 1) 
                                            <span style="border-radius: 3px;border: 1px solid green;color: springgreen;float:left;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.processing')}}</span>
                                    @elseif($order->status == 2)   
                                            <span style="border-radius: 3px;border: 1px solid #c22356;float:left;color:crimson;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.rejecting')}}</span>
                                    @elseif($order->status == 3)   
                                            <span style="border-radius: 3px;border: 1px solid green;float:left;color:green;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.finished')}}</span>
                                    @endif
            </td>
            <td class="text-center">
                <a class="btn-link" href="{{asset('orders/'.$order->id)}}">{{__('messages.showorder')}}</a></td>
            
            

            {{-- <td>240 ر.س</td> --}}
        </tr>
        @endforeach
        @else 
                <h3>{{session('locale')=='ar' ? ' لا توجد طلبات المرتجعة ' : 'There are not any returned orders'}}</h3>
        @endif
    </table>
    </div>
</div><!-- END products -->
</div>

@endsection