@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a type="button" href="/template-list" class="btn btn-success"><</a>
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
                        <form action="{{route('template_update',['template_id' => $mailTemplate?->id ])}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input  name="name" id="name" value="{{ $mailTemplate?->name }}" class="form-control mb-3" type="text" name="name" placeholder="Name">
                            <input  name="subject" id="subject" value="{{ $mailTemplate?->subject }}" class="form-control mb-3" type="text" name="Subject" placeholder="Subject">
                            <div class="mb-3">
                                <textarea id="myeditorinstance" name="html">{{ $mailTemplate?->html }}</textarea>
                            </div>
                            <input type="file" name="file" class="mb-3 custom-file-input" id="chooseFile">
                            <br>
                            <button class=" btn btn-success btn-block" type="submit">
                                @if($mailTemplate?->id)
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
<script src="https://cdn.tiny.cloud/1/9ixcpyxvnssea1w5w5ivvha1mmjz4rjyewuqlrvqsk9j53ok/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> <script>
   tinymce.init({
     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
     plugins: 'code table lists',
     toolbar: 'undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
   });
 </script>
@endsection
