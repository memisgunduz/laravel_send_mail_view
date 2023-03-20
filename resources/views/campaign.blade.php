@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h4>Campaigns</h4>
                        </div>
                        <div class="col-6">
                            <a style="float: right;" type="button" href="/campaign-view" class="btn btn-success">
                                <i class="fa fa-plus btn-outline-primary"></i>
                            </a>
                        </div>
                    </div>
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
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $campaign)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{  $campaign->name }}</td>
                                    <td>{{  $campaign->status }}</td>
                                    <td>
                                        <a href="/campaign-start/{{ $campaign->id }}" class="btn btn-primary">
                                            <i class="fa fa-play"></i>
                                        </a>
                                        <a href="/campaign-view/{{ $campaign->id }}" class="btn btn-success">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="/campaign-delete/{{ $campaign->id }}" class="btn btn-danger">
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

<div class="container">
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Campaign Add</h4>
          </div>

          @if(Session::has('status'))
            <div class="alert alert-success">
                {{Session :: get('status')}}
            </div>
        @endif

          <div class="modal-body">
            <form action="{{url('campaign-add')}}" method="post">
                {{ csrf_field() }}
                <input  name="name" id="name" class="form-control mb-3" type="text" name="name" id="" placeholder="name">
                <textarea  name="description" id="description" class="form-control mb-3" placeholder="Description">
                </textarea>
                {{-- <input class="form-control mb-3" type="file" name="description" id=""> --}}
                <select class="form-control mb-3" name="status" id="status">
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                </select>
                <button class="btn btn-primary btn-block" type="submit">Save</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
