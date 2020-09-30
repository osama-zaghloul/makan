@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.mybills')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.mybills')}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
        <div class="orders">
            <div class="container text-center">
            <table>
            @if(count($mybills) != 0)
                <thead class="text-center">
                    <tr>
                        <th class="text-center">{{__('messages.billcode')}}</th>
                        <th class="text-center">{{__('messages.total')}}</th>
                        <th class="text-center">{{__('messages.billstatus')}}</th>
                        <th class="text-center">{{__('messages.showbill')}}</th>
                        <th class="text-center">{{session('locale')=='ar' ? 'حالة الدفع' : 'Payment status'}}</th>
                        {{-- <th>{{__('messages.sendbanktransfer')}}</th> --}}
                    </tr>
                </thead>
                        @foreach($mybills as $bill)
                    <tbody>
                            <tr>
                                <td class="text-center">{{$bill->order_number}}</td>
                                <td class="text-center">{{$bill->total}} {{__('messages.currancy')}}</td>
                                <td style="text-align:center;" >
                                    @if($bill->paid == 3)
                                        <span  style="border-radius: 3px;border: 1px solid green;color: orange;float:left;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.active')}}</span>
                                    @elseif($bill->paid == 0) 
                                        <span style="border-radius: 3px;border: 1px solid #c22356;float:left;color:crimson;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.notactive')}}</span> 
                                    @elseif($bill->paid == 1 || $bill->paid == 2) 
                                        <span style="border-radius: 3px;border: 1px solid #c22356;float:left;color:crimson;padding: 3px;font-weight: bold;background: #fff;display: inline-block;margin-top: 4%;" class="ads__item__featured">{{__('messages.notactive')}}</span> 
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn-link" href="{{asset('orders/'.$bill->id)}}">{{__('messages.showbill')}}</a>
                                </td>
                                {{-- <td style="text-align:center;">
                                    @if($bill->paid == 1)
                                        <span class="text-success">{{__('messages.transfersent')}}</span>
                                    @elseif($bill->paid == 0) 
                                        <a class="btn-link" href="{{asset('banktransfer/'.$bill->order_number)}}">{{__('messages.sendbanktransfer')}}</a>
                                    @endif
                                </td> --}}
                                <td style="text-align:center;">
                                    @if($bill->paid == 0)
                                        <span class="text-success">{{session('locale')=='ar' ? 'الدفع عند الإستلام' : 'Payment when recieving'}}</span>
                                    @elseif($bill->paid == 1) 
                                        <a class="btn-link" href="{{asset('banktransfer/'.$bill->order_number)}}">{{__('messages.sendbanktransfer')}}</a>
                                    @elseif($bill->paid == 2)
                                        <span class="text-success">{{session('locale')=='ar' ? 'تم إرسال التحويل البنكي' : 'Bank transfer has been sent
'}}</span>
                                    @elseif($bill->paid == 3)
                                        <span class="text-success">{{session('locale')=='ar' ? 'تم الدفع' : 'The payment was made'}}</span>
                                    
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                </tbody>
            @else 
                <h3>{{$errormessage}}</h3>
            @endif
            </table>
            </div>
        </div>
    </div>

@endsection 