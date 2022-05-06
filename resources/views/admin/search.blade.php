@extends(backpack_view('blank'))


@section('header')
    <section class="container-fluid">
        <h2>
            <span class="text-capitalize">Searching</span>
            <small>Search your data.</small>
        </h2>
    </section>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8 bold-labels">
            <!-- Default box -->
            <form method="post" action="{{route('search.post')}}">
                @csrf
                <!-- load the view from the application if it exists, otherwise load the one in the package -->
                <input type="hidden" name="_http_referrer" value="{{route('search.post')}}">
                <div class="card">
                    <div class="card-body row">
                        <!-- text input -->
                        <div class="form-group col-sm-12" element="div"><label>Search</label>
                            <input type="text" name="q" placeholder="Enter your keyword" class="form-control">
                        </div>
                        <div class="btn-group ml-3" role="group">
                            <button type="submit" class="btn btn-success">
                                <span class="la la-search" role="presentation" aria-hidden="true"></span> &nbsp;
                                <span data-value="save_and_back">Search</span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        @if(isset($data))
            <h2>Your search : {{$q}}</h2>
            @foreach($data as $document)
                <div class="col-md-8 bold-labels">
                    <h2></h2>
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                    {{$document->document()->content()['title']}}
                                </div>
                                <div class="col-2">
                                    {{$document->score()}} score
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{Str::limit($document->document()->content()['content'],100,'...')}}</p>
                                <footer class="blockquote-footer">keyword</footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
@endsection
