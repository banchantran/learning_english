@extends('layout.default')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="d-flex justify-content-end mb15">
        <button class="btn btn-danger" type="button" onclick="System.showModal('#createCategory', this)">Add</button>
    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Numbers of lessons</th>
            <th scope="col">Current lesson</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->name}}</td>
                <td>
                    <a class="" href="{{url(route('lesson.index', ['categoryId' => $item->id]))}}">
                        {{$item->lessons->count()}} {{Str::plural('lesson', $item->lessons->count())}}
                    </a>
                </td>
                <td>0</td>
                <td align="right">
                    <a class="btn-action" href="javascript:void(0)"
                       data-url="{{url(route('category.show', ['id' => $item->id]))}}"
                       onclick="System.showEditModal('#createCategory', this)">Edit</a>

                    <a class="btn-action ml10" href="javascript:void(0)"
                       data-url="{{route('category.delete', ['id' => $item->id])}}"
                       onclick="System.showModal('#deleteConfirm', this)">Delete</a>
                </td>
            </tr>
        @endforeach
        @if (count($data) == 0)
            <tr>
                <td colspan="5" align="center">No data</td>
            </tr>
        @endif
        </tbody>
    </table>

@endsection
