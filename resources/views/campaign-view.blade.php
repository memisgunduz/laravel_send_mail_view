@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="/campaign" class="btn btn-success"><</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="modal-body">
                        <form action="{{route('campaign_update', ['campaign_id' => $campaign?->id])}}" method="post">
                            {{ csrf_field() }}
                            <input  name="name" id="name" value="{{ $campaign?->name }}" class="form-control mb-3" type="text" name="name" placeholder="Name">
                            <select  class="form-control mb-3" name="mail_template_id" id="mail_template_id">
                                @foreach ($mailTemplates as $mailTemplate)
                                    <option value="{{ $mailTemplate->id }}">{{ $mailTemplate->name }}</option>
                                @endforeach
                            </select>
                            <select class="form-control mb-3" name="status" id="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>

                            <div class="">
                                @foreach ($mailLists as $mail)
                                    <div class=" m-2">
                                        <input class="form-check-input" value="{{$mail->id}}" type="checkbox" name="mail_list[]" id="mail_list_{{ $mail->id }}"/>
                                        <label class="form-check-label" for="mail_list_{{ $mail->id }}"> {{ $mail->name }}</label><br>
                                    </div>
                                @endforeach
                            </div>

                            <button class=" btn btn-success btn-block" type="submit">
                                @if($campaign?->id)
                                    Update
                                @else
                                    Save
                                @endif
                                <i class="fa fa-save btn-outline-primary"></i>
                            </button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
