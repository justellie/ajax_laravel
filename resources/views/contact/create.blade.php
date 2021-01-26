@extends('users.master')
@section('title','Contact Us')

@section('content')
<h1>Contact Us</h1>
<label for="name">Name</label>
<form action="{{route('contact.store',$user->id)}}"  method="POST">
    <div class="form-group ">
        <input type="text" name="asunto" value="{{old('asunto')}}" class="form-control">
        <div>{{$errors->first('name')}}</div>
    </div>
    <label for="email">Email</label>
    <div class="form-group">
        <input type="text" name="email" value="{{old('email') }}" class="form-control">
        <div>{{$errors->first('email')}}</div>

    </div>
    <label for="message">Message</label>
    <div class="form-group">
        <textarea name="message" id="message" cols="30" rows="10" class="form-control" value="{{old('message')}}"></textarea>
        <div>{{$errors->first('message')}}</div>
    </div>
    <input type="hidden" id="user_id" name="user_id" value={{$user->id}}>

    @csrf
    <button type="submit" class="btn btn-primary">Send Message</button>
</form>
@endsection