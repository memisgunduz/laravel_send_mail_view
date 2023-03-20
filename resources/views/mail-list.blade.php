@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a style="float: right;" type="button" href="/mail-list-view" class="btn btn-success">
                        <i class="fa fa-plus btn-outline-primary"></i>
                    </a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($mailLists as $mail)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td>{{  $mail->name }}</td>
                                        <td>
                                            <a href="/mail-list-view/{{ $mail->id }}" class="btn btn-success">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="/mail-list-delete/{{ $mail->id }}" class="btn btn-danger">
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
</div>
@endsection
