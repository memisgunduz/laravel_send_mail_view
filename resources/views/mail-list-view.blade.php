@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="/mail-list" class="btn btn-success"><</a>
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
                        <form action="{{route('mail_list_update',['mail_list_id' => $mailList->id ])}}" method="post">
                            {{ csrf_field() }}
                            <input  name="name" id="name" value="{{ $mailList?->name }}" class="form-control mb-3" type="text" name="name" placeholder="Name">
                            <textarea name="mail_list_textarea" class="form-control" cols="50" rows="20">{{ implode("\r\n", $mailList->mails->pluck('mail')->toArray()) }}</textarea><br>
                            <button class=" btn btn-success btn-block" type="submit">
                                @if($mailList?->id)
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
