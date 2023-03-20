@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a style="float: right;" type="button" href="/template-view" class="btn btn-success">
                        <i class="fa fa-plus btn-outline-primary"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Subject</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($mailTemplates as $mailTemplate)

                            <tr>
                                <th scope="row">{{ $loop->index+1 }}</th>
                                <td>{{  $mailTemplate->name }}</td>
                                <td>{{  $mailTemplate->subject }}</td>
                                <td>
                                    <a href="/template-view/{{ $mailTemplate->id }}" class="btn btn-success">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="/template-delete/{{ $mailTemplate->id }}" class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                      </table>

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
