@extends('backend.layouts.app')

@push('styles')
<link href="{{ asset('backend/js/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
@endpush

@section('content')



    <div class="wrapper">
        <!-- Navbar -->
        @include('backend.includes.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.includes.sidebar')
    
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1>Compose</h1>
                        </div>
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('categories') }}">Categories</a></li>
                            <li class="breadcrumb-item active">Compose</li>
                        </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">

                            <form method="post" action="{{ url('/admin/category') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <input id="title" class="form-control" name="title">
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <input id="slug" class="form-control hidden" name="slug">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Save</button>
                                    </div>
                                    <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                            
                            </div>
                        <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        @include('backend.includes.footer')
        
    </div>
@endsection

@push('other-scripts')
<script src="{{ asset('backend/js/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('backend/js/stringToSlug/speakingurl.min.js') }}"></script>
<script src="{{ asset('backend/js/stringToSlug/jquery.stringtoslug.js') }}"></script>


<script>

    $(function () {
        // summernote
        //Add text editor
        $('#compose-textarea').summernote()
    })

    $(document).ready( function() {
        $('#title').stringToSlug({
            space: '-',
            replace: /\s?\([^\)]*\)/gi,
            AND: 'y',
            getPut: 'input#slug'
        });
    });


    
</script>


@endpush