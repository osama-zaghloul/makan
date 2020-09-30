@extends('front.include.master')
@section('title') {{session('locale')=='ar' ? 'مكان' : 'makan'}} | {{__('messages.mynotification')}} @endsection
@section('content')

    <div class="title_page">
        <div class="container">
            <ul>
                <li><a href="{{asset('/')}}">{{__('messages.home')}} /</a></li>
                <li>{{__('messages.mynotification')}}</li>
            </ul>
        </div>
    </div>

        <div class="pages">
        <div class="orders">
            <div class="container text-center">
            <table>
            @if(count($mynotifications) != 0)
                <tbody>
                    <tr>
                        <th>{{__('messages.notification')}}</th>
                        <th>{{session('locale')=='ar' ? 'مسح الاشعار' : 'Delete notification'}}</th>
                    </tr>
                    
                        @foreach($mynotifications as $notification)
                            <tr>
                                <td>{{$notification->notification}}</td>
                        {{-- <form action="{{asset('profile/'.$notification->id)}}" method="delete" enctype="multipart/form-data" class="form-horizontal"> --}}
                            {{ Form::open(array('method' => 'DELETE',"onclick"=>"return confirm('هل انت متأكد ؟!')",'files' => true,'url' => array('profile/'.$notification->id))) }}

                                 {{-- @csrf --}}
                                 <td>
                                     <button type="submit" class="btn btn-danger" >{{session('locale')=='ar' ? 'مسح ' : 'Delete'}}</button>
                                 </td>
                                {!! Form::close() !!}
                        {{-- </form> --}}
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