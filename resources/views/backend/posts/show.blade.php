@extends('backend.layouts.app')

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
              @foreach ($post as $post)
                <div class="card-header">

                
                  <h3 class="card-title">{{ $post->title }}</h3>
                

                  <div class="card-tools">
                    <a href="{{ url('/admin/post/'.$post->slug.'/edit') }}" class="btn btn-tool" title="Previous">
                      <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Edit</button>                    
                    </a>
                    <form action="{{ url('/admin/post/'.$post->id) }}" method="post">
                        @csrf
                        {{ method_field('delete')}}
                        <button type="submit" class="btn btn-danger"><i class="nav-icon fas fa-solid fa-trash"></i> Delete</button>                    
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                                
                  <div class="mailbox-read-message">

                    <img src="{{ asset($post->image) }}" class="img-fluid">

                    <p>Category: {!! $post->category_title !!}</p>
                    
                    <p>{!! $post->body !!}</p>

                  </div>
                  <!-- /.mailbox-read-message -->
                </div>
                <!-- /.card-body -->
                @endforeach
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
<script>
  $(function () {
    //Enable check and uncheck all functionality
    $('.checkbox-toggle').click(function () {
      var clicks = $(this).data('clicks')
      if (clicks) {
        //Uncheck all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
        $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
      } else {
        //Check all checkboxes
        $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
        $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
      }
      $(this).data('clicks', !clicks)
    })

    //Handle starring for font awesome
    $('.mailbox-star').click(function (e) {
      e.preventDefault()
      //detect type
      var $this = $(this).find('a > i')
      var fa    = $this.hasClass('fa')

      //Switch states
      if (fa) {
        $this.toggleClass('fa-star')
        $this.toggleClass('fa-star-o')
      }
    })
  })
</script>
@endpush