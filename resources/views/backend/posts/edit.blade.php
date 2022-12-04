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
                            <li class="breadcrumb-item"><a href="{{ route('posts') }}">Posts</a></li>
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

                            <form method="post" action="{{ url('/admin/post/'.$post->id.'/edit') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                                
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="form-group">
                                        <input id="title" class="form-control" name="title" value="{{ $post->title }}">
                                        <input type="hidden" id="slug" class="form-control" name="slug"  value="{{ $post->slug }}">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="image" name="image" class="custom-file-input">
                                                <label class="custom-file-label" for="image">{{ $post->image }}</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="old_image" class="form-control" name="old_image" value="{{ $post->image }}">
                                    

                                    <div class="form-group">
                                        <textarea id="compose-textarea" name="body" class="form-control" style="height: 300px">
                                            {{ $post->body }}                        
                                        </textarea>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                                        <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
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
    //Add text editor
    $('#compose-textarea').summernote()    
  })

  $(document).ready( function() {
        $('#title').stringToSlug({
            space: '-',
            getPut: 'input#slug',
        });
    });
    console.log('object');
</script>
@endpush