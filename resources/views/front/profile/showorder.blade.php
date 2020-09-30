@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.showorder')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.showorder')}}</li>
            </ul>
        </div>
    </div>

    <div class="pages">
        <div class="orders">
            <div class="container text-center">
            <table>
                <tbody>
                    <tr>
                        <th>{{__('messages.itemcode')}}</th>
                        <th>{{__('messages.item')}}</th>
                        <th>{{__('messages.qty')}}</th>
                        <th>{{__('messages.price')}}</th>
                    </tr>
                    @foreach($orderitems as $item)
                       <?php $iteminfo = DB::table('items')->where('id',$item->item_id)->first(); ?>
                        <tr>
                            <td>{{$iteminfo->code}}</td>
                            <td>{{ session('locale') == 'en' ? $iteminfo->entitle : $iteminfo->artitle}}</td>
                            <td>{{$item->qty}}</td>
                            <td>{{$item->price}} {{__('messages.currancy')}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

@endsection 