@extends('frontend.emails.template')
@section('content')

<p>Hello Admin,</p>
<p><strong>Your got an email from contact us.</strong></p>
<p>Following are the details  filled by {{$emailData['name']}} :</p>

<p>Name: {{$emailData['name']}}</p>
<p>Email: {{$emailData['email']}}</p>
<p>Phone: {{$emailData['phone']}}</p>
<p>Message: {{$emailData['message']}}</p>




@endsection
